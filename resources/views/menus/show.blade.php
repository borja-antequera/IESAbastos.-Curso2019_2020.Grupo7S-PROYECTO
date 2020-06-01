@extends('layouts.index')

@section('title', 'Ver Menú')

@section('content')
    <h1>Vista del menú</h1>
    @include('common.success')
    <div class="text-center">
        <h3>{{$menu->menu_nombre}}</h3>
        <label style="text:underline;">Desayuno:</label>
        <p>{{$menu->menu_desayuno_nombre}}</p>
        <label>Primer Plato:</label>
        <p>{{$menu->menu_primero_nombre}}</p>
        <label>Segundo Plato:</label>
        <p>{{$menu->menu_segundo_nombre}}</p>
        <label>Postre:</label>
        <p>{{$menu->menu_postre_nombre}}</p>
        <label>Merienda:</label>
        <p>{{$menu->menu_merienda_nombre}}</p>
    </div>
@endsection