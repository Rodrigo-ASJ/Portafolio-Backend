<?php

namespace App\Http\Controllers;

use App\Models\Portafolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
        'project_title' => 'required',
        'project_img' => 'required',
        'project_description'=> 'required',
        'project_tech' => 'required',
        'project_github' => 'required',
        'project_deployment' => 'required',
            ]);

           $proyecto = new Portafolio();

          //* añadir imagenes
          if ($request->hasFile('project_img')) {
            //buscar la imagen en files
            $imagen = $request->file('project_img');
            //formatear el nombre de la imagen para no tener problemas de caracteres
            $nombreImagen = Str::slug($request->project_title).".".$imagen->guessExtension();
            //darle una ruta de almacenamiento
            $ruta = public_path("images/featureds/");
            //mover la imagen a la ruta
            $imagen->move($ruta, $nombreImagen);
            /* copy($imagen->getRealPath(), $ruta.$nombreImagen); */
            //guardar en el modelo base de datos
            $proyecto->project_img = $nombreImagen;

           /*  $path = $request->file('project_img')->store('images/featureds', 'public');
            $proyecto->project_img  = $path; */
        } else {
            $proyecto->project_img  = 'noFoto';
        }
       $proyecto->project_title = $request->project_title;
       $proyecto->project_description = $request->project_description;
       $proyecto->project_tech = $request->project_tech;
       $proyecto->project_github = $request->project_github;
       $proyecto->project_deployment = $request->project_deployment;
       $proyecto->save();

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
        return $portafolio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portafolio  $portafolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portafolio $portafolio)
    {

               $portafolio->project_title = $request->project_title;
               $portafolio->project_img = $request->project_img;
               $portafolio->project_description = $request->project_description;
               $portafolio->project_tech = $request->project_tech;
               $portafolio->project_github = $request->project_github;
               $portafolio->project_deployment = $request->project_deployment;
               $portafolio->update();

            return $portafolio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portafolio  $portafolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portafolio $portafolio)
    {
        if(is_null($portafolio)){
            return response()->json('No se pudo realizar la petición,
            el archivo ya no existe', 404);
        }

        $portafolio->delete();
        return response()->noContent();

    }
}
