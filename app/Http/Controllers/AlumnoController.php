<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Nivel;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //para listar
        $alumnos = Alumno::all();



        return view('alumnos.index', ['alumnos' => $alumnos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    
    {
         /**
     * llamamos a niveles para que traiga todos los registros
     */
        //$niveles = Nivel::all();

         /**
     * y lo enviamos como parametro
     */
        return view('alumnos.create', ['niveles' => Nivel::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'matricula' => 'required|unique:alumnos|max:10',
        'nombre' => 'required|max:255',
        'fecha' => 'required|date',
        'telefono' => 'required',
        'email' => 'nullable|email',
        'nivel' => 'required'
       ]);

       $alumno = new Alumno();
       $alumno->matricula = $request->input('matricula');
       $alumno->nombre = $request->input('nombre');
       $alumno->fecha_nacimiento = $request->input('fecha');
       $alumno->telefono = $request->input('telefono');
       $alumno->email = $request->input('email');
       $alumno->nivel_id = $request->input('nivel');
       $alumno->save();
                                     //variable que se envia  msg  a la pagina message
       return view("alumnos.message",['msg' => "Registro guardado exitosamente"]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //para buscar el id que le envio como parametro
       $alumno = Alumno::find($id);

       //para llenar el comobox en editar
       return view('alumnos.edit',['alumno' => $alumno,'niveles' =>Nivel::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'matricula' => 'required|max:10|unique:alumnos,matricula,'.$id,
            'nombre' => 'required|max:255',
            'fecha' => 'required|date',
            'telefono' => 'required',
            'email' => 'nullable|email',
            'nivel' => 'required'
           ]);
    
           $alumno = Alumno::find($id);
           $alumno->matricula = $request->input('matricula');
           $alumno->nombre = $request->input('nombre');
           $alumno->fecha_nacimiento = $request->input('fecha');
           $alumno->telefono = $request->input('telefono');
           $alumno->email = $request->input('email');
           $alumno->nivel_id = $request->input('nivel');
           $alumno->save();
           return view("alumnos.message",['msg' => "Registro Modificado exitosamente"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $alumno = Alumno::find($id);
       $alumno->delete();

       return redirect("alumnos");
    }
}
