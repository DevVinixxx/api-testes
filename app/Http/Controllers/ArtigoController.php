<?php

namespace App\Http\Controllers;

use App\Http\Resources\Artigo as ResourcesArtigo;
use App\Models\Artigo;
use Illuminate\Http\Request;

class ArtigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artigo = Artigo::paginate(15);
        return ResourcesArtigo::collection($artigo);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artigo = new Artigo;
        $artigo->titulo = $request->input('titulo');
        $artigo->conteudo = $request->intup('conteudo');

        if( $artigo->save() ){
            return new ResourcesArtigo( $artigo );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artigo = Artigo::findOrFail( $id );
        return new ResourcesArtigo( $artigo );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $artigo = Artigo::findOrFail( Request->id);
        $artigo->titulo = $request->input('titulo');
        $artigo->conteudo = $request->input('conteudo');

        if ($artigo->save()) {
            return new ResourcesArtigo( $artigo );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artigo = Artigo::findOrFail($id);
        if ($artigo->delete()) {
            return new ResourcesArtigo( $artigo );
        }
    }
}
