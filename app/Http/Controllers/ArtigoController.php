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
        $artigo->titulo = $request->titulo;
        $artigo->conteudo = $request->conteudo;

        if( $artigo->save() ){
            return response()->json([
                "message"=>"sucesso ao salvar"
            ]);
        } else{ return response()->json([
            "message"=>"erro ao salvar"
        ]);
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
        $artigo = Artigo::findOrFail($request->id);
        $artigo->titulo = $request->input('titulo');
        $artigo->conteudo = $request->input('conteudo');

        if ($artigo->save()) {
            return response()->json([
                "MESSAGE"=>"DEU BOM"
            ]);
        } else{
            return response()->json([
                "MESSAGE"=>"DEU RUIM"
            ]);
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

        //$artigo->destroy();

        //if($artigo->delete()){
          //  return response()->json([
            //    "message"=>"artigo deletado"
            //]);
        //} else{
          //  return response()->json([
            //    "message"=>"artigo nao deletado"
            //]);
        //}


        $artigo = Artigo::find($id);
        
        if($artigo->delete())
        return response()->json([
          "message" => "Artigo Deletado"]);
        //$artigo = Artigo::findOrFail($id);
        //if ($artigo->delete()) {
         //   return new ResourcesArtigo( $artigo );
        //}
    }
}
