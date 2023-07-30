@extends('layouts.main')

@section('tittle', 'Eventos')

@push('datapicker')
    <!--  DateTimePicker  -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
@endpush

@section('content')


    <div class="container">
        <!-- Añadir Evento -->
        <button type="button" class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#añadirUsuario">
            Añadir Evento
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

        <!-- Modal Añadir Evento -->
        <div class="modal fade" id="añadirUsuario" tabindex="-1" aria-labelledby="modalLabelañadirUsuario"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabelañadirUsuario">Añadir Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('events.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Evento</label>
                                <input type="text" class="form-control" id="event" name="event" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Fecha Inicio</label>
                                <input class="form-control" id="start_date" type="datetime-local" name="start_date"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Fecha Fin</label>
                                <input class="form-control" id="end_date" type="datetime-local" name="end_date" required>
                            </div>
                            <div class="mb-3">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="id_tipe_event" name="id_tipe_event">
                                    @foreach ($tipe_events as $row)
                                        <option name="id_tipe_event" id="id_tipe_event" value="{{ $row->id }}">
                                            {{ $row->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>




        <div id="calendar">
        </div>
    </div>

    <!-- Modal Edit y Eliminar Event-->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="titulo">Registro de Eventos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Editar Tipo de Evento-->
                <form id="formulario" autocomplete="off" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input id="title" type="text" class="form-control" name="event" required>
                                    <label for="title">Evento</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="start" class="form-label">Fecha Inicio</label>
                                    <input class="form-control" id="start" type="datetime-local" name="start_date"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="end" class="form-label">Fecha Inicio</label>
                                    <input class="form-control" id="end" type="datetime-local" name="end_date"
                                        required>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            id="id_tipe_event" name="id_tipe_event">
                                            @foreach ($tipe_events as $row)
                                                <option name="id_tipe_event" id="id_tipe_event"
                                                    value="{{ $row->id }}">
                                                    {{ $row->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ms-3">
                        <button type="submit" class="btn btn-primary" id="btnAccion">Modificar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>

                <!-- Eliminar Evento-->
                <form method="POST" id="eliminarEvento" class="ms-3">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="
https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js
"></script>
@push('scripts')
    <script>
        //Obteniendo elementos
        var calendarEl = document.getElementById('calendar');
        var frm = document.getElementById('formulario');
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        var myModalAñadir = new bootstrap.Modal(document.getElementById('añadirUsuario'));
        document.addEventListener('DOMContentLoaded', function() {
            calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'UTC',
                locale: 'es',
                events: @json($events),
                height: 700,
                firstDay: 1,
                allDaySlot: false,
                slotLabelInterval: '00:30:00',
                slotMinTime: '09:00',
                slotMaxTime: '21:30',
                slotLabelFormat: [{
                    minute: '2-digit',
                    hour: 'numeric',
                }],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'timeGridFourDay',
                views: {
                    timeGridFourDay: {
                        type: 'timeGrid',
                        duration: {
                            days: 5
                        }
                    },

                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día'
                },
                /*
                    Cuando se hace click en una fecha en concreto se abre un Modal para añadir evento
                     */
                dateClick: function(info) {
                    myModalAñadir.show();
                },
                /*
                Cuando se hace click en un evento en concreto se abre un Modal y se inserta los datos de ese
                evento en los diferentes inputs
                 */
                eventClick: function(info) {
                    //Seleccionar el tipo de evento establecido en tal evento y cambiar ruta con el ID del mismo
                    $(`[value=${info.event.extendedProps.id_tipe_event[0].id}]`).attr("selected", "");
                    var routeID = "events/" + info.event.id;
                    //Añadir valores del evento al Modal
                    document.getElementById('title').value = info.event.title;
                    document.getElementById('start').value = info.event.startStr.slice(0, 16)
                    document.getElementById('end').value = info.event.endStr.slice(0, 16)
                    document.getElementById('titulo').textContent = 'Actualizar Evento';
                    document.getElementById('eliminarEvento').setAttribute("action", routeID);
                    frm.setAttribute("action", routeID);

                    //Mostrar Modal
                    myModal.show();
                },
            });

            calendar.render();
        })
    </script>
@endpush
