<template>
	<div>
		<div id="contenedorContenidos" v-if="actual == 1">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="javascript:;"><i class="fas fa-cogs"></i> CONFIGURACIÓN DE CONTENIDO</a>
				<div class="container-fluid">
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<div class="collapse navbar-collapse " id="navbarSupportedContent">
							<form @submit.prevent="_getDatos()" class="d-flex navbar-nav ml-auto">
								<input class="form-control me-2" type="search" placeholder="Término" v-model="bform.termino">
								<button class="btn btn-outline-success ml-2 mr-2" type="submit"><i class="fas fa-search"></i></button>
								<button v-if="usuario.rol_id == 1" title="Nuevo contenido" class="btn btn-outline-primary" type="button" @click="_abrirFormulario"><i class="fas fa-plus"></i></button>
							</form>
						</div>
					</div>
				</div>
			</nav>

			<div v-if="verForm && actual == 1" class="card mt-2">
				<div class="card-body border-0">
					<button type="button" class="close pr-2" aria-label="Close" @click="_cerrarFormulario">
						<span aria-hidden="true">&times;</span>
					</button>
					<form @click="fEspecial = false" @submit.prevent="_guardar()">
						<small class="text-primary ml-2"><i class="fas fa-exclamation-circle"></i> Información general</small>
						<div class="form-row col-sm-12">
							<label class="control-label">Nombre</label>
							<input type="text" class="form-control" v-model="form.nombre" required>
						</div>
						<div class="form-row col-sm-12 mt-2">
							<label class="control-label">Descripción</label>
							<wysiwyg id="descripcion" v-model="form.descripcion" class="border bg-white"/>
						</div>
						<div class="form-row col-sm-4" v-if="reg">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="switchTipo" :true-value="1" :false-value="0" v-model="form.activo">
								<label class="custom-control-label" for="switchTipo">Activo</label>
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

			<div class="card mt-2 border-0">
				<div class="card-body">
					<div class="col-sm-12 form-row" v-if="lista.length > 0 && !buscando">
						<div v-for="(i, key) in lista" :key="key" class="col-sm-3 mt-2">
							<div class="card mb-3">
								<div class="card-header">{{i.nombre}}</div>
								<div class="card-body">
									<p class="text-muted">
										<small>
											Docente: {{ (i.ndocente) ? i.adocente+' '+i.ndocente: 'Sin asignar' }} 
										</small>
									</p>
									<p class="card-text" v-html="i.descripcion"></p>
								</div>
								
								<div class="card-footer text-right">
									<button v-if="usuario.rol_id == 1" title="Editar" class="btn btn-outline-info mr-2" @click="_editar(key)">
										<i class="fas fa-edit"></i>
									</button>
									<button type="button" class="btn btn-primary m-0 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-cog"></i>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="javascript:;" @click="configContenido(key)">
											<i class="fas fa-wrench"></i> Configurar Contenido
										</a>
										<a v-if="usuario.rol_id == 1" class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#modalPadres" @click="setContenido(key)">
											<i class="fas fa-user-cog"></i> Activar contenido a padres
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 text-center p-5" v-if="buscando">
						<div class="spinner-grow" role="status">
							<span class="sr-only"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="contenedorPublicaciones" v-if="actual == 2">
			<div class="modal fade bd-example-modal-lg" id="modalDocente" ref="modalDocente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Configurar Docente</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form @submit.prevent="guardarDocente()">
							<div class="modal-body">
								<select class="form-control" v-model="docente.usuario_id">
									<option value="">Seleccionar Docente</option>
									<option v-for="i in select.usuario_root" :key="i.id" :value="i.id">{{ i.apellido }} {{ i.nombre }}</option>
								</select>
							</div>
							<div class="modal-footer">
								<button type="submit" :disabled="btnGuardando" class="btn btn-primary">
									<span v-if="btnGuardando" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
									<i class="fas fa-save" v-else></i>
									<span> {{ btnGuardando ? 'Guardando...' : 'Guardar'}}</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<button class="btn btn-outline-dark" @click="regresarContenido()"><i class="fas fa-arrow-left"></i></button>
				<div class="container-fluid">
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<div class="collapse navbar-collapse " id="navbarSupportedContent">
							<form @submit.prevent="_getDatos()" class="d-flex navbar-nav ml-auto">
								<input class="form-control me-2" type="search" placeholder="Término" v-model="bform.termino">
								<button class="btn btn-outline-success ml-2 mr-2" type="submit"><i class="fas fa-search"></i></button>
								<button
									v-if="usuario.rol_id == 1"
									title="Configurar docente" 
									data-toggle="modal" 
									data-target="#modalDocente" 
									class="btn btn-outline-primary mr-2" 
									type="button"
								>
									<i class="fas fa-user-plus"></i>
								</button>
								<button title="Nueva publicación" class="btn btn-outline-primary" type="button" @click="_abrirFormulario"><i class="fas fa-plus"></i></button>
							</form>
						</div>
					</div>
				</div>
			</nav>

			<div v-if="verForm && actual == 2" class="card mt-2">
				<div class="card-body">
					<button type="button" class="close pr-2" aria-label="Close" @click="cerrarFormulario">
						<span aria-hidden="true">&times;</span>
					</button>
					<form @submit.prevent="guardarPublicacion()">
						<small class="text-primary ml-2"><i class="fas fa-exclamation-circle"></i> Información general</small>
						<div class="form-row col-sm-12 mt-2">
							<div class="col-sm-6">
								<label class="control-label">Título</label>
								<input type="text" class="form-control" v-model="form.nombre" required>
							</div>
							<div class="col-sm-6 mt-2">
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" id="switchTipo" :true-value="1" :false-value="0" v-model="form.link">
									<label class="custom-control-label" for="switchTipo">LINK</label>
								</div>
								<div v-if="form.link == 1">
									<input type="text" class="form-control" placeholder="Link del recurso" v-model="form.archivo">
								</div>
								<div class="custom-file" v-else>
									<input type="file" class="custom-file-input" id="archivo" name="archivo" @change="_cargarImagen">
									<label class="custom-file-label" for="archivo">{{txt_imagen}}</label>
								</div>
							</div>
						</div>
						<div class="form-row col-sm-12 mt-2" v-if="form.link == 1">
							<label class="control-label">Tipo de Recurso</label>
							<select class="custom-select" v-model="form.tipo_recurso_id">
								<option value="">Seleccione una opción</option>
								<option v-for="(i, key) in select.tipo_recurso" :key="key" :value="i.id">{{i.nombre}}</option>
							</select>
						</div>
						<div class="form-row col-sm-12 mt-2">
							<label class="control-label">Descripción</label>
							<wysiwyg id="descripcion" v-model="form.descripcion" class="border bg-white"/>
						</div>
						<div class="form-row col-sm-4" v-if="reg">
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
					<table class="table table-hover" v-if="lista.length > 0 && !buscando">
						<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col">Nombre</th>
								<th scope="col">Descripción</th>
								<th scope="col">Fecha</th>
								<th scope="col">Recurso</th>
							</tr>
						</thead>
						<tbody>	
							<tr v-for="(i, key) in lista" :key="key">
								<th><i :class="i.icono"></i></th>
								<td>
									<a href="javascript:;" @click="_editar(key)">{{ i.nombre }}</a>
								</td>
								<td><small v-html="i.descripcion"></small></td>
								<td>{{ i.fecha_publicado }}</td>
								<td>
									<a :href="i.recurso_link" target="_blank" title="Abrir recurso">
										<i class="fas fa-external-link-square-alt"></i>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
					<div v-if="buscando" class="text-center col-sm-12 p-5">
						<div class="spinner-grow" role="status">
							<span class="sr-only">Cargando...</span>
						</div>
					</div>
					<div class="text-center col-sm-12 p-5" v-if="lista.length == 0">
						<h1 class="text-muted">
							<i class="fas fa-frown-open"></i>
							Aún no hay publicaciones.
						</h1>
					</div>
				</div>
			</div>
		</div>
		<div v-if="modal" class="modal fade" id="modalPadres" ref="modalPadres" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Activar contenido</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="col-sm-12">
						<form @submit.prevent="activarPadres()" :key="componentKey">
							<div class="modal-body">
								<div class="form-group" :key="selectKey">
									<Multiselect
										track-by="nombre_completo"
										label="nombre_completo"
										:multiple="true"
										placeholder="Selecciona usuarios para activar" 
										:searchable="true" 
										:allow-empty="false"
										v-model="selected"
										deselect-label="Click para remover"
										select-label="Click para agregar"
										:options="select.padres">
									</Multiselect>
								</div>
								<div class="form-group text-right">
									<button type="submit" :disabled="btnGuardando" class="btn btn-primary">
										<span v-if="btnGuardando" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
										<i class="fas fa-save" v-else></i>
										<span> {{ btnGuardando ? 'Activando...' : 'Activar'}}</span>
									</button>
								</div>
							</div>
						</form>
						<div>
							<listapadres :key="selectKey" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
	import GlobalMixin from "../../mixins/Formulario.js";
	import Multiselect from 'vue-multiselect';
	import listapadres from "@/components/contenido/listapadres.vue"
	export default {
		name: "ConfigContenido",
		mixins: [GlobalMixin],
		components: { Multiselect ,listapadres },
		data: () => {
			return {
				actual : 1,
				contenido : {},
				docente: {},
				padres_act: {},
				selected: null,
				modal: false,
				txt_imagen: "Elegir recurso",
				form:{
					archivo:{}
				},
				contenidoReg: null,
				selectKey : 0
			}
		},
		created(){
			if (this.$store.getters.isLoggedIn) {
				this.usuario = this.$store.state.usuario
			}
			this._getSelect(['tipo_recurso','usuario_root','padres'])
			this.url = "/mantenimiento/contenido"
			this.form.activo = 1;
			this.docente.usuario_id = ""
			this._getDatos()
			this.fEspecial = false
		},
		methods: {
			configContenido(idt){
				let dato = this.lista[idt]
				this.contenido = dato
				this.actual = 2
				this.url    = "/mantenimiento/contenido_publicacion"
				this.bform.contenido = this.contenido.id
				this._getDatos()
			},
			guardarPublicacion(){
				this.fEspecial = true
				this.form.contenido_id = this.contenido.id
				this.form.recurso      = this.form.recurso_link
				this._guardar()
			},
			eliminarPublicacion(idx){
				if(confirm("¿Seguro que quiere eliminar esta publicación?")){
					this.reg = idx.id
					this.fEspecial = true
					this.form = idx
					this.form.activo = 0
					this._guardar();
				}
			},
			cerrarFormulario(){
				this.txt_imagen = "Elegir imagen"
				this._cerrarFormulario();
			},
			guardarDocente(){
				this.fEspecial = false
				this.btnGuardando = true
				this.docente.contenido_id = this.contenido.id
				let datos = this.docente
				this._enviarPeticionPost({
					url: this.url+"/guardarDocente",
					arg: '',
					data: datos
				}).then((response) => {
					this.btnGuardando = false
					if (response.exito) {
						this._notificarSuccess(response.mensaje)
					}else{
						if (response.nivel == 2) {
							this._notificarWarning(response.mensaje)
						} else {
							this._notificarError(response.mensaje)
						}
					}
				})
			},
			setContenido(idt){
				let dato = this.lista[idt]
				this.contenido = dato
				this.modal = true
				this.contenidoReg = dato.id
				this.selectKey++
			},
			activarPadres(){
				this.url    = "/mantenimiento/contenido_publicacion"
				this.padres_act.contenido_id = this.contenido.id
				this.padres_act.usuarios 	 = this.selected
				this.btnGuardando = true
				let datos = this.padres_act
				this._enviarPeticionPost({
					url: this.url+"/activarPadres",
					arg: '',
					data: datos
				}).then((response) => {
					this.componentKey++
					this.url = "/mantenimiento/contenido"
					this.btnGuardando = false
					if (response.exito) {
						this.selected = null
						this._notificarSuccess(response.mensaje)
					}else{
						if (response.nivel == 2) {
							this._notificarWarning(response.mensaje)
						} else {
							this._notificarError(response.mensaje)
						}
					}
				})

			},
			regresarContenido(){
				this.actual 	= 1;
				this.contenido  = ''
				this.url 		= "/mantenimiento/contenido"
				this._getDatos()
			}
		}
	}
</script>