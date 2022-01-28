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
				<button type="button" class="close pr-2" aria-label="Close" @click="cerrarFormulario">
					<span aria-hidden="true">&times;</span>
				</button>
                <form @submit.prevent="guardarProducto">
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
						<wysiwyg required id="descripcion" v-model="form.descripcion" class="border bg-white"/>
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
                        <div class="col-sm-4 mt-2">
                            <div class="custom-file mt-4">
                                <input accept="image/*" type="file" class="custom-file-input" id="archivo" name="archivo" @change="cargarImagen">
                                <label class="custom-file-label" for="archivo">{{txt_imagen}}</label>
                            </div>
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
            <div class="card-body">
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody v-if="!buscando && lista.length > 0">
                        <tr v-for="(i, key) in lista" :key="key">
                            <td class="text-center">
                                <a href="javascript:;" data-toggle="modal" data-target="#modalImagen" @click="imagen = i.imagen">
                                    <img :src="'https://drive.google.com/uc?id='+i.imagen" class="img-thumbnail avatar m-0 p-0">
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="javascript:;" @click="_editar(key)">{{ i.nombre }}</a>
                            </td>
                            <td class="align-middle">{{i.ncategoria}}</td>
                            <td class="align-middle">{{i.nsubcategoria}}</td>
                            <td class="align-middle"><small v-html="i.descripcion"></small></td>
                            <td class="align-middle">{{i.precio_compra}}</td>
                            <td class="align-middle">{{i.precio_venta}}</td>
                            <td class="align-middle">{{i.fecha_sys}}</td>
                            <td class="align-middle text-center"><i v-if="i.favorito == 1" class="fas fa-star"></i></td>
                            <td class="align-middle">
                                <button @click="getListaImagen(i.id)" v-b-modal.modal-1 class="btn btn-outline-primary" title="Detalle de imágenes">
                                    <i class="fas fa-images"></i>
                                </button>
                            </td>
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
                        <img :src="'https://drive.google.com/uc?id='+imagen" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
            </div>
        </div>
        <b-modal hide-footer size="lg" id="modal-1" title="Detalle de imágenes">
            <div class="card mt-2">
                <div class="card-body">
                    <form @submit.prevent="guardarProductoImagen">
                        <div class="col-12">
                            <div class="custom-file">
                                <input accept="image/*" type="file" class="custom-file-input" id="archivo" name="archivo" @change="cargarImagen">
                                <label class="custom-file-label" for="archivo">{{txt_imagen}}</label>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <button type="submit" :disabled="btnGuardando" class="btn btn-primary mr-0 mb-0">
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
                                <th></th>
                                <th>Link</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody v-if="!buscandoExtra">
                            <tr  v-for="(i, key) in listaExtra" :key="key">
                                <td class="text-center">
                                    <img :src="'https://drive.google.com/uc?id='+i.imagen" class="img-thumbnail avatar m-0 p-0">
                                </td>
                                <td class="align-middle">
                                    <a :href="i.imagen_link" target="_blank">
                                        {{i.imagen_link}}
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-outline-red">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr v-if="buscandoExtra">
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
        </b-modal>
    </div>
</template>
<script>
import Formulario from "@/mixins/Formulario.js";
export default {
    name: "Producto",
    mixins: [Formulario],
    data:() =>({
        form: {
            categoria_id: '', 
            subcategoria_id: '',
            archivo:[]
        },
        imagen:     null,
        txt_imagen: "Elegir imagen",
        xproducto:  null,
    }),
    created(){
        this.url = "/mantenimiento/store/producto"
        this.buscarExtra  = "/getProductoImagen/"
        this.guardarExtra = false
        this._getSelect(['subcategoria','categoria'])
        this._getDatos()
        this.fEspecial = true
    },
    methods:{
        cargarImagen(e){
            let archivo = e.target.files || e.dataTransfer.files
            this.form.archivo = archivo[0]
            this.txt_imagen = archivo[0]["name"]
        },
        cerrarFormulario(){
            this.txt_imagen = "Elegir imagen"
            this._cerrarFormulario();
        },
        guardarProducto(){
            this.guardarExtra = false
            if (this.form.descripcion.trim() == "" || this.form.descripcion.trim() == null) {
                this._notificarWarning("La descripción es obligatoria")
            } else {
                this._guardar();
            }
        },
        guardarProductoImagen(){
            this.guardarExtra = true
            this.accionExtra  = "/productoImagen/"+this.xproducto
            this._guardar()
        },
        getListaImagen(id){
            this.xproducto    = id
            this.bform.producto_id = id
            this.guardarExtra = true
            this._getDatos()
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