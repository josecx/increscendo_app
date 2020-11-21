<template>
	<div>
		<form @submit.prevent="recuperarPass()">
			<label>Correo</label>
			<input type="text" :required="true" v-model="datos.correo">
			<br>
			<button type="submit">Recuperar contraseña</button>
		</form>
	</div>
</template>
<script>
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