<template>
	<div>
		<header class="mobile-hader">
			<img src="../assets/img/logo_secundario_en_fondo_oscuro.svg" alt="logo-increscendo" height="30px">
			<button class="btn-sandwich"><font-awesome-icon :icon="['fas', 'bars']" /></button>
		</header>
		<div class="sidebar-menu">
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
						<a href="">
							<li class="cl-blanco">Inicio</li>
						</a>
						<a href="">
							<li class="cl-blanco">Quiénes Somos</li>
						</a>
						<a href="">
							<li class="cl-blanco">¿Qué hacemos?</li>
						</a>
						<a href="">
							<li class="cl-blanco">Programas</li>
						</a>
						<a href="">
							<li class="cl-blanco">Increscendo Store</li>
						</a>
						<a href="">
							<li class="cl-blanco">Galería</li>
						</a>
						<a href="">
							<li class="cl-blanco">Opiniones</li>
						</a>
						<a href="">
							<li class="cl-blanco">Equipo Increscendo</li>
						</a>
						<a href="">
							<li class="cl-blanco">Recursos para Padres</li>
						</a>
						<a href="">
							<li class="cl-blanco">Contacto</li>
						</a>
					</ul>
				</nav>
			</div>
			<div class="menu-footer-contain">
				
			</div>

			<!-- Main-Landing-Content -->
		</div>
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
	export default {
		name: "Landing"
	}
</script>