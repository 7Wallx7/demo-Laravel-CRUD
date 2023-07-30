@extends('layouts.main')

@section('tittle', 'Tipos de Eventos')
@section('content')



    <div class=" ms-3 ">
        <div class="border-bottom mt-3 pb-4">
            <p class="h2 "> <img src="/img/calendar-tipe.png" alt="Gruopo de personas" class="icon"> Listado de
                Tipo de Eventos</p>
        </div>
        <div class="mb-3 mt-3 ">

            <!-- Button trigger modal  Añadir Tipo de Evento-->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#añadirTipoEvento">
                <img src="/img/plus.svg" alt="Añadir Usuario" class="icoSidebar  ">Añadir Tipo de Evento
            </button>

            <button type="button" class="btn btn-primary">
                <a class="nav-link  text-light" aria-current="page" href="{{ route('tipe_events.index') }}">
                    <img src="/img/arrow-clockwise.svg" alt="Actualizar" class="icoSidebar  ">Actualizar</a>
            </button>

            <!-- Button trigger modal Añadir Usuario -->
            <button type="button" class="btn btn-primary">
                <a class="nav-link  text-light" aria-current="page" href="{{ url()->previous() }}">
                    <img src="/img/arrow-left.svg" alt="Volver" class="icoSidebar  "> Volver</a>
            </button>
            <!-- Errores -->
            @if (count($errors) > 0)
                <div class="alert alert-danger mt-3" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>



    <!-- Modal Añadir Tipo de Evento-->
    <div class="modal fade" id="añadirTipoEvento" tabindex="-1" aria-labelledby="modalLabelañadirTipoEvento"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelañadirUsuario">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tipe_events.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre Evento</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="background" class="form-label">Fondo</label>
                            <input type="color" class="form-control" id="background" name="background" list="colors"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="borde" class="form-label">Borde</label>
                            <input type="color" class="form-control" id="border" aria-describedby="bordeHelp"
                                name="border" list="colors" placeholder="Select Color" required>

                        </div>
                        <div class="mb-3">
                            <label for="texto" class="form-label">Texto</label>
                            <input type="color" class="form-control" id="texto" name="color_text" list="colors"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="shadow p-3 mb-5 bg-white rounded">
        <!-- Tabla Tipo de Eventos-->
        <table id="tabla" class="table table-striped table-hover table-bordered  " style="width:100%">
            <thead>
                <tr class="table-primary ">
                    <th class="text-white">ID</th>
                    <th class="text-white">Nombre Evento</th>
                    <th class="text-white">Fondo</th>
                    <th class="text-white">Borde</th>
                    <th class="text-white">Texto</th>
                    <th class="text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_tipe_events as $row)
                    <tr>
                        <td>{{ $row->id }}</th>
                        <td>{{ $row->nombre }}</td>
                        <td>{{ $row->background }}</td>
                        <td>{{ $row->color_text }}</td>
                        <td>{{ $row->border }}</td>
                        <td>


                            <!-- EDITAR MODAL -->
                            <button type="button" class="btn btn-primary d-inline" data-bs-toggle="modal"
                                data-bs-target="#{{ $row->id }}">
                                <img src="/img/pencil-square.svg" alt="Editar Usuario" class="icoSidebar">
                            </button>

                            <!-- DELETE  -->
                            <form action="{{ route('tipe_events.destroy', $row->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">
                                    <img src="/img/trash.svg" alt="Eliminar Usuario" class="icoSidebar d  "></button>
                            </form>


                            <!-- Modal Editar  -->
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

                                            <form action="{{ route('tipe_events.update', $row->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nombre Evento</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="nombre" value="{{ $row->nombre }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fondo" class="form-label">Fondo</label>
                                                    <input type="color" class="form-control" id="fondo"
                                                        name="background" value="{{ $row->background }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="border" class="form-label">Borde</label>
                                                    <input type="color" class="form-control" id="border"
                                                        aria-describedby="bordeHelp" name="border"
                                                        value="{{ $row->border }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="color_text" class="form-label">Texto</label>
                                                    <input type="color" class="form-control" id="color_text"
                                                        name="color_text" value="{{ $row->color_text }}" required>
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
