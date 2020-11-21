<template>
	<div>
		<form @submit.prevent="cambiarpass()">
			<label >Introduce tu contraseña actual</label>
			<input type="password" :required="true" v-model="datos.pass_actual">
			<br>
			<label >Intruduce tu nueva contraseña</label>
			<input type="password" :required="true" v-model="datos.pass_nuevo" v-on:change="validarNuevo()">
			<button type="submit">Cambiar</button>
		</form>
	</div>
</template>
<script>
	import GlobalMixin from "../mixins/global-mixin.js";
	import store from '../store';
	export default{
		name:   "CambiarPassword",
		mixins: [GlobalMixin],
		data: () => {
			return {
				datos: {
					pass_actual: null,
					pass_nuevo:  null,
					usuario:     null
				},
				args: []
			}
		},
		created(){
			this.datos.usuario = store.state.usuario
		},
		methods: {
			cambiarpass(){
				var sha1 = require('sha1');
				this.datos.pass_actual = sha1(this.datos.pass_actual)
				this.datos.pass_nuevo = sha1(this.datos.pass_nuevo)
				this.args = {
					url:  '/usuario/cambiarPassword/',
					data: this.datos,
					arg:  ''
				};
				this._enviarDatos(this.args).then((response) => {
					if (response.data.exito) {
						this.$router.push({name: "Home"})
					}
				})
			},
			validarNuevo(){
				if (this.datos.pass_actual == this.datos.pass_nuevo) {
					this._notificarWarning("La nueva contraseña debe ser distinta a la actual")
				}
			}
		}
	}
</script>