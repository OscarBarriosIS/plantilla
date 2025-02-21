<style>
    /* Estilos del menú lateral */
    .barra-lateral {
        width: 250px;

        background-color: #fcffff;
        background-image: url("https://www.transparenttextures.com/patterns/beige-paper.png");


        color: rgb(0, 0, 0);
        height: 100vh;
        padding-top: 10px;
        position: fixed;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        transition: width 0.3s ease;
        overflow-y: auto;
        top: 0;
        /* Asegura que comience desde la parte superior */
        left: 0;
        /* Asegura que comience desde la izquierda */
    }

    /* Estilos cuando el menú lateral está colapsado */
    .barra-lateral.colapsada {
        width: 90px;
    }

    .barra-lateral.colapsada .espacioLogo {
        padding: 10px;
    }

    .barra-lateral.colapsada .texto-menu {
        display: none;
    }

    .barra-lateral.colapsada .logo {
        margin-top: 40%;
        width: 50px;
        height: auto;
    }

    /* Estilos de la información del usuario */
    .espacioLogo {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        text-align: center;
        margin-bottom: 0;
        border-bottom: 1px solid #ccc;
        /* Adds a subtle border */
    }

    /* Estilos del logo */
    .logo {
        margin-top: 40px;
        width: 200px;
        height: auto;
        transition: width 0.3s ease, height 0.3s ease;
    }

    /* Estilos de los enlaces del menú */
    .barra-lateral a,
    .desplegable-menu {
        color: rgb(0, 0, 0);
        padding: 10px 20px;
        text-decoration: none;
        font-size: 16px;
        display: flex;
        align-items: center;
        margin-bottom: 0;
        text-align: left;
        border-bottom: 1px solid #ccc;
        /* Adds a subtle border */
    }

    .barra-lateral a:hover,
    .desplegable-menu:hover {
        background-color: #29ABE2;
        padding-left: 25px;
        box-shadow: none;
    }

    .barra-lateral a i,
    .desplegable-menu i {
        margin-right: 15px;
        font-size: 20px;
    }

    /* Estilos de los submenús */
    .submenu {
        display: none;
        padding-left: 10px;
        margin-top: 0px;
    }

    .submenu li a {
        font-size: 16px;
        color: black;
        padding: 8px 15px;
        display: block;
        border-radius: 5px;
        margin-bottom: 2px;
        text-decoration: none;
    }

    .submenu li a:hover {
        background-color: #585858;
        box-shadow: none;
    }

    .submenu.activo {
        display: block;
    }

    .submenu li a i {
        margin-right: 10px;
        font-size: 18px;
    }

    /* Estilos del botón desplegable del menú */
    .desplegable-menu {
        cursor: pointer;
        justify-content: space-between;
    }

    .desplegable-menu i:last-child {
        display: none;
    }

    .desplegable-menu.activo {
        background-color: #29ABE2;
        color: rgb(0, 0, 0);
    }

    .desplegable-menu.activo+.submenu li a {
        color: black;
    }

    /* Estilos del botón para colapsar el menú lateral */
    .boton-colapsar {
        position: absolute;
        top: 10px;
        left: 0;
        color: #29ABE2;
        padding: 8px;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        z-index: 1001;
    }

    .boton-colapsar i {
        font-size: 1.2em;
    }

    /* Estilos del menú "First" */
    .salir {
        background: #29ABE2;
        /* Asegura que el ancho sea el mismo que los otros elementos */
        width: 100%;
        padding: 10px 20px;
        /* Consistent padding */
        text-align: left;
        /* Aligns text to the left */
        display: flex;
        /* Uses flexbox for alignment */
        align-items: center;
        /* Vertically centers the icon and text */
        box-sizing: border-box;
        /* Includes padding and border in the element's total width and height */
        color: white !important;
        text-decoration: none;
        /* Removes underline from the link */
        border-bottom: none;
        /* Removes the border */
    }

    .salir:hover {
        background-color: #4c0e20;
        color: rgb(0, 0, 0) !important;
    }

    .salir i {
        color: white;
        margin-right: 15px;
        /* Consistent margin */
        font-size: 20px;
        /* Consistent icon size */
    }
</style>

<div class="barra-lateral" id="barraLateral">
    <div class="boton-colapsar" id="botonColapsar"><i class="fas fa-bars"></i></div>

    <div class="espacioLogo">
        <img src="{{ asset('img/logo.png') }}" class="logo" alt="Logo">
    </div>

    <a href="/dashboard">
        <i class="fas fa-home"></i> <span class="texto-menu">Inicio</span>
    </a>
    <a href="{{ route('perfil.show') }}">
        <i class="fas fa-user"></i> <span class="texto-menu">Perfil</span>
    </a>


    @role('Admin')
        <a href="#" class="desplegable-menu" data-menu="usuarios">
            <i class="fas fa-person"></i> <span class="texto-menu">Usuarios</span>
        </a>
        <ul class="submenu">
            <li><a href="{{ route('user.create') }}"><i class="fas fa-plus-circle"></i> <span
                        class="texto-menu">Alta</span></a></li>
            <li><a href="{{ route('user.index') }}"><i class="fas fa-search"></i> <span
                        class="texto-menu">Consulta</span></a></li>
        </ul>
    @endrole

    <a href="{{ route('logout') }}" class="salir"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> <span class="texto-menu">Cerrar Sesión</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
