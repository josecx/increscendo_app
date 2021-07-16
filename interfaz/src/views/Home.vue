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
			<b-dropdown variant="link" toggle-class="text-decoration-none" no-caret>
				<template #button-content>
					<a href="javascript:;">
						<img style="height: 50px; border-radius: 50%; overflow: hidden; width: 50px;" src="https://lh3.googleusercontent.com/ogw/ADGmqu-OhZUCi5QCe_spoPL-8B7VV9JQ3VUWZw4FtDiCcg=s83-c-mo" alt="">
					</a>
				</template>
				<b-dropdown-item @click="cambiarPass()"><i class="fas fa-key text-muted"></i> Cambiar contraseña</b-dropdown-item>
				<b-dropdown-divider></b-dropdown-divider>
				<b-dropdown-item @click="logout()"><i class="fas fa-power-off text-danger"></i> Cerrar sesión</b-dropdown-item>
			</b-dropdown>
			
		</div>
		<div class="panel-lateral">
			<div class="contain-panel-lateral">
				<div class="contain-items-home">
					<router-link :to="{ name:'Home_app' }">
						<div class="box-menu-icons">
							<span class="icon-bx-menu"><i class="fas fa-home"></i></span>
							<span class="text-bx-menu">Home</span>
						</div>
					</router-link>
					<router-link :to="{ name:'Config_contenido' }" v-if="usuario.rol_id == 2 || usuario.rol_id == 1">
						<div class="box-menu-icons">
							<span class="icon-bx-menu"><i class="fas fa-cogs"></i></span>
							<span class="text-bx-menu">Configurar Contenido</span>
						</div>
					</router-link>
					<router-link :to="{ name:'Contenido' }">
						<div class="box-menu-icons">
							<span class="icon-bx-menu"><i class="fas fa-play"></i></span>
							<span class="text-bx-menu">Contenido</span>
						</div>
					</router-link>
					<router-link :to="{ name:'Usuario' }" v-if="usuario.rol_id == 1">
						<div class="box-menu-icons">
							<span class="icon-bx-menu"><i class="fas fa-user"></i></span>
							<span class="text-bx-menu">Usuarios</span>
						</div>
					</router-link>
				</div>
			</div>
		</div>
		<div class="main-home">
			<div class="component-change-home">
				<router-view/>
			</div>
			<!-- <div class="aside-home">
				<br>
				<br>
				
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="card-link">Card link</a>
						<a href="#" class="card-link">Another link</a>
					</div>
				</div>
				<br>
	
				<div class="card">
					<div class="card-header">
						Quote
					</div>
					<div class="card-body">
						<blockquote class="blockquote mb-0">
							<p>A well-known quote, contained in a blockquote element.</p>
							<footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
						</blockquote>
					</div>
				</div>
			</div> -->
		</div>
	</div>
</template>
<script>
	import "../assets/css/home.css";
	export default {
		name: 'Home',
		data: () => {
			return {
				usuario: null,
				key: 0
			}
		},
		created(){
			if (this.$store.getters.isLoggedIn) {
				this.usuario = this.$store.state.usuario
			} else {
				this.logout();
			}
		},
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
			cambiarPass(){
				this.$router.push({name: "CambiarPassword"})
			}
		},
	}
</script>