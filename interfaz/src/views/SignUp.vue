<template>
	<div id="bg-login">
		<div class="content-form-login">
			<div class="form-login">
				<form @submit.prevent="guardarUsuario()">
				<div class="logo-label">	
					<img src="../assets/img/logo_secundario_en_fondo_oscuro.svg" alt="logo-increscendo" id="logo-sidebar-menu">
				</div>
				<div class="user-label">	
					<label for="">Nombre
						<span style="color: red">*</span>
					</label>
					<input type="text" v-model="form.nombre">
				</div>
				<div class="password-label">
					<label for="">Apellido
						<span style="color: red">*</span>
					</label>
					<input type="text" v-model="form.apellido">
				</div>
				<div class="password-label">
					<label for="">Correo
						<span style="color: red">*</span>
					</label>
					<input type="text" v-model="form.correo" @change="validarCorreo()">
				</div>
				<div class="password-label">
					<label for="">Usuario
						<span style="color: red">*</span>
					</label>
					<input type="text" v-model="form.usuario">
				</div>
				<div class="password-label">
					<div v-for="(sexo, index) in sexos" :key="index">			
						<input type="checkbox" :value="sexo.id" v-model="form.sexo_id" v-on:click= "check_one()">
						<label>{{sexo.nombre}}</label><br>
					</div>
				</div>
				<div class="submit-label">
					<button type="submit">Registrarme</button>
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
		name:   'SignUp',
		mixins: [GlobalMixin],
		data: () => {
			return {
				sexos: [],
				args:  [],
				exito: false,
				form:  {
					correo:   null,
					apellido: null,
					nombre:   null,
					usuario:  null,
					sexo_id:  []
				}
			}
		},
		created(){
			this.getSexo()
		},
		methods: {
			getSexo(){
				this.args = { url: "/usuario/getSexo"}
				this._getLista(this.args).then((response) => {
                    this.args  = []
                    this.sexos = response.lista
                })
			},
			guardarUsuario(){
				this.args = {
					url:  '/usuario/guardar/',
					data: this.form,
					arg:  ''
				};
				if (this.exito) {	
					this._enviarDatos(this.args).then((response) => {
						this.args = []
						if (response.data.exito) {
							this.$router.push({name: "Login"})
						}
					})
				}
			},
			check_one(){
				this.form.sexo_id = []
			},
			validarCorreo(){
				this.args = { url: "/usuario/validarCorreo", data: { params: { "correo" : this.form.correo } }}
				this._getLista(this.args).then((response) => {
					if (response.exito) {
						this._notificarError(response.mensaje)
						this.exito = false
					} else{
						this.exito = true
					}
                })
			}
		}
	}
</script>