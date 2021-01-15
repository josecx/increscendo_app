<template>
	<div class="col-sm-12 mt-2">
		<div class="p-0">
			<b-form inline>
				<div class="col-sm-6 p-0">
					<h2><b-badge variant="info">Usuarios <font-awesome-icon :icon="['fas', 'users']" /></b-badge></h2>
				</div>
				<div class="col-sm-6 text-right p-0">
					<b-form-input
						class 		="col-sm-9 mr-2"
						placeholder	="Término a buscar"
					></b-form-input>
					<b-button variant="outline-secondary" class="mr-2">
						<font-awesome-icon :icon="['fas', 'search']" />
					</b-button>

					<b-dropdown right text="Menú" variant="outline-success">
						<b-dropdown-item @click="form()"><font-awesome-icon :icon="['fas', 'check-square']" /> Nuevo</b-dropdown-item>
						<b-dropdown-item href="#"><font-awesome-icon :icon="['fas', 'file-alt']" /> Generar reporte</b-dropdown-item>
					</b-dropdown>
				</div>
			</b-form>
		</div>

		<div class="p-0" v-if="verForm">
			<button type="button" class="close pr-2" aria-label="Close" @click="verForm = !verForm">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="border border-ligth border-top-0 col-sm-12 mb-4 mt-4"></div>
			<b-form>
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
						>
							<option value="">Selecciona un rol</option>
						</select>
					</div>
					<div class="form-group mb-1 col-sm-3">
						<label 
							for="selectSexo" 
							class="mb-0 text-muted">Sexo:
						</label>
						<select 
							class="form-control form-control-sm"
							id="selectSexo" 
						>
							<option value="">Selecciona un sexo</option>
						</select>
					</div>
				</div>
				<div class="col-sm-12 text-right p-0">
					<b-button variant="outline-primary" class="mr-2">
						<font-awesome-icon :icon="['fas', 'save']" />
						Guardar
					</b-button>
				</div>
			</b-form>
		</div>

		<div class="border border-ligth border-top-0 col-sm-12 mb-4 mt-4"></div>

		<div class="table-responsive-xl">
			<table class="table table-bordered table-striped rounded">
				<thead class="thead-light">
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
					<tbody v-if="usuarios.length > 0">
						<tr v-for="(i, idx) in usuarios" :key="i.id">
							<td>{{ i.nombre }}</td>
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
									<b-dropdown-item  @click="form(idx)">
										<font-awesome-icon :icon="['fas', 'pen-square']" /> Editar
									</b-dropdown-item>
									<b-dropdown-item>
										<font-awesome-icon :icon="['fas', 'user-slash']" /> Deshabilitar
									</b-dropdown-item>
									<b-dropdown-item>
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
	export default{
		name: "Usuario",
		mixins: [GlobalMixin],
		data: () => {
			return{
				usuarios: [],
				verForm: false
			}
		},
		created(){
			this.getUsuario()
		},
		methods:{
			getUsuario(){
				this._getLista({url: "/usuario/getUsuario"}).then((response) => {
					this.usuarios = response.lista
					console.log(this.usuarios)
				})
			},
			form(){
				this.verForm = true
			}
		}
	}
</script>