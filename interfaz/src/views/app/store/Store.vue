<template>
    <div>

<div class="wrapper">
    <nav id="sidebar" v-bind:class="{active : navActivo}">
        <div class="menu-head-contain">
				<img src="../../../assets/img/logo_en_fondo_oscuro.svg" alt="logo-increscendo" id="logo-sidebar-menu">
			</div>
        <div class="sidebar-header">
            <h3>Increscendo Store</h3>
        </div>
        <ul class="list-unstyled components">
            <p>Productos</p>
            <li> <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Instrumentos</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li> <a href="#">Guitarra</a> </li>
                    <li> <a href="#">Tambor</a> </li>
                </ul>
            </li>
            <li> <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Ropa</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li> <a href="#">Sudadero</a> </li>
                    <li> <a href="#">Blusa</a> </li>
                </ul>
            </li>
        </ul>
        <!-- <ul class="list-unstyled CTAs">
            <li> <a href="#" class="download">Subscribe</a> </li>
        </ul> -->
    </nav>
    <div class="content w-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-light"> 
            <button type="button" id="sidebarCollapse" class="btn btn-info" @click="navActivo = !navActivo">
                <i class="fa fa-align-justify"></i>
            </button> 
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"> <a class="nav-link" href="#">Iniciar Sesión <span class="sr-only">(current)</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#">Registrarse</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#">Home</a> </li>
                </ul>
            </div>
        </nav>
        <div class="content-wrapper">
            <!-- aquí contenido -->
        </div>
    </div>
</div>

    </div>
</template>
<script>
import "../../../assets/css/store.css";
import "../../../assets/css/menu-landing.css";

export default {
    name: "Store",
    data:() => ({
        navActivo: false
    })
};
</script>