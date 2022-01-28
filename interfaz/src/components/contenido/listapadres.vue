<template>
    <div>
        <table class="table table-hover">
            <thead class="table-secondary">
                <tr>
                    <th>Usuario</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(i, key) in select.contenido_padres" :key="key">
                    <td>{{i.nombre_completo}}</td>
                    <td class="text-right">
                        <button class="btn btn-outline-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
	import GlobalMixin from "../../mixins/Formulario.js";
    export default {
        mixins: [GlobalMixin],
        name: "listapadres",
        mounted(){
            this._getSelect(['contenido_padres'])
        }
    }
</script>