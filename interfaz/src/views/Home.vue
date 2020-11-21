<template>
	<div>
		<span v-if="isLoggedIn">
			<button v-on:click="logout">Logout</button>
			<router-link :to="{ name:'CambiarPassword' }">
				Cambiar contraseña
			</router-link>
		</span>
		<router-view/>
	</div>
</template>
<script>
	export default {
		name: 'Home',
		computed : {
			isLoggedIn : function(){ return this.$store.getters.isLoggedIn}
		},
		methods: {
			logout(){
				this.$store.dispatch('logout')
				.then(() => {
					this.$router.push({name: "Login"})
				})
			},
		}
	}
</script>