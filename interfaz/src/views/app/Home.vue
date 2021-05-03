<template>
<div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="javascript:;">PUBLICACIONES</a>
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<div class="collapse navbar-collapse " id="navbarSupportedContent">
					<form class="d-flex navbar-nav ml-auto" v-if="usuario.rol_id == 1">
						<button title="Nuevo publicación" class="btn btn-outline-primary" type="button" @click="_abrirFormulario">
							<i class="fas fa-plus"></i> Nueva publicación
						</button>
					</form>
				</div>
			</div>
		</div>
	</nav>

	<div v-if="verForm" class="card mt-2">
		<div class="card-body">
			<button type="button" class="close pr-2" aria-label="Close" @click="_cerrarFormulario">
				<span aria-hidden="true">&times;</span>
			</button>
			<form @submit.prevent="_guardar()">
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
					<input type="text" class="form-control" v-model="form.recurso">
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
	<div class="mt-2">
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
</div>
</template>
<script>
	import GlobalMixin from "../../mixins/Formulario.js";
	export default{
		name: "Home",
		mixins: [GlobalMixin],
		created(){
			if (this.$store.getters.isLoggedIn) {
				this.usuario = this.$store.state.usuario
			}
			this._getSelect(['tipo_recurso'])
			this.url = "/mantenimiento/publicacion"
			this._getDatos()
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