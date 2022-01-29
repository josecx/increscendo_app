<template>
    <div>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="comprar">
                    <div class="form-row col-sm-12 mt-2">
                        <div class="col-sm-6">
                            <label class="control-label">Nombre</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="form.nombre"
                                required
                            />
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Correo</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="form.correo"
                                required
                            />
                        </div>
                    </div>
                    <div class="form-row col-sm-12 mt-2">
                        <div class="col-sm-6">
                            <label class="control-label">Departamento</label>
                            <select 
                                class="custom-select"
                                v-model="form.departamento_id"
                            >
                                <option value="">----------</option>
                                <option
                                    v-for="(i,key) in departamentos"
                                    :value="i.id"
                                    :key="key"
                                >
                                    {{i.nombre}}
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Municipio</label>
                            <select 
                                class="custom-select"
                                v-model="form.municipio_id"
                            >
                                <option value="">----------</option>
                                <option
                                    v-for="(i,key) in municipio"
                                    :value="i.id"
                                    :key="key"
                                >
                                    {{i.nombre}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row col-sm-12 mt-2">
                        <label class="control-label">Dirección</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="form.direccion"
                            required
                        />
                    </div>
                    <div class="form-row col-sm-12 mt-2">
                        <div class="col-sm-6">
                            <label class="control-label">Teléfono</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="telefono"
                                required
                            />
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">NIT</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="form.nit"
                                required
                            />
                        </div>
                    </div>
                    <div class="form-row col-sm-12 mt-2">
                        <label class="control-label">Observaciones</label>
                        <wysiwyg
                            required
                            id="descripcion"
                            v-model="form.observaciones"
                            class="border bg-white"
                        />
                    </div>
                    <div class="col-sm-12 mt-2 text-right">
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i> Comprar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Formulario from "@/mixins/Formulario.js";
export default {
    name: "OrdenVenta",
    mixins: [Formulario],
    data:() => ({
        form : {
            nit: "C/F",
            departamento_id: ""
        }
    }),
    props: {
        departamentos:{
            type: Array,
            required: true
        },
        municipios:{
            type: Array,
            required: true
        },
        productos:{
            type: Array,
            required: true
        },
        total:{
            type: String,
            required: true
        }
    },
    created(){
		if (this.$store.getters.isLoggedIn) {
			this.usuario = this.$store.state.usuario
            this.form.nombre = this.usuario.nombre + " " + this.usuario.apellido
            this.form.correo = this.usuario.correo
		}
        this.url = "/mantenimiento/store/ordenventa"
    },
    methods:{
        comprar(){
            if (confirm("¿Está seguro?")) {
                this._guardar()
            }
        }
    },
    computed: {
        municipio(){
            if (this.form.departamento_id) {
                return this.municipios.filter((e) => {
                    return e.departamento_id == this.form.departamento_id;
                });
            } else {
                return []
            }
        }
    }
}
</script>