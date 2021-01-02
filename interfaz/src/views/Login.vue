<template>
	<div id="bg-login">
		<div class="content-form-login">
			<div class="form-login">
				<div class="logo-label">	
					<img src="../assets/img/logo_secundario_en_fondo_oscuro.svg" alt="logo-increscendo" id="logo-sidebar-menu">
				</div>
				<div class="user-label">	
					<label for="">Usuario</label>
					<input type="text" v-model="form.usuario" placeholder="Ingrese su usuario">
				</div>
				<div class="password-label">
					<label for="">Contraseña</label>
					<input type="password" v-model="form.password" placeholder="Ingrese su contraseña">
				</div>
				<div class="submit-label">
					<button>Inicio</button>
					<button v-on:click="login()">Entrar</button>
				</div>
				<div class="forgot-label">
					<router-link :to="{ name:'RecuperarPassword' }">
						¿Se te olvidó tu contraseña?
					</router-link>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import "../assets/css/login.css";
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