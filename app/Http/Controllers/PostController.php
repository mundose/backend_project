<?php

namespace App\Http\Controllers;


use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\session;

/*Se crea una clase y despues diversas funciones*/

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Data es una variable que va contener los datos de la base de dato
        //Mostramos los datos en una tabla de 5 registro por páginas
        $data['posts'] = Post::paginate(5); //Nuestra la cantidad de registros por paginas
        return view("post.index", $data); //Le pasamos la vista data

    }

    public function search( Request $request)

    {

        $data = $request->input('search');
        $query  = Post::select()
            ->join('categories as cat', 'posts.category_id', '=','cat.id')
            ->where('title','like',"%$data%")
            ->orWhere('author','like',"%$data%")
            ->orWhere('cat.name','like',"%$data%")
            ->get();
        return view("post.index")->with(["posts"=>$query]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*Función de creación*/
    public function create()
    {
        //
        $categories = Category::all();
        return view("post.create")->with(["categories"=> $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*Se encarga de guardar información*/
    public function store(Request $request)
    {
        //
      //$data = $request->all();
       $data = $request->except('_token');
       if ($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('uploads','public');
        }
        post::insert($data);
        Session::flash('alert-success', "Los datos se crearon con éxito!");
        return  redirect()->route("post.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    /**Es para llamar al formulario de edición */
    public function edit($id)
    {
        //
       //return view("post.edit");
       $data = Post::findOrFail($id); // Buscas o fallas!!
        $categories = Category::all();
        Session::flash('alert-success', "Los datos se editaron con éxito! {$data['name']}");
        return view("post.edit")->with(["post" => $data, "categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    /**hace todo el proceso de guardado */
    public function update(Request $request, $id)
     {

        $data = $request->except('_token','_method');
        if ($request->hasFile('image')) {
            $post = Post::findOrFail($id);
            Storage::delete("public/$post->image");
            $data['image'] = $request->file('image')->store('uploads','public');
        }
        Post::where('id','=', $id)->update($data);
        Session::flash('alert-success', "Los datos se actualizaron con éxito! {$data['name']}");
        return redirect()->route("post.index");



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    /**fUNCION PARA ELIMINACION */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route("post.index");
    }
}
