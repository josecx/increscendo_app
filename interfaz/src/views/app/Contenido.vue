<template>
	<div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<button v-if="actual == 2" class="btn btn-outline-dark" @click="regresarContenido()"><i class="fas fa-arrow-left"></i></button>
			<a v-else class="navbar-brand" href="javascript:;">CONTENIDOS</a>
			<div class="container-fluid">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<div class="collapse navbar-collapse " id="navbarSupportedContent">
						<form v-if="actual == 1" @submit.prevent="_getDatos()" class="d-flex navbar-nav ml-auto">
							<input class="form-control me-2" type="search" placeholder="Término" v-model="bform.termino">
							<button class="btn btn-outline-success ml-2 mr-2" type="submit"><i class="fas fa-search"></i></button>
						</form>
					</div>
				</div>
			</div>
		</nav>
		<div class="card" v-if="actual == 1">
			<div class="card-body">
				<div class="col-sm-12 form-row" v-if="lista.length > 0 && !buscando">
					<div v-for="(i, key) in lista" :key="key" class="col-sm-4 mt-2">
						<div class="card" style="max-height: 100%; height: 100%" @click="configContenido(key)">
							<div class="card-body" style="cursor: pointer">
								<p>{{ i.nombre }}</p>
								<p class="text-muted">
									<small>
										Docente: {{ (i.ndocente) ? i.adocente+' '+i.ndocente: 'Sin asignar' }} 
									</small>
								</p>
								<p><small>{{ i.descripcion | truncate(120, '...')}}</small></p>
							</div>
						</div>
					</div>
				</div>
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
		<div class="card mt-4" v-if="actual == 2">
			<div class="mt-2" v-if="lista.length > 0">
				<div v-for="(i, key) in lista" :key="key" class="card mt-4" style="width: 100%;">
					<div class="contain-iframe-qs" v-if="i.tipo_recurso_id == 1">
						<iframe width="560" height="315" :src="i.recurso" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
					<div class="contain-iframe-qs text-center" v-if="i.tipo_recurso_id==2">
						<img :src="i.recurso" style="height:70vh;">
					</div>
					<div class="card-body">
						<h5 class="card-title">{{ i.nombre }}</h5>
						<p class="card-text">{{ i.descripcion }}</p>
						<div class="text-right">
							<small class="text-muted">{{ i.fecha_publicado}}</small>
						</div>
					</div>
				</div>
			</div>
			<div class="mt-2 text-center p-5" v-if="lista.length == 0">
				<h1 class="text-muted">
					<i class="fas fa-frown-open"></i>
					Aún no hay publicaciones.
				</h1>
			</div>
			<div v-if="buscando" class="text-center col-sm-12 p-5">
				<div class="spinner-grow" role="status">
					<span class="sr-only">Cargando...</span>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import GlobalMixin from "../../mixins/Formulario.js";
	export default {
		name: "Contenido",
		mixins: [GlobalMixin],
		data: () => {
			return {
				actual : 1,
				contenido : {}
			}
		},
		created(){
			this.url = "/mantenimiento/contenido"
			this._getDatos()
		},
		methods:{
			configContenido(idt){
				let dato = this.lista[idt]
				this.contenido = dato
				this.url    = "/mantenimiento/contenido_publicacion"
				this.bform.contenido = this.contenido.id
				this._getDatos()
				this.actual = 2
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
	<style>
		.contain-iframe-qs {
			width: 100%;
			height: 0;
			padding-bottom: 56.25%;
			position: relative;
		}

		.contain-iframe-qs iframe {
			position: absolute;
			width: 100%;
			height: 100%;
		}
	</style>