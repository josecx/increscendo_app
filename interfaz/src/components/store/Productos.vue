<template>
    <div>
        <!-- Load -->
        <div class="col-12 text-center" v-if="buscando">
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
                            <h3>Q150,000.00</h3>
                            <p class="disponible-text"><i class="fas fa-check-circle"></i> Disponible</p>
                            <p class="existencias-text"><i class="fas fa-boxes"></i> Solo quedan 4</p>
                        </div>
                        <div class="cart-count-detail">
                            <p class="title-count-cart">Cantidad:</p>
                            <div class="count-inpt">
                                <button id='disminuir'>-</button>
                                <input class="m-d-ipt" type='text' value='1'>
                                <button id='aumentar'>+</button>
                            </div>
                            <button class="add-cart-btn"><i class="fas fa-shopping-cart"></i> Agregar al carrito</button>   
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
        producto: null
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
        }
    },
    created(){
        this.bform.subcategoria = this.subCat
        this.url = "/mantenimiento/store/producto"
        if(this.setActual){
            this.actual = this.setActual
            this.producto = this.setProducto
        } else {
            this._getDatos()
        }
    }
}
</script>