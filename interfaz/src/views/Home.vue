<template>
	<div>
		<div class="header-nav-home">
			<div class="contain-menu-home">
				<img src="../assets/img/logo_secundario_en_fondo_oscuro.svg" height="50px" alt="logo increscendo">
				<nav id="menu-home-top">
					<a href="">
						<i id="icon-help-home" class="fas fa-question-circle"></i>
					</a>
				</nav>
			</div>
			<a href="">
				<img style="height: 50px; border-radius: 50%; overflow: hidden; width: 50px;" src="https://lh3.googleusercontent.com/ogw/ADGmqu-OhZUCi5QCe_spoPL-8B7VV9JQ3VUWZw4FtDiCcg=s83-c-mo" alt="">
			</a>
		</div>
		<div class="panel-lateral">
			<div class="contain-panel-lateral">
				<div class="contain-items-home">
					<div class="box-menu-icons">
						<span class="icon-bx-menu"><i class="fas fa-address-book"></i></span>
						<span class="text-bx-menu">Icono</span>
					</div>
					<div class="box-menu-icons">
						<span class="icon-bx-menu"><i class="fas fa-address-book"></i></span>
						<span class="text-bx-menu">Icono</span>
					</div>
					<div class="box-menu-icons">
						<span class="icon-bx-menu"><i class="fas fa-address-book"></i></span>
						<span class="text-bx-menu">Icono</span>
					</div>
					<div class="box-menu-icons">
						<span class="icon-bx-menu"><i class="fas fa-address-book"></i></span>
						<span class="text-bx-menu">Icono</span>
					</div>
					<div class="box-menu-icons">
						<span class="icon-bx-menu"><i class="fas fa-address-book"></i></span>
						<span class="text-bx-menu">Icono</span>
					</div>
					<div class="box-menu-icons">
						<span class="icon-bx-menu"><i class="fas fa-address-book"></i></span>
						<span class="text-bx-menu">Icono</span>
					</div>
					<div class="box-menu-icons">
						<span class="icon-bx-menu"><i class="fas fa-address-book"></i></span>
						<span class="text-bx-menu">Icono</span>
					</div>
				</div>
			</div>
		</div>
		<div class="main-home">
			<div class="component-change-home"></div>
			<div class="aside-home">
				<span v-if="isLoggedIn">
					<button v-on:click="logout">Logout</button>
					<router-link :to="{ name:'CambiarPassword' }">
						Cambiar contraseña
					</router-link>
				</span>
			</div>
		</div>
		<router-view/>
	</div>
</template>
<script>
	import "../assets/css/home.css";
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