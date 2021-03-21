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
					<div class="box-menu-icons" v-on:click="componente('1')">
						<span class="icon-bx-menu"><i class="fas fa-address-book"></i></span>
						<span class="text-bx-menu">Comp1</span>
					</div>
					<div class="box-menu-icons" v-on:click="componente('2')">
						<span class="icon-bx-menu"><i class="fas fa-address-book"></i></span>
						<span class="text-bx-menu">Comp2</span>
					</div>
					<div class="box-menu-icons" v-on:click="componente('3')">
						<span class="icon-bx-menu"><i class="fas fa-address-book"></i></span>
						<span class="text-bx-menu">Comp3</span>
					</div>
					<div class="box-menu-icons" v-on:click="componente('4')">
						<span class="icon-bx-menu"><i class="fas fa-address-book"></i></span>
						<span class="text-bx-menu">Comp4</span>
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
			<div class="component-change-home">
				<C1 :key="key" v-if="componentes.c1"></C1>
				<C2 :key="key" v-if="componentes.c2"></C2>
				<C3 :key="key" v-if="componentes.c3"></C3>
				<C4 :key="key" v-if="componentes.c4"></C4>
			</div>
			<div class="aside-home">
				<span v-if="isLoggedIn">
					<button v-on:click="logout">Logout</button>
					<router-link :to="{ name:'CambiarPassword' }">
						Cambiar contraseña
					</router-link>
				</span>
				<br>
				<br>
				<!--  -->
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
				<!--  -->
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
			</div>
		</div>
		<router-view/>
	</div>
</template>
<script>
	import "../assets/css/home.css";
	import C1 from '@/components/home/componente1.vue';
	import C2 from '@/components/home/componente2.vue';
	import C3 from '@/components/home/componente3.vue';
	import C4 from '@/components/home/componente4.vue';
	export default {
		name: 'Home',
		data: () => {
			return {
				componentes: {
					c1: true
				},
				key: 0
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
			componente(tipo){
				this.key+=1
				if (tipo == '1'){this.componentes.c1 = true} else this.componentes.c1 = false;
				if (tipo == '2'){this.componentes.c2 = true} else this.componentes.c2 = false;
				if (tipo == '3'){this.componentes.c3 = true} else this.componentes.c3 = false;
				if (tipo == '4'){this.componentes.c4 = true} else this.componentes.c4 = false;
			}
		},
		components:{
			C1,
			C2,
			C3,
			C4
		}
	}
</script>