import Vue 		 from 'vue'
import VueRouter from 'vue-router'
import store 	 from '../store';

Vue.use(VueRouter)

const routes = [
	{
		path: "/",
		component: () => import('../views/Landing.vue'),
		children: [
			{
				path: "",
				name: "Landing",
				component: () => import ('../views/Landing.vue')
			},
		]
	},
	{
		path: '/app/',
		name: 'Home',
		component: () => import('../views/Home.vue'),
		children: [
			{
				path: 'principal',
				name: 'Principal',
				component: () => import('../views/Principal.vue')
			},
			{
				path: 'cambiarpassword',
				name: 'CambiarPassword',
				component: () => import('../views/CambiarPass.vue')
			},
			{
				path: 'usuario',
				name: 'Usuario',
				component: () => import('../views/Usuario.vue')
			},
		]
	},
	{
		path: '/signup',
		name: 'SignUp',
		component: () => import('../views/SignUp.vue')
	},
	{
		path: '/recuperarpassword/:token?',
		name: 'RecuperarPassword',
		component: () => import('../views/RecuperarPass.vue')
	},
	{
		path: '/login',
		name: 'Login',
		component: () => import('../views/Login.vue')
	}

]

const router = new VueRouter({
  mode: "hash",
  base: 'increscendo',
  routes
})

router.beforeEach((to, from, next) => {
	if([
		"Landing",
		"SignUp",
		"RecuperarPassword",
		"Login"
		].includes(to.name)) next()
  else if (to.name !== 'Login' && !store.getters.isLoggedIn) next({name:'Landing'})
  else if (to.name == 'Login' && store.getters.isLoggedIn) next({name:'Principal'})
  else next()
});

export default router
