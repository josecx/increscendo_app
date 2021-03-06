import Vue 	    	from 'vue';
import VueToast 	from 'vue-toast-notification';
import VueScrollTo  from 'vue-scrollto';
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast);
Vue.use(VueScrollTo, {
	duration: 1600,
	easing: "ease"
})

export default {
	name: "GlobalMixin",
	data: () => {
		return {
			btnGuardar: false
		}
	},
	methods: {
		//ALERTAS
		_showToast(type_toast, message) {
			switch(type_toast) {
				case 0:
					this.type_ = 'error';
					break;
				case 1:
					this.type_ = 'success';
					break;
				case 2:
					this.type_ = 'warning';
					break;
				case 3:
					this.type_ = 'info';
					break;
				case 4:
					this.type_ = 'default';
					break;
			}

			Vue.$toast.open({
				message:  message,
				type: 	  this.type_,
				position: 'top-right'
			});
		},
		_notificarError(msg) {
			this._showToast(0, msg)
		},
		_notificarSuccess(msg) {
			this._showToast(1, msg)
		},
		_notificarWarning(msg) {
			this._showToast(2, msg)
		},
		_notificarInfo(msg) {
			this._showToast(3, msg)
		},
		_notificarDefault(msg) {
			this._showToast(4, msg)
		},
		// MANTENIMIENTO
		_getLista(args){
			return new Promise((resolve, reject) => {
				var arg = (args.arg) ? args.arg:''
				this.$http
				.get(`${this.urlBase}`+args.url+arg, args.data)
				.then(res => {
					resolve(res.data)
				}).catch(e => {
					reject(e)
				})
			})
		},
		_enviarDatos(args){
			this.btnGuardar = true
			return new Promise((resolve, reject) => {
				this.$http
				.post(`${this.urlBase}`+args.url+args.arg, args.data)
				.then(res => {
					this.btnGuardar = false
					resolve(res)
					if (res.data.exito) {
						this._notificarSuccess(res.data.mensaje)
					} else {
						if (res.data.warning) {
							this._notificarWarning(res.data.mensaje)
						} else {
							this._notificarError(res.data.mensaje)
						}
					}
				}).catch(e => {
					reject(e)
				})
			})
		},
	}
}