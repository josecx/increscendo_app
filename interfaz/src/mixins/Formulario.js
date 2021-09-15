// NIVELES DE ERROR
// 1. Error -> sistema, datos, conexión
// 2. Warning -> advertencias sobre datos y/o uso del sistema

import GlobalMixin from "./global-mixin.js";
export default{
	name: "Formulario",
	mixins: [GlobalMixin],
	data: () => ({
		url: 	      null,
		urlLista:     null,
		idx: 	      null,
		correonec:    null,
		btnGuardar:   true,
		btnGuardando: false,
		verForm:      false,
		buscando:     false,
		componentKey: 0,
		fEspecial: false,
		reg: 		  '',
		txt_imagen: "Elegir Recurso",
		form:   {},
		bform:  {},
		select: {},
		lista:  {},
	}),
	methods: {
		// FORM BACKEND
		_enviarPeticionGet(args){
			return new Promise((resolve) => {
				var arg = (args.arg) ? args.arg:''
				this.$http
				.get(`${this.urlBase}`+args.url+arg, args.data)
				.then(res => {
					resolve(res.data)
				})
			})
		},
		_enviarPeticionPost(args){
			return new Promise((resolve) => {
				var arg = (args.arg) ? args.arg:''
				this.$http
				.post(`${this.urlBase}`+args.url+arg, args.data)
				.then(res => {
					resolve(res.data)
				})
			})
		},
		_guardar(){
			this.btnGuardando = true
			this.componentKey += 1;
			let datos = this.form

			if (this.fEspecial) {
				datos = new FormData()
				for (let i in this.form) {
					datos.append(i, this.form[i]);
				}
			}
			if(this.fEspecial && !this.reg){
				this._notificarWarning("Esto podría tardar unos minutos...")
			}

			this._enviarPeticionPost({
				url: this.url+"/guardar/",
				arg: this.reg,
				data: datos
			}).then((response)=> {
				this.btnGuardando = false
				if (response.exito) {
					this._notificarSuccess(response.mensaje)
					this._cerrarFormulario()
					this._getDatos()
				}else{
					if (response.nivel == 2) {
						this._notificarWarning(response.mensaje)
					} else {
						this._notificarError(response.mensaje)
					}
				}				
			})
		},
		_cargarImagen(e){
            let archivo = e.target.files || e.dataTransfer.files
            this.form.archivo = archivo[0]
            this.txt_imagen = archivo[0]["name"]
        },
		_editar(idt){
			let dato = this.lista[idt]

			this.reg  = dato.id
			this.form = dato
			this._abrirFormulario()
		},

		// FORMULARIO SELECT, LISTA, VALIDACIONES
		_getDatos(){
			this.buscando = true
			let datos = this.bform
			this._enviarPeticionGet({
				url: this.url+"/getLista/",
				data: {params:datos}
			}).then((response) => {
				this.buscando = false
				this.lista = response.lista
			})
		},
		_getSelect(select){
			this._enviarPeticionPost({
				url:  "/mantenimiento/mante/getSelect",
				data: {params: {"funcion" : select}}
			}).then((response) => {
				for (let i in response.lista) {
					this.select[i] = response.lista[i]
				}
				this.componentKey ++
			}).catch(e=>{
				console.log(e)
			})
		},
		_validarCorreo(){
			this._enviarPeticionGet({
				url: "/usuario/validarCorreo"
			})
			this.args = { url: "/usuario/validarCorreo", data: { params: { "correo" : this.datos.correo } }}
			this._getLista(this.args).then((response) => {
				if (response.exito) {
					this._notificarError(response.mensaje)
					this.btnGuardar = false
				} else{
					this._notificarWarning("ningún usuario posee este correo")
				}
			})
		},

		// FORMULARIO FRONTEND
		_abrirFormulario(){
			this.verForm = true
			if(!this.reg){
				this._limpiarFormulario()
			}
		},
		_cerrarFormulario(){
			this._limpiarFormulario()
			this.verForm = false
			this.txt_imagen = "Elegir Recurso"
		},
		_limpiarFormulario () {
			this.form = {};
			this.reg  = '';
		},
	},
	filters: {
        truncate: function (text, length, suffix) {
            if (text.length > length) {
                return text.substring(0, length) + suffix;
            } else {
                return text;
            }
        },
	}
}