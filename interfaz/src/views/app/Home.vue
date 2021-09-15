<template>
<div>
	<nav class="navbar navbar-expand-lg rounded border">
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
				<div class="form-row col-sm-12 mt-2">
					<div class="col-sm-6">
						<label class="control-label">Título</label>
						<input type="text" class="form-control" v-model="form.nombre" required>
					</div>
					<div class="col-sm-6 mt-2">
						<div class="custom-file mt-4">
							<input type="file" class="custom-file-input" id="archivo" name="archivo" @change="_cargarImagen">
							<label class="custom-file-label" for="archivo">{{txt_imagen}}</label>
						</div>
					</div>
				</div>
				<div class="form-row col-sm-12 mt-2">
					<label class="control-label">Descripción</label>
					<wysiwyg id="descripcion" v-model="form.descripcion" class="border bg-white"/>
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
		<div class="col-sm-12 form-row" v-if="lista.length > 0 && !buscando">
			<div v-for="(i, key) in lista" :key="key" class="col-sm-6 mt-2" v-bind:class="{ 'col-sm-12' : i.tipo_recurso_id == 3 }" >
				<div class="card" style="max-height: 100%; height: 100%">
					<div class="card-body">
						<h5 class="card-title">{{ i.nombre }}</h5>
						<div class="contain-iframe-qs" v-if="i.tipo_recurso_id == 1">
							<iframe width="560" height="315" :src="'https://drive.google.com/uc?id='+i.recurso" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
						<div class="text-center" v-if="i.tipo_recurso_id==2">
							<img :src="'https://drive.google.com/uc?id='+i.recurso" class="img-fluid" alt="Responsive image">
						</div>
						<p class="card-text mt-2" v-html="i.descripcion" ></p>
						<div class="text-right">
							<small class="text-muted">{{ i.fecha_publicado}}</small>
						</div>
					</div>
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
			this.fEspecial = true
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

@media (min-width: 1200px) {
	.contain-iframe-qs {
		width: 100%;
		height: 0;
		padding-bottom: 56.25%;
		position: relative;
	}
}
</style>