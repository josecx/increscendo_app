import Vue 		 from 'vue'
import VueRouter from 'vue-router'
import store 	 from '../store';

Vue.use(VueRouter)

const routes = [
	{
		path: "/",
		name: "Landing",
		component: () => import ('../views/Landing.vue')
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
  mode: "history",
  base: '',
  routes
})

router.beforeEach((to, from, next) => {
  if (to.name == 'Landing') next()
  else if (to.name == "SignUp") next()
  else if (to.name == "RecuperarPassword") next()
  else if (to.name !== 'Login' && !store.getters.isLoggedIn) next({name:'Login'})
  else if (to.name == 'Login' && store.getters.isLoggedIn) next({name:'Principal'})
  else next()
});

export default router
