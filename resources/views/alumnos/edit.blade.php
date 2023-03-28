@extends('layout/template')

@section('title', 'Editar Alumno | Escuela')

@section('contenido')

<main>
    <div class="container py-4">
        <h2>Editar Alumno</h2>

        @if($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ url('alumnos/'.$alumno->id) }}" method="post">
            @method("PUT") <!-- Método para actualizar -->
            @csrf

            <div class="mb-3 row">
                <label for="matricula" class="col-sm-2 col-form-label">Matrícula:</label>
                <div class="col-sm-5">
                    <input type="text" name="matricula" id="matricula" class="form-control" value="{{ $alumno->matricula }}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre completo:</label>
                <div class="col-sm-5">
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $alumno->nombre }}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="fecha" class="col-sm-2 col-form-label">Fecha de nacimiento:</label>
                <div class="col-sm-5">
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $alumno->fecha_nacimiento }}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="telefono" class="col-sm-2 col-form-label">Teléfono:</label>
                <div class="col-sm-5">
                    <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $alumno->telefono }}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Correo electrónico:</label>
                <div class="col-sm-5">
                    <input type="text" name="email" id="email" class="form-control" value="{{ $alumno->email }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nivel" class="col-sm-2 col-form-label">Nivel:</label>
                <div class="col-sm-5">

                    <select name="nivel" id="nivel" class="form-select" required>
                        <option value="">Seleccionar nivel...</option>
                        @foreach($niveles as $nivel)
                            <option value="{{ $nivel->id }}" 
                                @if ($nivel->id == $alumno->nivel_id)
                                    {{ 'selected' }}
                                @endif 
                            >{{ $nivel->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <a href="{{ url('alumnos') }}" class="btn btn-secondary">Regresar</a>

            <button type="submit" class="btn btn-success">Guardar</button>

        </form>
    </div>
</main>