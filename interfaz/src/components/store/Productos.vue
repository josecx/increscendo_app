<template>
    <div>
        <!-- Load -->
        <div class="col-12 text-center" v-if="buscando && actual == 1">
            <div class="spinner-border" role="status"></div>
        </div>
        <!-- Mensaje "sin existencias" -->
        <div class="col-12 text-center" v-if="lista.length == 0">
            <h2 class="text-muted">Aún no tenemos productos, pero pronto actualizaremos la tienda</h2>
        </div>
        <!-- Tarjeta de producto -->
        <!-- <div class="col-2" v-if="actual == 1 && !buscando">
            <div class="" v-for="(i, key) in lista" :key="key">
                <a href="javascript:;" @click="detalleProducto(i)">
                    <img :src="i.imagen_link" class="card-img-top">
                    <div class="">
                        <h4>{{i.nombre}}</h4>
                        <h6>Q {{i.precio_venta}}</h6>
                    </div>
                </a>
            </div>
        </div> -->


    <div class="gallery_store" v-if="actual == 1 && !buscando">
        <!--  -->
        <div class="content_categoria" v-for="(i, key) in lista" :key="key">
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





        <!-- Detalle del producto -->
        <div style="border:none;" class="card" v-if="actual == 2">
            
            <div class="cart-store-content">
                <div class="header-cart-detail">
                    <div>
                        <h2>{{producto.nombre}}</h2>
                        <p>SKU: 132154U</p>
                    </div>
                    <button v-if="!setActual" class="btn" @click="actual = 1"><i class="fas fa-arrow-left"></i></button>
                    <button v-else class="btn" @click="regresarFavoritos"><i class="fas fa-arrow-left"></i></button>
                </div>
                <div class="row-midlecart">
                    <div class="cart-img-content">
                        <div class="cart-img-box">
                            <div class="imag-product-box imag-product-box-active">
                                <img :src="producto.imagen_link">
                            </div>
                            <div class="imag-product-box">
                                <img :src="producto.imagen_link">
                            </div>
                            <div class="imag-product-box">
                                <img :src="producto.imagen_link">
                            </div>
                            <div class="imag-product-box">
                                <img :src="producto.imagen_link">
                            </div>
                            <div class="imag-product-box">
                                <img :src="producto.imagen_link">
                            </div>
                            <div class="imag-product-box">
                                <img :src="producto.imagen_link">
                            </div>
                        </div>
                        <div class="cart-img-box-principal">
                            <img :src="producto.imagen_link">
                        </div>
                    </div>
                    <div class="cart-detail">
                        <div class="cart-price">
                            <h3>Q{{producto.precio_venta}}</h3>
                            <p class="disponible-text"><i class="fas fa-check-circle"></i> Disponible</p>
                            <p class="existencias-text"><i class="fas fa-boxes"></i> Solo quedan 4</p>
                        </div>
                        <div class="cart-count-detail">
                            <p class="title-count-cart">Cantidad:</p>
                            <div class="count-inpt">
                                <button @click="setCantidad(2)" id='disminuir'>-</button>
                                <input class="m-d-ipt" type='number' v-model="form.cantidad" @keyup="calcular_total">
                                <button @click="setCantidad(1)" id='aumentar'>+</button>
                            </div>
                            <div class="count-inpt">
                                <input :key="itemKey" type="text" readonly v-model="form.total">
                            </div>
                            <button @click="agregar_carrito" class="add-cart-btn">
                                <span v-if="btnGuardando" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i v-else class="fas fa-shopping-cart"></i>
                                <span> {{ btnGuardando ? 'Agregando...' : 'Agregar al carrito'}}</span>
                            </button>   
                        </div>
                        <div class="cart-other-detail">
                            <button><i class="fas fa-heart"></i></button>
                        </div>
                    </div>
                </div>
                <!-- <div class="cart-especific-detail">
                    <table>
                        <th>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>2</td>
                        </th>
                    </table>
                </div> -->
            </div>




            <!-- <div class="card-header">
                <div class="col-12 form-row">
                    <div class="col-11">
                        <h2>{{producto.nombre}}</h2>
                    </div>
                    <div class="col-1 text-right">
                        <button class="btn btn-dark" @click="actual = 1"><i class="fas fa-backspace"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <img :src="producto.imagen_link" class="img-thumbnail avatar m-0 p-0">
            </div> -->
        </div>
        <!-- fin -->


    </div>
</template>
<script>
import Formulario from "@/mixins/Formulario.js"; 
import "../../assets/css/categoria_store.css";
export default {
    name: "ProductoDetalle",
    mixins: [Formulario],
    data:() => ({
        actual: 1,
        producto: null,
        itemKey:0,
        usuario: null
    }),
    props: {
        subCat: {
            type: String,
            required: false
        },
        setActual:{
            type: String,
            required: false
        },
        setProducto:{
            type: Object,
            required: false
        }
    },
    methods:{
        detalleProducto(item){
            this.actual = 2
            this.producto = item
            this.form.cantidad = 1;
            this.form.total = this.producto.precio_venta
        },
        agregar_carrito(){
            if(this.usuario){
                this.url = "/mantenimiento/store/carrito"
                this.form.producto_id = this.producto.id
                this._guardar()
                this.url = "/mantenimiento/store/producto"
            } else {
                this._notificarWarning("Debes iniciar sesión para poder comprar")
            }
        },
        setCantidad(caso){
            switch (caso) {
                case 1:
                    this.form.cantidad = this.form.cantidad + 1
                    break;
                case 2:
                    if(this.form.cantidad > 1)
                        this.form.cantidad = this.form.cantidad -1
                    break;
            }
            this.calcular_total()
        },
        calcular_total(){
            this.form.total = this.form.cantidad * this.producto.precio_venta
            this.itemKey++
        },
        regresarFavoritos(){
            this.actual = 3
        }
    },
    created(){
        if (this.$store.getters.isLoggedIn) {
			this.usuario = this.$store.state.usuario
		}
        this.form.cantidad = 1
        this.bform.subcategoria = this.subCat
        this.url = "/mantenimiento/store/producto"
        if(this.setActual){
            this.actual = this.setActual
            this.producto = this.setProducto
            this.calcular_total()
        } else {
            this._getDatos()
        }
    },
    watch:{
        btnGuardando(){
            if(this.btnGuardando == false){
                this.form.cantidad = 1
                this.calcular_total()
            }
        }
    }
}
</script>