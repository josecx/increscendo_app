<template>
    <div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="javascript:;"><i class="fas fa-box"></i> CATEGORÍAS</a>
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
					<div class="form-row col-sm-12">
						<label class="control-label">Nombre</label>
						<input type="text" class="form-control" v-model="form.nombre" required>
					</div>
					<div class="form-row col-sm-12">
						<label class="control-label">Descripción</label>
						<wysiwyg id="descripcion" v-model="form.descripcion" class="border bg-white"/>
					</div>
                    <div class="form-row col-sm-12" v-if="reg">
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
							<th scope="col">Descripción</th>
							<th scope="col">Fecha</th>
						</tr>
					</thead>
					<tbody v-if="!buscando && lista.length > 0">
						<tr v-for="(i, key) in lista" :key="key">
							<td>
								<a href="javascript:;" @click="_editar(key)">{{ i.nombre }}</a>
							</td>
							<td><small v-html="i.descripcion"></small></td>
                            <td>{{ i.fecha_sys }}</td>
						</tr>
					</tbody>
                    <tfoot>
                        <tr v-if="buscando">
                            <td colspan="100">
                                <div class="text-center">
                                    <div class="spinner-border" role="status">
                                    </div>
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
export default {
    name: "Categoria",
    mixins: [Formulario],
    created(){
        this.url = "/mantenimiento/store/categoria"
        this._getDatos()
    },
    methods:{
        guardar(){
            if(this.form.activo == false){
                if(confirm("Al desactivar esta categoría se inabilitarán las subcategorías y productos relacionados ¿Desea continuar?")){
                    this._guardar()
                }
            } else {
                this._guardar()
            }
        }
    }
}
</script>