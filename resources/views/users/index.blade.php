@extends('layouts.main')

@section('tittle', 'Usuarios')

@section('content')

    <div class=" ms-3 ">
        <div class="border-bottom mt-3 pb-4">
            <p class="h2 "> <img src="/img/multiple-users-silhouette.png" alt="Gruopo de personas" class="icon"> Listado de
                Usuario</p>
        </div>
        <div class="mb-3 mt-3 ">

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#añadirUsuario">
                <img src="/img/plus.svg" alt="Añadir Usuario" class="icoSidebar  "> Añadir Usuario
            </button>

            <button type="button" class="btn btn-primary">
                <a class="nav-link  text-light" aria-current="page" href="{{ route('users.index') }}">
                    <img src="/img/arrow-clockwise.svg" alt="Actualizar" class="icoSidebar  ">Actualizar</a>
            </button>

            <!-- Button trigger modal Añadir Usuario -->
            <button type="button" class="btn btn-primary">
                <a class="nav-link  text-light" aria-current="page" href="{{ url()->previous() }}">
                    <img src="/img/arrow-left.svg" alt="Volver" class="icoSidebar  "> Volver</a>
            </button>
            <!-- Errores -->
            @if (count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <!-- Modal  Añadir Usuario-->
    <div class="modal fade" id="añadirUsuario" tabindex="-1" aria-labelledby="modalLabelañadirUsuario" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelañadirUsuario">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre usuario</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" class="form-control" id="login" name="login" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="activated" name="activated">
                            <label class="form-check-label" for="activated">
                                Activado
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="shadow p-3 mb-5 bg-white rounded">
        <!-- Tabla Usuarios -->
        <table id="tabla" class="table table-striped table-hover table-bordered shadow p-3 mb-5 bg-white rounded  "
            style="width:100%">
            <thead>
                <tr class="table-primary ">
                    <th class="text-white">ID</th>
                    <th class="text-white">Nombre</th>
                    <th class="text-white">Email</th>
                    <th class="text-white">login</th>
                    <th class="text-white">Activado</th>
                    <th class="text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $row)
                    <tr>
                        <td>{{ $row->id }}</th>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->login }}</td>
                        <td>
                            @if ($row->activated == '1')
                                Activado
                            @else
                                Desactivado
                            @endif
                        </td>
                        <td>


                            <button type="button" class="btn btn-primary d-inline" data-bs-toggle="modal"
                                data-bs-target="#{{ $row->id }}">
                                <img src="/img/pencil-square.svg" alt="Editar Usuario" class="icoSidebar">
                            </button>
                            <form action="{{ route('users.destroy', $row->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">
                                    <img src="/img/trash.svg" alt="Eliminar Usuario" class="icoSidebar d  "></button>
                            </form>
                            <!-- Modal  Editar usuario-->
                            <div class="modal fade" id="{{ $row->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="{{ route('users.update', $row->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ $row->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="login" class="form-label">Login</label>
                                                    <input type="text" class="form-control" id="login"
                                                        name="login" value="{{ $row->login }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        aria-describedby="emailHelp" name="email"
                                                        value="{{ $row->email }}" required>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="activated"
                                                        name="activated">
                                                    <label class="form-check-label" for="activated">
                                                        Activado
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>




@endsection



