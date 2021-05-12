<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\SendContact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
/**
* @OA\Info(title="API Contact", version="1.0")
*
* @OA\Server(url="http://localhost:8000")
*/

class ContactController extends Controller
{
     /**
     * @OA\Post(
     *     path="/api/Contact/store",
     *     summary="Guardar datos de contacto",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string"
     *                 ),
     *                 example={"name": "betox", "email": "nelsonfercher@gmail.com","phone": "3435411789", "message":"Test de envio de email"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
       // dd($request); // reemplaza var_dump y die. propio de laravel

       try {
                $contact = new Contact();
                $contact->name = $request->name;
                $contact->email = $request->email;
                $contact->phone = $request->phone;
                $contact->message = $request->message;
                $contact->send_mail = "1";
        try {
            Mail::to($request->email)->send(new SendContact($contact));
            $contact->send_mail = "se envio el email";
        } catch (\Exception $e) {
            $contact->send_mail = "fallo de envio: {$e->getMessage()}";
        }
       $contact->save();
       } catch (\Exception $e) {
        return response()->json("se genero un error {$e->getMessage()}",404);
       }

         return response()->json("mensaje enviado con exito {{$request->email}}",201);
        }


      //  Mail::to($request->email)->send(new SendContact());
        //return response()->json("Mensaje fue enviado con exíto {$request->email}", 201);

        public function list()
        {
            //
            $data = Contact::all(); //all quiere decir que lista o muestra todo
            return  response()->json($data, 200);

        }

        public function index()
        {

            $data['contacts'] = Contact::paginate(5); //Nuestra la cantidad de registros por paginas
            return view("contact.index", $data); //Le pasamos la vista data

           // $data['contacts'] = Contact::paginate(); // 5= registros por pagina
            //Contact: es el modelo de la tabla creada con model
            // la variable contacts se ve reflejada en las vistas
           // return view('contact.index' , $data);

        }



        public function show($id)
        {
            $data = Contact::findOrFail($id);
            return view("Contact.show") ->with(["contactos" => $data]);;
        }





}
