<template>
	<div>
		<header class="mobile-hader">
			<img src="../assets/img/logo_secundario_en_fondo_oscuro.svg" alt="logo-increscendo" height="30px">
			<button 
				class="btn-sandwich" 
				ref="sidebarButton"
				v-on:click="togleSlider()"
			>
					<font-awesome-icon :icon="['fas', 'bars']" />
			</button>
		</header>
		<div class="sidebar-menu" ref="sidebarMenu">
			<div class="menu-head-contain">
				<img src="../assets/img/logo_en_fondo_oscuro.svg" alt="logo-increscendo" id="logo-sidebar-menu">
			</div>
			<div class="menu-search-contain">
				<input type="text" placeholder="Buscar">
				<button class="btn-icon-search">
					<font-awesome-icon :icon="['fas', 'search-plus']" />
				</button>
			</div>
			<div class="menu-links-contain">
				<nav>
					<ul>
						<a href="#slider">
							<li class="cl-blanco">Inicio</li>
						</a>
						<a href="#quienesomos">
							<li class="cl-blanco">Quiénes Somos</li>
						</a>
						<a href="#quehacemos">
							<li class="cl-blanco">¿Qué hacemos?</li>
						</a>
						<a>
							<li class="cl-blanco">Programas</li>
						</a>
						<a>
							<li class="cl-blanco">Increscendo Store</li>
						</a>
						<a>
							<li class="cl-blanco">Galería</li>
						</a>
						<a>
							<li class="cl-blanco">Opiniones</li>
						</a>
						<a>
							<li class="cl-blanco">Equipo Increscendo</li>
						</a>
						<a>
							<li class="cl-blanco">Recursos para Padres</li>
						</a>
						<a>
							<li class="cl-blanco">Contacto</li>
						</a>
					</ul>
				</nav>
			</div>
			<div class="menu-footer-contain">
			</div>
		</div>
		
		<!-- Main-Landing-Content -->
		<section class="main">
			<!-- Slider -->
			<section id="slider">
				<div class="contenedor-slider">
					<div class="content-img-slider">
						<img id="bg-home" src="../assets/img/bgslide.jpg" height="100vh" alt="slider-img">
					</div>
					<div class="contenedor-sec-slider">
						<div class="card-actions-slider">
							<h4 id="bien-title">Bienvenidos a</h4>
							<h1 id="in-title">Increscendo</h1>
							<div class="content-btn-slider">
								<button class="btn-primary">Iniciar Sesión</button>
								<button class="btn-secondary">Registrarse</button>
							</div>
						</div>
						<img src="../assets/img/logo-principal.svg" alt="logo-increscendo" id="in-slider-logo">
					</div>
				</div>
			</section>
			<!-- Fin Slider -->
			<!-- Quiénes somos -->
			<section id="quienesomos">
				<div class="header-sec">
					<img src="../assets/img/fondo qh-min.png" alt="" width="100%">
				</div>
				<div class="contain">
					<div class="content-text">
						<h3>Misión</h3>
						<p>Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Esse, sit adipisci quod est optio, officia ea neque blanditiis, eum omnis mollitia error dolorum, inventore eius assumenda eveniet debitis. Ab, veniam.</p>
					</div>
					<div class="content-text">
						<h3>Visión</h3>
						<p>Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Esse, sit adipisci quod est optio, officia ea neque blanditiis, eum omnis mollitia error dolorum, inventore eius assumenda eveniet debitis. Ab, veniam.</p>
					</div>
					<div class="contain-iframe-qs">
						<iframe width="500" height="315" src="https://www.youtube.com/embed/QhAjVAwRP_k" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
					<div class="content-text">
						<h3>Quienes somos</h3>
						<p>Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Esse, sit adipisci quod est optio, officia ea neque blanditiis, eum omnis mollitia error dolorum, inventore eius assumenda eveniet debitis. Ab, veniam.</p>
					</div>
					<div class="card-img-quienes-somos">
						<div class="cnt-img-card">
							<img src="https://img5.goodfon.com/wallpaper/nbig/b/3e/deadpool-vector-marvel-comics-wade-wilson-ryan-reynolds-movi.jpg" alt="">
							<p>Título para la imagen de esta imagen</p>
						</div>
						<div class="cnt-img-card">
							<img src="https://img5.goodfon.com/wallpaper/nbig/b/3e/deadpool-vector-marvel-comics-wade-wilson-ryan-reynolds-movi.jpg" alt="">
							<p>Título para la imagen de esta imagen</p>
						</div>
						<div class="cnt-img-card">
							<img src="https://img5.goodfon.com/wallpaper/nbig/b/3e/deadpool-vector-marvel-comics-wade-wilson-ryan-reynolds-movi.jpg" alt="">
							<p>Título para la imagen de esta imagen</p>
						</div>
					</div>
					<div class="separador-quienes-somos"></div>
					<div class="content-text-phrase">
						<h2>Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Quam error ipsam numquam voluptatum quaerat sequi.</h2>
						<span>Lorem ipsum dolor des</span>
					</div>
					<div class="separador-quienes-somos"></div>
				</div>
			</section>
			<!-- Fin Quénes somos -->
			<!-- Qué hacemos -->
			<section id="quehacemos">
				<div class="contain">
					<h2>Beneficios de la estimulación temprana</h2>
					<div class="card-char-qh">
						<div class="cntnt-icn-ttle-qh">
							<img src="../assets/img/icons/icon-nota.svg" alt="">
							<h3>title</h3>
						</div>
						<ul>
							<li>char one</li>
							<li>char two</li>
							<li>char tree</li>
							<li>char for</li>
						</ul>
					</div>
					<div class="card-char-qh">
						<div class="cntnt-icn-ttle-qh">
							<img src="../assets/img/icons/icon-childs.svg" alt="">
							<h3>title</h3>
						</div>
						<ul>
							<li>char one</li>
							<li>char two</li>
							<li>char tree</li>
							<li>char for</li>
						</ul>
					</div>
					<div class="card-char-qh">
						<div class="cntnt-icn-ttle-qh">
							<img src="../assets/img/icons/icon-baby.svg" alt="">
							<h3>title</h3>
						</div>
						<ul>
							<li>char one</li>
							<li>char two</li>
							<li>char tree</li>
							<li>char for</li>
						</ul>
					</div>
					<div class="card-char-qh">
						<div class="cntnt-icn-ttle-qh">
							<img src="../assets/img/icons/icon-com.svg" alt="">
							<h3>title</h3>
						</div>
						<ul>
							<li>char one</li>
							<li>char two</li>
							<li>char tree</li>
							<li>char for</li>
						</ul>
					</div>
					<div class="card-char-qh">
						<div class="cntnt-icn-ttle-qh">
							<img src="../assets/img/icons/icon-brain.svg" alt="">
							<h3>title</h3>
						</div>
						<ul>
							<li>char one</li>
							<li>char two</li>
							<li>char tree</li>
							<li>char for</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- Fin qué hacemos -->
		</section>



			<!-- <section>
				<div class="contain">
					<h1>h1</h1>
					<h2>h2</h2>
					<h3>h3</h3>
					<h4>h4</h4>
					<p class="cl-negro">Lorem ipsum, dolor sit amet consectetur, adipisicing elit. Voluptatum repellendus libero doloremque dolorum praesentium dicta quo pariatur reiciendis culpa repellat obcaecati et totam sapiente quos impedit, facilis expedita tempora eos.</p>
					<ul class="ul-blanco">
						<li>hola</li>
						<li>hola</li>
						<li>hola</li>
					</ul>
					<button class="btn-primary">Primary</button>
					<button class="btn-secondary">secondary</button>
					<button class="btn-brd-blanco">Border</button>
					<button class="btn-fill">Fill</button>
					<button class="btn-small">small</button>
					<button class="btn-wicon">
						<font-awesome-icon :icon="['fas', 'birthday-cake']" />icon
					</button>
					<a href="#">enlace</a>
					<div class="separator"></div>
					<input type="text">
				</div>
			</section> -->
	</div>
</template>
<script>
	import "../assets/css/menu-landing.css";
	import "../assets/css/home-landing.css";
	import "../assets/css/quienes-somos.css";
	import "../assets/css/que-hacemos.css";
	export default {
		name: "Landing",
		data: () => {
			return{
				toggled: true,
				windowWidth: window.innerWidth
			}
		},
		created(){
			if (this.windowWidth <= 992) {
				this.toggled = false
			}
		},
		methods: {
			togleSlider(){
				let $ref = this.$refs["sidebarMenu"]
				if (this.toggled) {
					$ref.style.left = "-100%"
					this.toggled = false
				} else {
					$ref.style.left = "0%"
					this.toggled = true
				}
			}
		}
	}
</script>