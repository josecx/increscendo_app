<template>
	<div class="col-sm-12 mt-2">

		<div class="table-responsive-xl">
			<table class="table table-sm table-hover table-condensed m-0">
				<thead>
					<tr class="table-light">
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Usuario</th>
						<th>Correo</th>
						<th>Rol</th>
						<th></th>
					</tr>
				</thead>
<!-- 					<tbody v-if="!inicio">
						<tr v-for="(i, idx) in filtrada" :key="i.id">
							<td><a href="#" @click="editar(idx)">{{ i.codigo }}</a></td>
							<td>{{ i.nombre }}</td>
							<td>{{ i.nplan }}</td>
							<td class="text-center">
								<span v-if="i.activo == 1" class="badge badge-primary">Activo</span>
								<span v-else class="badge badge-danger">Inactivo</span>
							</td>
						</tr>
					</tbody> -->
					<tfoot>
<!-- 						<tr v-if="inicio">
							<td colspan="100%" class="text-center">
								<div class="text-center">
									<div class="spinner-border" role="status">
										<span class="sr-only">Loading...</span>
									</div>
								</div>
							</td>
						</tr> -->
						<tr>
							<td colspan="100%" class="text-center">
								No hay registros para mostrar
							</td>
						</tr>
					</tfoot>
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
				usuarios: []
			}
		},
		created(){
			this.getUsuario()
		},
		methods:{
			getUsuario(){
				this._getLista({url: "/usuario/getUsuario"}).then((response) => {
					console.log(response)
				})
			}
		}
	}
</script>