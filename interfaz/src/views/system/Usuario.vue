<template>
	<div class="col-sm-12 mt-2">
		<div class="p-0">
			<b-form @submit.prevent="_getDatos" inline>
				<div class="col-sm-6 p-0">
					<h2>Usuarios</h2>
				</div>
				<div class="col-sm-6 text-right p-0">
					<b-form-input
						v-model     ="bform.termino"
						class 		="col-sm-9 mr-2"
						placeholder	="Término a buscar"
					></b-form-input>
					<b-button  variant="outline-success" class="mr-2" type="submit">
						<font-awesome-icon :icon="['fas', 'search']" />
					</b-button>
					<b-button @click="_abrirFormulario()" variant="outline-primary" class="mr-2">
						<i class="fas fa-plus"></i>
					</b-button>

					<!-- <b-dropdown right text="Menú" variant="outline-success">
						<b-dropdown-item @click="_abrirFormulario()"><font-awesome-icon :icon="['fas', 'check-square']" /> Nuevo</b-dropdown-item>
						<b-dropdown-item @click="_guardar()"><font-awesome-icon :icon="['fas', 'file-alt']" /> Generar reporte</b-dropdown-item>
					</b-dropdown> -->
				</div>
			</b-form>
		</div>

		<div class="p-0" v-if="verForm">
			<button type="button" class="close pr-2" aria-label="Close" @click="verForm = !verForm">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="border border-ligth border-top-0 col-sm-12 mb-4 mt-4"></div>
			<form :key="componentKey" @submit.prevent="_guardar()">
				<div class="form-row">
					<div class="form-group mb-1 col-sm-6">
						<label 
							for="inputNombre" 
							class="mb-0 text-muted">Nombres: <span class="text-danger">*</span>
						</label>
						<input 
							type="text"
							class="form-control form-control-sm" 
							id="inputNombre"
							v-model="form.nombre"
							:required="true"
						>
					</div>
					<div class="form-group mb-1 col-sm-6">
						<label 
							for="inputApellido" 
							class="mb-0 text-muted">Apellidos: <span class="text-danger">*</span>
						</label>
						<input 
							type="text" 
							class="form-control form-control-sm" 
							id="inputApellido"
							v-model="form.apellido"
							:required="true"
						>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group mb-1 col-sm-6">
						<label 
							for="inputUsuario" 
							class="mb-0 text-muted">Usuario: <span class="text-danger">*</span>
						</label>
						<input 
							type="text" 
							class="form-control form-control-sm" 
							id="inputUsuario" 
							v-model="form.usuario"
							:required="true"
						>
					</div>
					<div class="form-group mb-1 col-sm-6">
						<label 
							for="inputCorreo" 
							class="mb-0 text-muted">Correo: <span class="text-danger">*</span>
						</label>
						<input 
							type="text" 
							class="form-control form-control-sm" 
							id="inputCorreo"
							v-model="form.correo"
							:required="true"
						>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group mb-1 col-sm-3">
						<label 
							for="selectRol" 
							class="mb-0 text-muted">Rol: <span class="text-danger">*</span>
						</label>
						<select 
							class="form-control form-control-sm"
							id="selectRol"
							v-model="form.rol_id"
						>
							<option value=""></option>
							<option v-for="i in select.rol" :key="i.id" :value="i.id">{{ i.nombre }}</option>
						</select>
					</div>
				</div>
				<div class="col-sm-12 text-right p-0" v-if="btnGuardar">
					<b-button type="submit" variant="outline-primary" class="mr-2" :disabled="btnGuardando">
						<font-awesome-icon :icon="['fas', 'save']" />
						<span :key="componentKey"> {{ btnGuardando ? 'Guardando...' : 'Guardar'}}</span>
					</b-button>
				</div>
			</form>
		</div>

		<div class="border border-ligth border-top-0 col-sm-12 mb-4 mt-4"></div>

		<div class="table-responsive-xl">
			<table :key="componentKey" class="table table-hover">
				<thead >
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Usuario</th>
						<th>Correo</th>
						<th>Rol</th>
						<th>Estado</th>
						<th></th>
					</tr>
				</thead>
					<tbody v-if="lista.length > 0">
						<tr v-for="(i, idt) in lista" :key="i.id">
							<td><a href="javascript:;" @click="_editar(idt)">{{ i.nombre }}</a></td>
							<td>{{ i.apellido }}</td>
							<td>{{ i.usuario }}</td>
							<td>{{ i.correo }}</td>
							<td>{{ i.nrol }}</td>
							<td class="text-center">
								<b-badge v-if="i.activo == 1" variant="success">Activo</b-badge>
								<b-badge v-else variant="danger">Inactivo</b-badge>
							</td>
							<td class="text-center m-0 pt-2 p-0">
								<b-dropdown right size="sm" variant="none">
<!-- 									<b-dropdown-item  @click="_editar(idt)">
										<font-awesome-icon :icon="['fas', 'pen-square']" /> Editar
									</b-dropdown-item> -->
<!-- 									<b-dropdown-item @click="deshabilitar(idt)">
										<font-awesome-icon :icon="['fas', 'user-slash']" /> Deshabilitar
									</b-dropdown-item> -->
									<b-dropdown-item @click="reenviar(idt)">
										<font-awesome-icon :icon="['fas', 'key']" /> Reenviar Contraseña
									</b-dropdown-item>
								</b-dropdown>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
</template>
<script>
	import GlobalMixin from "../../mixins/global-mixin.js";
	import Formulario from "../../mixins/Formulario.js";
	export default{
		name: "Usuario",
		mixins: [GlobalMixin,Formulario],
		created(){
			this.url = "/usuario"
			this._getSelect(['rol','sexo'])
			this._getDatos()
		},
		methods: {
			reenviar(idt){
				let datos = this.lista[idt]
				this._enviarPeticionPost({
					url: this.url+"/recuperarPassword",
					arg: '',
					data: datos
				}).then((response) => {
					this.btnGuardando = false
					if (response.exito) {
						this._notificarSuccess(response.mensaje)
					}else{
						if (response.nivel == 2) {
							this._notificarWarning(response.mensaje)
						} else {
							this._notificarError(response.mensaje)
						}
					}
				})
			}
		}
	}
</script>