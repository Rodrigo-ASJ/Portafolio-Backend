<?php

namespace App\Http\Controllers;

use App\Models\Portafolio;
use Illuminate\Http\Request;
use App\Http\Requests\SaveProjectsRequest;

class PortafolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Portafolio::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProjectsRequest $request)
    {


           $proyecto = new Portafolio();


            //* comprueba que la imagen se encuentra en file
           if ($request->hasFile('project_img')) {
                //almacena la imagen en la dirección de la carpeta public
                $path = $request->file('project_img')->store('images/featureds', 'public');
                // guarda la información en la tabla
                $proyecto->project_img  = $path;
            } else {
                $proyecto->project_img  = 'noImage';
            }
           $proyecto->project_title = $request->project_title;
           $proyecto->project_description = $request->project_description;
           $proyecto->project_tech = $request->project_tech;
           $proyecto->project_github = $request->project_github;
           $proyecto->project_deployment = $request->project_deployment;

           $proyecto->save($request->validated()); //! guardar y realizar validación

        return $proyecto;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portafolio  $portafolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portafolio $portafolio)
    {
        // es igual a $proyecto = Portafolio::find($id);
        return $portafolio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portafolio  $portafolio
     * @return \Illuminate\Http\Response
     */
    public function update(SaveProjectsRequest $request, Portafolio $portafolio)
    {

            /* $portafolio->project_title = $request->project_title;
               $portafolio->project_img = $request->project_img;
               $portafolio->project_description = $request->project_description;
               $portafolio->project_tech = $request->project_tech;
               $portafolio->project_github = $request->project_github;
               $portafolio->project_deployment = $request->project_deployment;
               $portafolio->update(); */

               //* pasamos la clase form request SaveProjectsRequest para validar
               $portafolio->update($request->validated());

            return $portafolio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portafolio  $portafolio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $portafolio = Portafolio::find($id);
        if(is_null($portafolio)){
            return response()->json('No se pudo realizar la peticion, el archivo ya no existe o nunca existio', 404);
        }

        $portafolio->delete();
        return response()->noContent();

    }
}
