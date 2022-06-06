<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\BookModel;

class BookController extends BaseController{

    /**
    * @OA\Get(
    *     path="/api/book",
    *     summary="Mostrar listado de libros",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos los libros registrados."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function index(){
        $data = BookModel::all();
        return response($data);
    }

    /**
    * @OA\Get(
    *     path="/api/book/{id}",
    *     summary="Mostrar libros por ID",
           @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de libro",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *              )
     *          ),
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar libros por ID."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function show($id){
        $data = BookModel::where('id', $id)->get();

        if(count($data) > 0){
            return response ($data);
        }else{
            return response('Book not found');
        }
    }

     /**
    * @OA\Post(
    *     path="/api/book",
    *     summary="Insertar libros",
           @OA\Response(
     *         response="200",
     *         description="Retorna el resultado del registro",
     *         @OA\JsonContent(
     *              @OA\Property(property ="title",type="string",description="titulo del libro"),
     *              @OA\Property(property="author",type="string",description="autor del libro"),
     *              @OA\Property(property ="description",type="string",description="descripcion del libro"),
     *              
     *          ),
     *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     ),
        @OA\RequestBody(
     *          description="Datos de nuevo libro",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  required ={"title","author","description"},
     *                  @OA\Property(
     *                      property="title",
     *                      description="titulo del libro",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="author",
     *                      description="autor del libro",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      description="descripcion del libro",
     *                      type="string"
     *                  ),  
     *              )
     *          )
     *      )


    * )
    */
    public function store(Request $request){
        $data = new BookModel;

        if($request->input('title')){
            $data->title = $request->input('title');
        }else{
            return response('Title canÂ´t be blank');
        }

        if($request->input('author')){
            $data->author = $request->input('author');
        }else{
            return response('Author canÂ´t be blank');
        }
        
        if($request->input('description')){
            $data->description = $request->input('description');
        }else{
            return response('Description canÂ´t be blank');
        }
        
        $data->save();

        return response('Successful insert');
    }


    
     /**
    * @OA\Put(
    *     path="/api/book/{id}",
    *     summary="Actualizar libros",
            @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de libro",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *              )
     *          ),
           @OA\Response(
     *         response="200",
     *         description="Retorna el resultado del registro",
     *         @OA\JsonContent(
     *              @OA\Property(property ="title",type="string",description="titulo del libro"),
     *              @OA\Property(property="author",type="string",description="autor del libro"),
     *              @OA\Property(property ="description",type="string",description="descripcion del libro"),
     *              
     *          ),
     *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     ),
        @OA\RequestBody(
     *          description="Datos de actualizacion libro",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  required ={"title","author","description"},
     *                  @OA\Property(
     *                      property="title",
     *                      description="titulo del libro",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="author",
     *                      description="autor del libro",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      description="descripcion del libro",
     *                      type="string"
     *                  ),  
     *              )
     *          )
     *      )


    * )
    */
  
    public function update(Request $request, $id){
        $data = BookModel::where('id',$id)->first();

        if($request->input('title')){
            $data->title = $request->input('title');
        }else{
            return response('Title canÂ´t be blank');
        }

        if($request->input('author')){
            $data->author = $request->input('author');
        }else{
            return response('Author canÂ´t be blank');
        }

        if($request->input('description')){
            $data->description = $request->input('description');
        }else{
            return response('Description canÂ´t be blank');
        }

        $data->save();
    
        return response('Successful update');
    }



     /**
    * @OA\Delete(
    *     path="/api/book/{id}",
    *     summary="Borrar libro por ID",
           @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de libro",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *              )
     *          ),
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar libros por ID."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function destroy($id){
        $data = BookModel::where('id',$id)->first();
        $data->delete();

        return response('Successful delete');
    }
}