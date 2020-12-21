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
						<a v-scroll-to="'#slider'">
							<li class="cl-blanco">Inicio</li>
						</a>
						<a v-scroll-to="'#quienesomos'">
							<li class="cl-blanco">Quiénes Somos</li>
						</a>
						<a v-scroll-to="'#quehacemos'">
							<li class="cl-blanco">¿Qué hacemos?</li>
						</a>
						<a v-scroll-to="'#programas'">
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
								<router-link :to="{ name:'Login' }">
									<button class="btn-primary">Iniciar Sesión</button>
								</router-link>
								<router-link :to="{ name:'SignUp' }">
									<button class="btn-secondary">Registrarse</button>
								</router-link>
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
						<p>Contribuir al desarrollo integral de los bebés y niños guatemaltecos, potenciando en el momento oportuno del desarrollo, las habilidades, cognitivas, afectivas, sociales, emocionales, de lenguaje y físicas, favoreciendo su integración al mundo en que vivimos.</p>
					</div>
					<div class="content-text">
						<h3>Visión</h3>
						<p>Niños y niñas felices, con habilidades musicales y una estructura firme basado en la práctica de valores necesarios para su desarrollo y desenvolvimiento en la sociedad.</p>
					</div>
					<div class="contain-iframe-qs">
						<iframe width="500" height="315" src="https://www.youtube.com/embed/QhAjVAwRP_k" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
					<div class="content-text">
						<h3>¿Quiénes somos?</h3>
						<p>El programa de Estimulación Temprana por medio de la Música, pretende que los niños experimenten y desarrollen habilidades musicales en actividades específicas, que permitan un desarrollo integral al mismo tiempo que fortalecen el vínculo padre-hijo/a- madre-hijo/a mediante una interacción grupal en el aula.  Cada sesión tiene una duración de 45 minutos, espacio en el cual experimentan actividades de ejercicios motrices, rítmicos, melódicos, de relajación además de un   repertorio de canciones infantil adecuados a las edades de los niños.</p>
					</div>
					<div class="card-img-quienes-somos">
						<div id="card-qs-one" class="cnt-img-card">
							<img src="../assets/img/crd-qs.png" alt="quienes-somos-card">
							<h4>Comprometidos con la niñez Guatemalteca</h4>
						</div>
						<div id="card-qs-two" class="cnt-img-card">
							<img src="../assets/img/crd-qs.png" alt="quienes-somos-card">
							<h4>Potenciando en el momento oportuno del desarrollo de los niños y niñas.</h4>
						</div>
						<div id="card-qs-three" class="cnt-img-card">
							<img src="../assets/img/crd-qs.png" alt="quienes-somos-card">
							<h4>Estimula y garantiza el aumento en la capacidad de la memoria, atención y concentración.</h4>
						</div>
					</div>
					<div class="separador-quienes-somos"></div>
					<div class="content-text-phrase">
						<h2>“Si al niño se le canta, si jugamos con él, si propiciamos momentos de convivio especial, totalmente dedicados a él, se sentirá feliz y amado y será capaz de enfrentar cualquier situación de aprendizaje que se le presente.”</h2>
						<span>Liz Andrade Pizaña</span>
					</div>
					<div class="separador-quienes-somos"></div>
				</div>
			</section>
			<!-- Fin Quénes somos -->
			<!-- Qué hacemos -->
			<section id="quehacemos">
				<div class="contain">
					<h2>Beneficios de la Estimulación Musical Temprana</h2>
					<div class="card-char-qh">
						<div class="cntnt-icn-ttle-qh">
							<img src="../assets/img/icons/icon-nota.svg" alt="">
							<h3>Música</h3>
						</div>
						<ul>
							<li>Favorece la sensibiliación e interiorización musical </li>
							<li>Favorece la expresión artística</li>
							<li>Mejora la pronunciación y entonación</li>
							<li>Facilita el aprendizaje musical posterior</li>
						</ul>
					</div>
					<div class="card-char-qh">
						<div class="cntnt-icn-ttle-qh">
							<img src="../assets/img/icons/icon-childs.svg" alt="">
							<h3>Afectivo Social</h3>
						</div>
						<ul>
							<li>Favorece la sociaización</li>
							<li>Estimula la creatividad</li>
							<li>Expresa sus ideas, sentimientos y emociones</li>
							<li>Libera sus tensiones</li>
						</ul>
					</div>
					<div class="card-char-qh">
						<div class="cntnt-icn-ttle-qh">
							<img src="../assets/img/icons/icon-baby.svg" alt="">
							<h3>Psicomotor</h3>
						</div>
						<ul>
							<li>Favorece el desarollo de las coordinaciones motoras gruesas y finas</li>
							<li>Estimula la expresión coporal, gestual y mímica</li>
							<li>Favorece la correcta respiración y relajación</li>
							<li>Estimula el desarrollo de su capacidad psicomotora y muscular postural</li>
						</ul>
					</div>
					<div class="card-char-qh">
						<div class="cntnt-icn-ttle-qh">
							<img src="../assets/img/icons/icon-com.svg" alt="">
							<h3>Lenguaje</h3>
						</div>
						<ul>
							<li>Favorece la expresión, comunicación y creatividad</li>
							<li>Interacción con el medio al que pertenece</li>
							<li>Enriquece el vocabulario</li>
							<li>Se mejora la articulación y entonación</li>
						</ul>
					</div>
					<div class="card-char-qh">
						<div class="cntnt-icn-ttle-qh">
							<img src="../assets/img/icons/icon-brain.svg" alt="">
							<h3>Cognitivo</h3>
						</div>
						<ul>
							<li>Favorece las actividades de las funciones mentales</li>
							<li>Memoria y atención</li>
							<li>Juicio y razonamiento</li>
							<li>Análisis, síntesis, desarrollo de las nociones espacio y tiempo, número y cantidad</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- Fin qué hacemos -->
			<!-- Programas -->
			<section id="programas">
				<div class="contain">
					<h2>Programas de estimulación musical temprana.</h2>
					<div class="content-programs">
						<div class="card-programas">
							<div id="bg-nivel-one" class="card-program-level-part">
								<h3>Nivel 1</h3>
							</div>
							<div class="card-program-old-part">
								<h3 class="edad-program">6-11</h3>
								<h3 class="meses-program">MESES</h3>
								<p>DE EDAD</p>
							</div>
						</div>
						<div class="card-programas">
							<div id="bg-nivel-two" class="card-program-level-part">
								<h3>Nivel 2</h3>
							</div>
							<div class="card-program-old-part">
								<h3 class="edad-program">1 a 1</h3>
								<h3 class="meses-program">AÑO</h3>
								<p>11 MESES DE EDAD</p>
							</div>
						</div>
						<div class="card-programas">
							<div id="bg-nivel-three" class="card-program-level-part">
								<h3>Nivel 3</h3>
							</div>
							<div class="card-program-old-part">
								<h3 class="edad-program">2 a 2</h3>
								<h3 class="meses-program">AÑOS</h3>
								<p>11 MESES DE EDAD</p>
							</div>
						</div>
						<div class="card-programas">
							<div id="bg-nivel-four" class="card-program-level-part">
								<h3>Nivel 4</h3>
							</div>
							<div class="card-program-old-part">
								<h3 class="edad-program">3 a 4</h3>
								<h3 class="meses-program">AÑOS</h3>
								<p>11 MESES DE EDAD</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Fin Programas -->

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
	import "../assets/css/programas.css";
	import GlobalMixin from "../mixins/global-mixin.js";
	export default {
		name: "Landing",
		mixins: [GlobalMixin],
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