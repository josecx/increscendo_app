<template>
        <div>
            <div v-if="etapa == 1">
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
                                    <td><img :src="'https://drive.google.com/uc?id='+i.imagen" height="100px" alt="logo-increscendo" id="logo-sidebar-menu"></td>
                                    <td>{{i.nproducto}}</td>
                                    <td>{{i.precio_venta}}</td>
                                    <td><input class="chec-cant-cart" @change="actualizar(i)" limit="0" type="number" id="points" name="points" v-model="i.cantidad" step="1"></td>
                                    <td>{{i.total}}<span class="delete-from-list-cart" @click="eliminar(i)"><i class="far fa-trash-alt"></i></span></td>
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
                                <td id="btn-submit-cart-pay">
                                    <button @click="comprar">Continuar con la compra</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div v-if="etapa == 2">
                <Orden 
                    :departamentos="select.departamento"
                    :municipios="select.municipio"
                    :total="total"
                    :productos="lista"
                />
            </div>
        </div>
</template>
<script>
import "../../assets/css/carrito.css";
import Formulario from "@/mixins/Formulario.js";
import Orden from "@/components/store/OrdenVenta.vue"
export default {
    name: "Carrito",
    mixins: [Formulario],
    data:() => ({
        subtotal:0,
        etapa: 1
    }),
    created(){
        this.url = "/mantenimiento/store/carrito"
        this._getDatos()
        this._getSelect(['departamento', 'municipio'])
    },
    methods:{
        actualizar(idx){
            if(idx.cantidad >= 0){
                this.reg = idx.id
                this.form = idx
                this.buscando = true
                this._guardar()
            } else {
                this._notificarWarning("Debes ingresar una cantidad válida")
            }
        },
        eliminar(idx){
            if(confirm("¿Deseas eliminar este producto de tu carrito?")){
                this.reg = idx.id
                this.form = idx
                this.form.cantidad = 0
                this.buscando = true
                this._guardar()
            }
        },
        comprar(){
            if (confirm("¿Está seguro?")) {
                this.etapa = 2
            }
        }
    },
    computed: {
        total () {
            return this.lista.reduce( (acc, row) => {
            return acc + parseFloat(row.total)
            }, 0)
        }
    },
    components: {Orden}
}
</script>