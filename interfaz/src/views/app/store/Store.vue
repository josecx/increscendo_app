<template>
    <div>
        <div class="wrapper">
            <nav id="sidebar" v-bind:class="{active: navActivo}">
                <div class="menu-head-contain">
                        <img src="../../../assets/img/logo_en_fondo_oscuro.svg" alt="logo-increscendo" id="logo-sidebar-menu">
                    </div>
                <div class="sidebar-header">
                    <h3>Increscendo Store</h3>
                </div>
                <div class="text-center" v-if="!select.categoria">
                    <div class="spinner-border" role="status">
                    </div>
                </div>
                <ul class="list-unstyled components" :key="componentKey">
                    <li v-if="select.categoria"><a @click="verInicio" data-toggle="collapse" aria-expanded="false">Inicio</a></li>
                    <!-- <p>Productos</p> -->
                    <li v-for="(i, key) in select.categoria" :key="key">
                        <a :href="'#submenu'+i.nombre" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">{{i.nombre}}</a>
                        <ul v-for="(j, jkey) in filtrarSubCategoria(i.id)" :key="jkey" class="collapse list-unstyled" :id="'submenu'+i.nombre">
                            <li> <a href="javascript:;" @click="setSubCategoria(j.id)">{{j.nombre}}</a> </li>
                        </ul>
                    </li>
                </ul>
                <!-- <ul class="list-unstyled CTAs">
                    <li> <a href="#" class="download">Subscribe</a> </li>
                </ul> -->
            </nav>
            <div class="content-navbar-store" v-bind:class="{'topbar-active': navActivo, 'topbar': !navActivo}">
                <nav class="navbar navbar-expand-lg navbar-light bg-light sticky fixed-top"> 
                    <button type="button" id="sidebarCollapse" class="btn btn-info" @click="navActivo = !navActivo">
                        <i class="fa fa-align-justify"></i>
                    </button> 
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto nav-menu-store-sesion">
                            <li class="nav-item"> <a @click="verCarrito()" class="nav-link" href="javascript:;"><i class="fas fa-shopping-cart"></i></a></li>
                            <li class="nav-item active">
                                <span class="nav-link" v-if="usuario">Hola {{usuario.nombre}}!</span>
                                <a class="nav-link" href="javascript:;" v-b-modal.modal-login v-else @click="caso=1">
                                    Iniciar Sesión <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item" v-if="!usuario">
                                <a class="nav-link" href="javascript:;" v-b-modal.modal-login @click="caso=2">Registrarse</a>
                            </li>
                            <li class="nav-item" v-if="usuario">
                                <a class="nav-link" href="javascript:;" @click="logout">Cerrar sesión</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="../">Home</a> </li>
                        </ul>
                    </div>
                </nav>
                <div class="content-wrapper" :key="componentKey" v-if="subCat || setproducto">
                    <Productos :subCat="subCat" :setActual="setactual" :setProducto="setproducto"/>
                </div>
                <div class="content-wrapper" :key="componentKey" v-if="vercarrito">
                    <Carrito />
                </div>
                <div class="content-wrapper" v-if="!subCat && !vercarrito && verfavorito">
                    <div class="text-center" v-if="!select.productos_favoritos">
                        <div class="spinner-border" role="status">
                        </div>
                    </div>
                    <div class="gallery_store" v-else>
                        <div class="content_categoria" v-for="(i, key) in select.productos_favoritos" :key="key">
                            <img class="product_img_categoria" :src="i.imagen_link">
                            <h3 class="categoria_h3">{{i.nombre}}</h3>
                            <p class="p_store_categoria">Descripción del producto</p>
                            <h6 class="price_categoria">Q {{i.precio_venta}}</h6>
                            <ul class="stars_categoria">
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            </ul>
                            <a href="javascript:;" @click="detalleProducto(i)">
                                <button class="buy-1 btn_cards_categoria">Comprar</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <b-modal id="modal-login" ref="modal-login" hide-footer>
            <template #modal-title>
                <span v-if="caso==1">Iniciar Sesión</span>
                <span v-else>Registrarse</span>
            </template>
            <div class="d-block">
                <div v-if="caso==1">
                    <form @submit.prevent="login">
                        <div class="form-row col-sm-12 mt-2">
                            <div class="col-sm-12">
                                <label class="control-label">Usuario</label>
                                <input type="text" class="form-control" v-model="form.usuario" required>
                            </div>
                            <div class="col-sm-12">
                                <label class="control-label">Contraseña</label>
                                <input type="text" class="form-control" v-model="form.password" required>
                            </div>
                        </div>
                        <b-button class="mt-3" type="submit" block :disabled="btnGuardar">
                            <span v-if="btnGuardar" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span> {{ btnGuardar ? 'Entrando...' : 'Entrar'}}</span>
                        </b-button>
                    </form>
                </div>
                <div v-else>
                    <form @submit.prevent="registrarse">
                        <div class="form-row col-sm-12 mt-2">
                            <div class="col-sm-12">
                                <label class="control-label">Nombre</label>
                                <input type="text" class="form-control" v-model="form.nombre" required>
                            </div>
                            <div class="col-sm-12">
                                <label class="control-label">Apellido</label>
                                <input type="text" class="form-control" v-model="form.apellido" required>
                            </div>
                        </div>
                        <div class="form-row col-sm-12 mt-2">
                            <div class="col-sm-12">
                                <label class="control-label">Correo</label>
                                <input type="text" class="form-control" v-model="form.correo" required>
                            </div>
                            <div class="col-sm-12">
                                <label class="control-label">Usuario</label>
                                <input type="text" class="form-control" v-model="form.usuario" required>
                            </div>
                        </div>
                        <b-button class="mt-3" type="submit" block :disabled="btnGuardar">
                            <span v-if="btnGuardar" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span> {{ btnGuardar ? 'Enviando...' : 'Registrarse'}}</span>
                        </b-button>
                    </form>
                </div>
            </div>
        </b-modal>
    </div>
</template>
<script>
import "../../../assets/css/store.css";
import "../../../assets/css/menu-landing.css";
import "../../../assets/css/categoria_store.css";
import Formulario from "@/mixins/Formulario.js";
import Productos from "@/components/store/Productos.vue"
import Carrito from "@/components/store/Carrito.vue"

export default {
    name: "Store",
    mixins: [Formulario],
    data:() => ({
        navActivo: false,
        subCat: null,
        btnGuardar: false,
        caso: 1,
        usuario: null,
        vercarrito: false,
        setactual: null,
        setproducto: null,
        verfavorito: true
    }),
    created(){
		if (this.$store.getters.isLoggedIn) {
			this.usuario = this.$store.state.usuario
		}
        this._getSelect(['categoria','subcategoria', 'productos_favoritos'])
    },
    methods: {
        filtrarSubCategoria(cat_id){
			return this.select.subcategoria.filter(e => {
				return e.categoria_id == cat_id
			})
        },
        setSubCategoria(subId){
            this.setactual = null
            this.setproducto = null
            this.componentKey++
            this.subCat = subId
            this.vercarrito = false
        },
        verCarrito(){
            this.vercarrito = true
            this.subCat = false
        },
        verInicio(){
            this.vercarrito = false
            this.subCat = null
            this.verfavorito = true
        },
        detalleProducto(item){
            this.componentKey++
            this.setactual = "2"
            this.setproducto = item
        },
        // FUNCIONES DE SESION
        login(){
            this.btnGuardar = true
            this.args = {
                url:  '/sesion/login/',
                data: this.form,
                arg:  ''
            };
            this._enviarDatos(this.args).then((response) => {
                this.btnGuardar = false
                this.args = []
                if (response.data.exito) {
                    this.$store.dispatch('login', response.data).then(res => {
                        this.usuario = res.registro
                        let $ref = this.$refs["modal-login"]
                        $ref.hide()
                    })
                }
            })
        },
        logout(){
            if(confirm("¿Deseas cerrar sesión?")){
                this.$store.dispatch('logout')
                .then(() => {
                    this.usuario = null
                })
            }
        },
        registrarse(){
            this.form.rol_id = 5
            this.args = {
                url:  '/usuario/guardar/',
                data: this.form,
                arg:  ''
            };
            this._enviarDatos(this.args).then((response) => {
                this.args = []
                if (response.data.exito) {
                    this.caso = 1
                    this.form = {}
                }
            })
        },
    },
    components: {Productos, Carrito}
};
</script>