<template>
	<div id="bg-login">
		<div class="content-form-login">
			<div class="form-login">
				<form @submit.prevent="recuperarPass()">
				<div class="logo-label">	
					<img src="../assets/img/logo_secundario_en_fondo_oscuro.svg" alt="logo-increscendo" id="logo-sidebar-menu">
				</div>
				<div class="user-label">	
					<label>Correo</label>
					<input type="text" :required="true" v-model="datos.correo" placeholder="Ingresa tu correo">
				</div>
				<div class="submit-label">
					<button type="submit">Recuperar contraseña</button>
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
				datos: {
					correo:   null,
					registro: null
				},
				token: ""
			}
		},
		created(){
			this.token = this.$route.params.token ?? ""
			console.log(this.$route)
		},
		methods: {
			recuperarPass(){
				this.args = { url: "/usuario/validarCorreo", data: { params: { "correo" : this.datos.correo } }}
				this._getLista(this.args).then((response) => {
					if (response.exito) {
						this.datos.registro = response.registro
						this.args = {
							url:  '/usuario/recuperarPassword/',
							data: this.datos,
							arg:  ''
						};
						this._enviarDatos(this.args).then((response) => {
							if (response.data.exito) {
								this.$router.push({name: "Login"})
							}
						})
					} else{
						this._notificarError("ningún usuario posee este correo")
					}
                })
			}
		}
	}
</script>