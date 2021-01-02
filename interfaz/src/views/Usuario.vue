<template>
	<div>
		<Lista
		/>
	</div>
</template>
<script>
	import Lista from "../components/usuario/Lista.vue"
	import GlobalMixin from "../mixins/global-mixin.js";
	export default{
		name: "Usuario",
		mixins: [GlobalMixin],
		data: () => {
			return{
				usuarios: []
			}
		},
		created(){
			this.getUsuario()
		},
		methods:{
			getUsuario(){
				this._getLista({url: "/usuario/getUsuario"}).then((response) => {
					console.log(response)
				})
			}
		},
		components: {
			Lista
		}
	}
</script>