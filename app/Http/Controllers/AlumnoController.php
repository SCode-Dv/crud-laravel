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
        $alumnos = Alumno::all();
        return view('alumnos.index', ['alumnos' => $alumnos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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

        $alumnos = new Alumno();
        $alumnos->matricula = $request->input('matricula');
        $alumnos->nombre = $request->input('nombre');
        $alumnos->fecha_nacimiento = $request->input('fecha');
        $alumnos->telefono = $request->input('telefono');
        $alumnos->email = $request->input('email');
        $alumnos->nivel_id = $request->input('nivel');
        $alumnos->save();

        return view("alumnos.message", ['msg' => "Registro guardado"]);
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
    public function edit($id)
    {
        $alumno = Alumno::find($id);
        return view('alumnos.edit', ['alumno' => $alumno, 'niveles' => Nivel::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'matricula' => 'required|max:10|unique:alumnos,matricula,'. $id,
            'nombre' => 'required|max:255',
            'fecha' => 'required|date',
            'telefono' => 'required',
            'email' => 'nullable|email',
            'nivel' => 'required'
        ]);

        $alumnos = Alumno::find($id);
        $alumnos->matricula = $request->input('matricula');
        $alumnos->nombre = $request->input('nombre');
        $alumnos->fecha_nacimiento = $request->input('fecha');
        $alumnos->telefono = $request->input('telefono');
        $alumnos->email = $request->input('email');
        $alumnos->nivel_id = $request->input('nivel');
        $alumnos->save();

        return view("alumnos.message", ['msg' => "Registro actualizado"]);
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
