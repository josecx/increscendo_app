<template>
    <div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="javascript:;"><i class="fas fa-box-open"></i> PRODUCTOS</a>
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
                            <label class="control-label">Nombre</label>
                            <input type="text" class="form-control" v-model="form.nombre" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Código</label>
                            <input type="text" class="form-control" v-model="form.codigo" required>
                        </div>
                    </div>
					<div class="form-row col-sm-12 mt-2">
						<label class="control-label">Descripción</label>
						<wysiwyg id="descripcion" v-model="form.descripcion" class="border bg-white"/>
					</div>
                    <div class="form-row col-sm-12 mt-2">
                        <div class="col-sm-6">
                            <label class="control-label">Categoria</label>
                            <select class="custom-select" v-model="form.categoria_id">
                                <option value="">----------</option>
                                <option v-for="(i, key) in select.categoria" :key="key" :value="i.id">{{i.nombre}}</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">SubCategoria</label>
                            <select class="custom-select" v-model="form.subcategoria_id">
                                <option value="">----------</option>
                                <option v-for="(i, key) in getSubCategoria" :key="key" :value="i.id">{{i.nombre}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row col-sm-12 mt-2">
                        <div class="col-sm-4">
                            <label class="control-label">Precio de compra</label>
                            <input type="number" step="0.1" class="form-control" v-model="form.precio_compra">
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label">Precio de venta</label>
                            <input type="number" step="0.1" class="form-control" v-model="form.precio_venta" required>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label">Link a imagen</label>
                            <input type="text" class="form-control" v-model="form.imagen" required>
                        </div>
                        
                    <div class="form-row col-sm-2 mt-2" v-if="reg" >
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="switchActivo" :true-value="1" :false-value="0" v-model="form.activo">
                            <label class="custom-control-label" for="switchActivo">Activo</label>
                        </div>
                        <div class="custom-control ml-4 custom-switch">
                            <input type="checkbox" class="custom-control-input" id="switchFavorito" :true-value="1" :false-value="0" v-model="form.favorito">
                            <label class="custom-control-label" for="switchFavorito">Favorito</label>
                        </div>
                    </div>
					<div class="col-sm-12 mt-2 text-right">
						<button type="submit" :disabled="btnGuardando" class="btn btn-primary">
							<span v-if="btnGuardando" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
							<i class="fas fa-save" v-else></i>
							<span> {{ btnGuardando ? 'Guardando...' : 'Guardar'}}</span>
						</button>
					</div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-2">
            <div class="car-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Subcategoría</th>
                            <th>Descripción</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Fecha</th>
                            <th>Favorito</th>
                        </tr>
                    </thead>
                    <tbody v-if="!buscando && lista.length > 0">
                        <tr v-for="(i, key) in lista" :key="key">
                            <td class="text-center">
                                <a href="javascript:;" data-toggle="modal" data-target="#modalImagen" @click="imagen = i.imagen_link">
                                    <img :src="i.imagen_link" class="img-thumbnail avatar m-0 p-0">
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="javascript:;" @click="_editar(key)">{{ i.nombre }}</a>
                            </td>
                            <td class="align-middle">{{i.ncategoria}}</td>
                            <td class="align-middle">{{i.nsubcategoria}}</td>
                            <td class="align-middle">{{ (i.descripcion) ? i.descripcion : '---' | truncate(100, '...') }}</td>
                            <td class="align-middle">{{i.precio_compra}}</td>
                            <td class="align-middle">{{i.precio_venta}}</td>
                            <td class="align-middle">{{i.fecha_sys}}</td>
                            <td class="align-middle"><i v-if="i.favorito == 1" class="fas fa-star"></i></td>
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
        <div v-if="imagen" class="modal fade" id="modalImagen" tabindex="-1" role="dialog" aria-labelledby="modalImagen" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img :src="imagen" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Formulario from "@/mixins/Formulario.js";
import Vue from 'vue';
export default {
    name: "Producto",
    mixins: [Formulario],
    data:() =>({
        form: {categoria_id: '', subcategoria_id: ''},
        imagen: null
    }),
    created(){
        this.url = "/mantenimiento/store/producto"
        this._getSelect(['subcategoria','categoria'])
        this._getDatos()
    },
    methods:{
        guardar(){
            if(this.reg){
                Vue.delete(this.form, "ncategoria")
                Vue.delete(this.form, "fecha_sys")
                Vue.delete(this.form, "nsubcategoria")
            }
            this._guardar()
        }
    },
    computed: {
        getSubCategoria(){
            if (this.form.categoria_id) {
                return this.select.subcategoria.filter(e => {
                    return e.categoria_id == this.form.categoria_id
            })
            } else {
                return []
            }	
        },
    }
}
</script>