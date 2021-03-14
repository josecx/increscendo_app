<template>
	<div id="bg-login">
		<div class="content-form-login">
			<div class="form-login">
				<form @submit.prevent="recuperarPass()">
				<div class="logo-label">	
					<img src="../assets/img/logo_secundario_en_fondo_oscuro.svg" alt="logo-increscendo" id="logo-sidebar-menu">
				</div>
				<div class="user-label">	
					<label>Usuario</label>
					<input type="text" v-model="form.usuario" placeholder="Ingresa tu usuario">
				</div>
				<div class="submit-label">
					<button type="submit" :disabled="btnGuardar">
						<span v-if="btnGuardar" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						<span> {{ btnGuardar ? 'Enviando...' : 'Recuperar contraseña'}}</span>
					</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</template> 
<script>
	import "../assets/css/login.css";
	import GlobalMixin from "../mixins/global-mixin.js";
	export default{
		name:   "RecuperarPass",
		mixins: [GlobalMixin],
		data: () => {
			return {
				form: {
					usuario: null
				},
				token: "",
				btnGuardar: false
			}
		},
		created(){
			this.token = this.$route.params.token ?? ""
		},
		methods: {
			recuperarPass(){
				this.args = { url: "/usuario/recuperarPassword/", data: this.form, arg: ''}
				this._enviarDatos(this.args).then((response) => {
					this.args = []
					if (response.data.exito) {
						this.$router.push({name: "Login"})
					}
				})
			}
		}
	}
</script>