<template>
	<div>
		<label for="">usuario</label>
		<input type="text" v-model="form.usuario">
		<br>
		<label for="">contraseña</label>
		<input type="password" v-model="form.password">
		<br>
		<button v-on:click="login()">LOGIN</button>
		<br>
		<router-link :to="{ name:'RecuperarPassword' }">
			¿Se te olvidó tu contraseña?
		</router-link>
	</div>
</template>
<script>
	import GlobalMixin from "../mixins/global-mixin.js";
	export default {
		name:   "Login",
		mixins: [GlobalMixin],
		data: () => {
			return {
				form: {
					usuario:  null,
					password: null
				}
			}
		},
		methods: {
			login(){
				this.args = {
					url:  '/sesion/login/',
					data: this.form,
					arg:  ''
				};
				this._enviarDatos(this.args).then((response) => {
					this.args = []
					if (response.data.exito) {
						this.$store.dispatch('login', response.data).then(() => {
							this.$router.push({name: "Home"})
						})
					}
				})
			},
		}
	}
</script>