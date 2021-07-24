<template>
    <div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="javascript:;"><i class="fas fa-th"></i> SUBCATEGORÍAS</a>
			<div class="container-fluid">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<div class="collapse navbar-collapse " id="navbarSupportedContent">
						<form @submit.prevent="_getDatos()" class="d-flex navbar-nav ml-auto">
							<input class="form-control me-2" type="search" placeholder="Término" v-model="bform.termino">
							<button class="btn btn-outline-success ml-2 mr-2" type="submit"><i class="fas fa-search"></i></button>
							<button title="Nueva categoría" class="btn btn-outline-primary" type="button" @click="_abrirFormulario"><i class="fas fa-plus"></i></button>
						</form>
					</div>
				</div>
			</div>
		</nav>
        <div class="card mt-2" v-if="verForm">
            <div class="card-body">
				<button type="button" class="close pr-2" aria-label="Close" @click="_cerrarFormulario">
					<span aria-hidden="true">&times;</span>
				</button>
                <form @submit.prevent="guardar()">
                    <small class="text-primary ml-2"><i class="fas fa-exclamation-circle"></i> Información general</small>
                    <div class="form-row col-sm-12 mt-2">
                        <div class="col-sm-6">
                            <label class="control-label">Categoria</label>
                            <select class="custom-select" v-model="form.categoria_id">
                                <option value="">----------</option>
                                <option v-for="(i, key) in select.categoria" :key="key" :value="i.id">{{i.nombre}}</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Nombre</label>
                            <input type="text" class="form-control" v-model="form.nombre" required>
                        </div>
                    </div>
					<div class="form-row col-sm-12 mt-2">
						<label class="control-label">Descripción</label>
						<wysiwyg id="descripcion" v-model="form.descripcion" class="border bg-white"/>
					</div>
                    <div class="form-row col-sm-12 mt-2" v-if="reg" >
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="switchActivo" :true-value="1" :false-value="0" v-model="form.activo">
                            <label class="custom-control-label" for="switchActivo">Activo</label>
                        </div>
                    </div>
					<div class="col-sm-12 mt-2 text-right">
						<button type="submit" :disabled="btnGuardando" class="btn btn-primary">
							<span v-if="btnGuardando" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
							<i class="fas fa-save" v-else></i>
							<span> {{ btnGuardando ? 'Guardando...' : 'Guardar'}}</span>
						</button>
					</div>
                </form>
            </div>
        </div>

		<div class="card mt-2">
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
                            <th scope="col">Categoría</th>
							<th scope="col">Descripción</th>
							<th scope="col">Fecha</th>
						</tr>
					</thead>
					<tbody v-if="!buscando && lista.length > 0">
						<tr v-for="(i, key) in lista" :key="key">
							<td>
								<a href="javascript:;" @click="_editar(key)">{{ i.nombre }}</a>
							</td>
                            <td>{{ i.ncategoria }}</td>
							<td>{{ (i.descripcion) ? i.descripcion : '---' | truncate(100, '...') }}</td>
                            <td>{{ i.fecha_sys }}</td>
						</tr>
					</tbody>
                    <tfoot>
                        <tr v-if="buscando">
                            <td colspan="100">
                                <div class="text-center">
                                    <div class="spinner-border" role="status">
                                    </div>
                                    <p>Buscando...</p>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
				</table>
			</div>
		</div>

    </div>
</template>
<script>
import Formulario from "@/mixins/Formulario.js";
import Vue from 'vue';
export default {
    name: "SubCategoria",
    mixins: [Formulario],
    data:() => ({
        form: {categoria_id : ''}
    }),
    created(){
        this.url = "/mantenimiento/store/subcategoria"
        this._getDatos()
        this._getSelect(['categoria'])
    },
    methods:{
        guardar(){
            if(this.reg){
                Vue.delete(this.form, "ncategoria")
                Vue.delete(this.form, "fecha_sys")
            }
            if(this.form.activo == false){
                if(confirm("Al desactivar esta subcategoría se inabilitarán los productos relacionados ¿Desea continuar?")){
                    this._guardar()
                }
            } else {
                this._guardar()
            }
        }
    }
}
</script>