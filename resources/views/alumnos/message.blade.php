@extends('layout/template')

@section('title','Alumnos| Escuela')

@section('contenido')

<main>
    <div class="container py-4">
        <! -- variable de msg que esta recibiendo --> .
        
        <h2>{{$msg}}</h2>
        <a href="{{url ('alumnos') }}" class="btn btn-secondary btn-sm" >Regresar</a>
    </div>
</main>