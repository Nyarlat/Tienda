@extends('layouts.main')
@section('content')
    <div class="container"> <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Listado de Productos
                        <a href="{{ route('products.create') }}" class="btn btn-success btn-sm float-right">Nuevo Producto</a>
                    </div>
                    <div class="card-body">
                        @if(session('infoC'))
                        <div class="alert alert-success">{{session('infoC')}}</div>
                        @elseif(session('infoD'))
                        <div class="alert alert-danger">{{session('infoD')}}</div>
                        @elseif(session('infoA'))
                        <div class="alert alert-secondary">{{session('infoA')}}</div>
                        @endif
                        <table class="table table-hover table-sm">
                            <thead>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Acción</th>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id)}}" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="javascript: document.getElementById('delete-{{ $product->id}}').submit()" class="btn btn-danger btn-sm">Eliminar</a>
                                        <form id="delete-{{$product->id}}" action="{{ route ('products.destroy', $product->id)}}" method="POST"> <!-- Formularios solo aceptan Post y Get -->
                                            @method('delete') <!-- Por eso se aclara para poder eliminar datos -->
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        Bienvenido {{ auth()->user()->name}}
                        <a href="javascript:document.getElementById('logout').submit()" class="btn btn-danger btn-sm float-right">Cerrar sesión</a>
                        <form action="{{ route ('logout')}}" id="logout" style="display:none" method="POST">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection