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
        <div class="card" v-if="actual == 2">
            <div class="card-header">
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
            </div>
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
            required: true
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
        this._getDatos()
    }
}
</script>