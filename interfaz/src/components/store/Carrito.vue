<template>
        <div>
            <h2 class="title-carrito">Carrito de compras</h2>
            <div class="content-cart">
                <div class="list-product-cart">
                    <table class="table-product-cart">
                        <thead>
                            <tr class="encabezado-list-cart">
                                <th>Artículo</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody v-if="!buscando">
                            <tr class="line-list-product" v-for="(i, key) in lista" :key="key">
                                <td><img :src="i.imagen_link" height="100px" alt="logo-increscendo" id="logo-sidebar-menu"></td>
                                <td>{{i.nproducto}}</td>
                                <td>{{i.precio_venta}}</td>
                                <td><input @change="actualizar(i)" type="number" id="points" name="points" v-model="i.cantidad" step="1"></td>
                                <td>{{i.total}}</td>
                            </tr>
                        </tbody>
                        <tr v-if="buscando">
                            <td colspan="100">
                                <div class="text-center">
                                    <div class="spinner-border" role="status">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="resume-cart">
                    <h2>Resumen</h2>
                    <!-- <p>Use width: 100% to create a full-width table:</p> -->
                    <table class="table-resume-cart">
                        <tr>
                            <td>Subtotal <span>Q{{total}}</span></td>
                        </tr>
                        <tr>
                            <td>Total de la Orden <span>Q{{total}}</span></td>
                        </tr>
                        <tr>
                            <td id="btn-submit-cart-pay"><button>Continuar con la compra</button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
</template>
<script>
import "../../assets/css/carrito.css";
import Formulario from "@/mixins/Formulario.js";
export default {
    name: "Carrito",
    mixins: [Formulario],
    data:() => ({
        subtotal:0
    }),
    created(){
        this.url = "/mantenimiento/store/carrito"
        this._getDatos()
    },
    methods:{
        actualizar(idx){
            this.reg = idx.id
            this.form = idx
            this._guardar()
        }
    },
    computed: {
        total () {
            return this.lista.reduce( (acc, row) => {
            return acc + parseFloat(row.total)
            }, 0)
        }
    }
}
</script>