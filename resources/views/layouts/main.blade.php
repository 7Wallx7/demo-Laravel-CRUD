<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMJ - @yield('tittle')</title>
    <!--  Bootstrap  -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

    <link href="css/dataTables.bootstrap5.min.css" rel="stylesheet">


    @stack('datapicker')
</head>

<body>

    <!--  Sidebar -->
    <div class="container-fluid  text-light">
        <div class="row flex-nowrap ">
            <div class="col-auto px-0  ">
                <div id="sidebar" class="collapse collapse-horizontal show ">
                    <div id="sidebar-nav" class="list-group  text-sm-start min-vh-100 text-light  bg-primary">
                        <!--  Titulo -->
                        <h4 class="text-center m-3 pb-3 border-bottom">
                            Demo SIMJ
                        </h4>
                        <!--  Usuario -->
                        <p class="ms-5 "> <img class="rounded-circle pb-1" alt="SIMJ" src="/img/SIMJ.png"
                                width="40" height="40" /> <span class="fs-5 fw-bold ps-3">
                                {{ Auth::user()->name }}</span>
                        </p>
                        <!--  Buscador -->
                        <div class="ps-2 pb-3 mt-4">
                            <form class="d-flex" role="search">
                                <input class="form-control rounded-start " type="search" placeholder="Buscar..."
                                    aria-label="Search">
                                <button class="btn rounded-end  bg-info me-2 " type="submit"><img src="/img/search.svg"
                                        alt="search" class="icoSidebar"></button>
                            </form>
                        </div>

                        <!--  Menú -->
                        <!--  Faltaría mt-4 para el ti -->
                        <ul class="nav   flex-column nav-pills  mt-4">
                            <li class="nav-item">
                                <h6 class="ms-4">MENU</h6>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  text-light fw-bold  border-0  rounded mx-2 " aria-current="page"
                                    href="{{ route('events.index') }}">
                                    <img src="/img/home.svg" alt="Inicio"
                                        class="icoSidebar d-inline-block align-text ">
                                    Inicio</a>
                            </li>
                            <div class="accordion accordion-flush">
                                <div class="">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed text-light fw-bold bg-primary"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#SubCalendar"
                                            aria-expanded="true" aria-controls="flush-collapseOne">
                                            <img src="/img/calendar.svg" alt="Calendar"
                                                class="icoSidebar d-inline-block align-text ms-2"> <span
                                                class="px-2">Calendario</span>
                                        </button>
                                    </h2>
                                    <!--  SubMenú -->
                                    <div id="SubCalendar"
                                        class="accordion-collapse  {{ Request::is('events', 'tipe_events') ? '' : 'collapse' }} "
                                        data-bs-parent="#accordionFlushExample">
                                        <ul class="nav flex-column nav-pills">
                                            <li class="nav-item bg-primary ps-2">
                                                <a class="nav-link text-light  {{ Request::is('events') ? 'bg-info' : '' }} "
                                                    aria-current="page" href="{{ route('events.index') }}">
                                                    <img src="/img/calendar-tipe.png" alt="calendar-tipe"
                                                        class="icoSidebar d-inline-block align-text ms-2"><span
                                                        class="px-2">Calendar</span></a>
                                            </li>
                                            <li class="nav-item bg-primary ps-2">
                                                <a class="nav-link  text-light  {{ Request::is('tipe_events') ? 'bg-info' : '' }}"
                                                    href="{{ route('tipe_events.index') }}">
                                                    <img src="/img/calendar.svg" alt="Tipos de eventos"
                                                        class="icoSidebar d-inline-block align-text ms-2 "><span
                                                        class=" px-2">Tipo de Eventos</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion accordion-flush">
                                <div class="">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed text-light fw-bold bg-primary"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#Administracion" aria-expanded="false"
                                                aria-controls="flush-collapseOne">
                                                <img src="/img/user-check.svg" alt="user-check"
                                                    class="icoSidebar d-inline-block align-text ms-2"> <span
                                                    class="px-2">Administración</span>
                                            </button>
                                        </h2>
                                        <!--  SubMenú -->
                                        <div id="Administracion"
                                            class="accordion-collapse   bg-primary {{ Request::is('users') ? '' : 'collapse' }}"
                                            data-bs-parent="#accordionFlushExample">
                                            <ul class="nav flex-column nav-pills  bg-primary  ">
                                                <li class="nav-item ps-2">
                                                    <a class="nav-link  text-light  {{ Request::is('users') ? 'bg-info' : '' }}"
                                                        aria-current="page" href="{{ route('users.index') }}">
                                                        <img src="/img/users.svg" alt="users"
                                                            class="icoSidebar d-inline-block align-text ms-2"><span
                                                            class="px-2">Usuarios</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <!--  Contenido  -->

            <main class="col ps-md-2 pt-2 text-dark ">
                <!--  NAV -->
                <nav class="nav">
                    <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse"
                        class="nav-link text-primary fw-bold "><i class="bi bi-list bi-lg py-2 p-1"></i> <img
                            src="/img/menu.svg" alt="Inicio" class="d-inline-block align-text ms-2 mb-1 icoMain">
                        Menú</a>
                    <a class="nav-link text-primary fw-bold" href="#">
                        <img src="/img/home.svg" alt="Calendar" class="d-inline-block align-text ms-2 mb-1 icoMain">
                        Inicio</a>
                    <ul class="navbar-nav ms-auto">
                        <a class="nav-link text-primary fw-bold" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <img src="/img/box-arrow-in-right.svg" alt="logout"
                                class="icoMain d-inline-block align-text ms-2 ">
                            {{ __('Salir') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </nav>
                @yield('content')@section('content')
                <footer class=" text-center text-lg-start ">
                    <!-- Copyright -->
                    <div class="text-center pt-2 pb-2 bg-info">
                        © 2020 Copyright:
                        <a class="text-dark mb-5" href="#">Soluciones Informaticas MJ. S.C.A.</a>
                    </div>
                </footer>
            </main>
        </div>
    </div>


    <!--  Bootstrap  -->
    <script src="js/bootstrap.bundle.js"></script>
    <!--  JQuery  -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/mainScript.js"></script>



    @stack('scripts')
</body>

</html>
