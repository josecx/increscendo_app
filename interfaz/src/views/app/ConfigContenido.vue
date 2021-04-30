<template>
	<div>
		<div id="contenedorContenidos" v-if="actual == 1">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="javascript:;">CONTENIDOS</a>
				<div class="container-fluid">
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<div class="collapse navbar-collapse " id="navbarSupportedContent">
							<form @submit.prevent="_getDatos()" class="d-flex navbar-nav ml-auto">
								<input class="form-control me-2" type="search" placeholder="Término" v-model="bform.termino">
								<button class="btn btn-outline-success ml-2 mr-2" type="submit"><i class="fas fa-search"></i></button>
								<button title="Nuevo contenido" class="btn btn-outline-primary" type="button" @click="_abrirFormulario"><i class="fas fa-plus"></i></button>
							</form>
						</div>
					</div>
				</div>
			</nav>

			<div v-if="verForm && actual == 1" class="card mt-2">
				<div class="card-body">
					<button type="button" class="close pr-2" aria-label="Close" @click="_cerrarFormulario">
						<span aria-hidden="true">&times;</span>
					</button>
					<form @submit.prevent="_guardar()">
						<small class="text-primary ml-2"><i class="fas fa-exclamation-circle"></i> Información general</small>
						<div class="form-row col-sm-12">
							<label class="control-label">Nombre</label>
							<input type="text" class="form-control" v-model="form.nombre" required>
						</div>
						<div class="form-row col-sm-12 mt-2">
							<label class="control-label">Descripción</label>
							<input type="text" class="form-control" v-model="form.descripcion">
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
					<div class="col-sm-12 form-row">
						<div v-for="(i, key) in lista" :key="key" class="col-sm-4 mt-2">
							<div class="card" style="max-height: 100%; height: 100%">
								<div class="card-body">
									<p>{{ i.nombre }}</p>
									<p class="text-muted">
										<small>
											Docente: {{ (i.ndocente) ? i.adocente+' '+i.ndocente: 'Sin asignar' }} 
										</small>
									</p>
									<p><small>{{ i.descripcion | truncate(120, '...')}}</small></p>
								</div>
								<div class="card-footer text-right">
									<button title="Editar" class="btn btn-outline-info mr-2" @click="_editar(key)">
										<i class="fas fa-edit"></i>
									</button>
									<button title="Configurar Publicaciones" class="btn btn-outline-primary" @click="configContenido(key)">
										<i class="fas fa-cog"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="contenedorPublicaciones" v-if="actual == 2">
			<div class="modal fade" id="modalDocente" ref="modalDocente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
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
					<button type="button" class="close pr-2" aria-label="Close" @click="_cerrarFormulario">
						<span aria-hidden="true">&times;</span>
					</button>
					<form @submit.prevent="guardarPublicacion()">
						<small class="text-primary ml-2"><i class="fas fa-exclamation-circle"></i> Información general</small>
						<div class="form-row col-sm-12">
							<label class="control-label">Título</label>
							<input type="text" class="form-control" v-model="form.nombre" required>
						</div>
						<div class="form-row col-sm-12 mt-2">
							<label class="control-label">Descripción</label>
							<input type="text" class="form-control" v-model="form.descripcion">
						</div>
						<div class="form-row col-sm-12 mt-2">
							<label class="control-label">Tipo de recurso</label>
							<select class="form-control" v-model="form.tipo_recurso_id">
								<option value=""></option>
								<option v-for="i in select.tipo_recurso" :key="i.id" :value="i.id">{{ i.nombre }}</option>
							</select>
						</div>
						<div class="form-row col-sm-12 mt-2">
							<label class="control-label">Link a recurso</label>
							<input type="text" class="form-control" v-model="form.recurso_link">
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
								<td>{{ i.descripcion | truncate(80, '...') }}</td>
								<td>{{ i.fecha_publicado }}</td>
								<td>
									<a :href="i.recurso_link" target="_blank" title="Abrir recurso">
										<i class="fas fa-external-link-square-alt"></i>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import GlobalMixin from "../../mixins/Formulario.js";
	import Vue from 'vue'
	export default {
		name: "ConfigContenido",
		mixins: [GlobalMixin],
		data: () => {
			return {
				actual : 1,
				contenido : {},
				docente: {}
			}
		},
		created(){
			this.url = "/mantenimiento/contenido"
			this.form.activo = 1;
			this.docente.usuario_id = ""
			this._getSelect(['tipo_recurso','usuario_root'])
			this._getDatos()
		},
		methods: {
			configContenido(idt){
				let dato = this.lista[idt]
				this.contenido = dato
				this.actual = 2
				this.url    = "/mantenimiento/contenido_publicacion"
				this._getDatos()
			},
			guardarPublicacion(){
				this.form.contenido_id = this.contenido.id
				this.form.recurso      = this.form.recurso_link
				Vue.delete(this.form, 'fecha_publicado')
				Vue.delete(this.form, 'icono')
				this._guardar()
			},
			guardarDocente(){
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
					this.$bvModal.hide('modalDocente')
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