<template>
  <div>
    <nav class="navbar navbar-expand-lg rounded border">
      <a class="navbar-brand" href="javascript:;">PUBLICACIONES</a>
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex navbar-nav ml-auto" v-if="usuario.rol_id == 1">
              <button
                title="Nuevo publicación"
                class="btn btn-outline-primary"
                type="button"
                @click="_abrirFormulario"
                data-toggle="modal"
                data-target="#exampleModal"
              >
                <i class="fas fa-plus"></i> Nueva publicación
              </button>
            </form>
          </div>
        </div>
      </div>
    </nav>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          </div> -->
          <div class="modal-body">
            <!-- form creador de contenidos -->
            <div v-if="verForm" class="card mt-2 border-0">
              <div class="card-body">
                <!-- <button
                  type="button"
                  class="close pr-2"
                  aria-label="Close"
                  @click="_cerrarFormulario"
                >
                  <span aria-hidden="true">&times;</span>
                </button> -->
				<button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
                <form @submit.prevent="_guardar()">
					
                  <small class="text-primary ml-2"
                    ><i class="fas fa-exclamation-circle"></i> Información
                    general</small
                  >
                  <div class="form-row col-sm-12 mt-2">
                    <div class="col-sm-6">
                      <label class="control-label">Título</label>
                      <input
                        type="text"
                        class="form-control"
                        name="nombre"
                        v-model="form.nombre"
                        required
                      />
                    </div>
                    <div class="col-sm-6 mt-2">
                      <div class="custom-control custom-switch">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          id="switchTipo"
                          :true-value="1"
                          :false-value="0"
                          v-model="form.link"
                        />
                        <label class="custom-control-label" for="switchTipo"
                          >LINK</label
                        >
                      </div>
                      <div v-if="form.link == 1">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Link del recurso"
                          v-model="form.archivo"
                        />
                      </div>
                      <div class="custom-file" v-else>
                        <input
                          type="file"
                          class="custom-file-input"
                          id="archivo"
                          name="archivo"
                          @change="_cargarImagen"
                        />
                        <label class="custom-file-label" for="archivo">{{
                          txt_imagen
                        }}</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-row col-sm-12 mt-2" v-if="form.link == 1">
                    <label class="control-label">Tipo de Recurso</label>
                    <select
                      class="custom-select"
                      v-model="form.tipo_recurso_id"
                    >
                      <option value="">Seleccione una opción</option>
                      <option
                        v-for="(i, key) in select.tipo_recurso"
                        :key="key"
                        :value="i.id"
                      >
                        {{ i.nombre }}
                      </option>
                    </select>
                  </div>
                  <div class="form-row col-sm-12 mt-2">
                    <label class="control-label">Descripción</label>
                    <wysiwyg
                      id="descripcion"
                      name="descripcion"
                      v-model="form.descripcion"
                      class="border bg-white"
                    />
                  </div>
                  <div class="col-sm-12 mt-2 text-right">
                    <!-- <button
                      type="button"
                      class="btn btn-secondary"
                      data-dismiss="modal"
                    >
                      Close
                    </button> -->
                    <button
                      type="submit"
                      :disabled="btnGuardando"
                      class="btn btn-primary"
                    >
                      <span
                        v-if="btnGuardando"
                        class="spinner-border spinner-border-sm"
                        role="status"
                        aria-hidden="true"
                      ></span>
                      <i class="fas fa-save" v-else></i>
                      <span>
                        {{ btnGuardando ? "Guardando..." : "Guardar" }}</span
                      >
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <!-- Fin de Form -->
          </div>
        </div>
      </div>
    </div>

    <!-- Cards Home -->
    <div class="row justify-content-center">
      <div
        class="col-8 form-row row justify-content-center mt-2"
        v-if="lista.length > 0 && !buscando"
      >
        <div
          v-for="(i, key) in lista"
          :key="key"
          class="col-12 col-sm-10"
          v-bind:class="{ 'col-sm-12': i.tipo_recurso_id == 3 }"
        >
          <div class="card" style="max-height: 100%; height: 100%">
            <!-- <div class="card-header text-right" v-if="usuario.rol_id == 1">
						<button class="btn btn-outline-danger" @click="eliminarPublicacion(i)">
							<i class="fas fa-trash"></i>
						</button>
					</div> -->
            <div class="card-body">
              <h5 class="card-title">{{ i.nombre }}</h5>
              <div
                class="contain-iframe-qs"
                v-if="i.tipo_recurso_id == 1 && i.link == 0"
              >
                <iframe
                  width="560"
                  height="315"
                  :src="'https://drive.google.com/uc?id=' + i.recurso"
                  frameborder="0"
                  allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </div>
              <div
                class="contain-iframe-qs"
                v-if="i.tipo_recurso_id == 1 && i.link == 1"
              >
                <iframe
                  width="560"
                  height="315"
                  :src="i.recurso"
                  frameborder="0"
                  allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </div>
              <div
                class="text-center"
                v-if="i.tipo_recurso_id == 2 && i.link == 0"
              >
                <img
                  :src="'https://drive.google.com/uc?id=' + i.recurso"
                  class="img-fluid"
                  alt="Responsive image"
                />
              </div>
              <div
                class="text-center"
                v-if="i.tipo_recurso_id == 2 && i.link == 1"
              >
                <img
                  :src="i.recurso"
                  class="img-fluid"
                  alt="Responsive image"
                />
              </div>
              <p class="card-text mt-2" v-html="i.descripcion"></p>
              <div class="text-right">
                <small class="text-muted">{{ i.fecha_publicado }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import GlobalMixin from "../../mixins/Formulario.js";
export default {
  name: "Home",
  mixins: [GlobalMixin],
  created() {
    this.form.drive = 1;
    if (this.$store.getters.isLoggedIn) {
      this.usuario = this.$store.state.usuario;
    }
    this._getSelect(["tipo_recurso"]);
    this.url = "/mantenimiento/publicacion";
    this._getDatos();
    this.fEspecial = true;
  },
  methods: {
    eliminarPublicacion(idx) {
      if (confirm("¿Quiere eliminar esta publicación?")) {
        this.form = idx;
        this.form.activo = 0;
        this.reg = idx.id;
        this._guardar();
      }
    },
  },
};
</script>
<style>
.contain-iframe-qs {
  width: 100%;
  height: 0;
  padding-bottom: 56.25%;
  position: relative;
}

.contain-iframe-qs iframe {
  position: absolute;
  width: 100%;
  height: 100%;
}

@media (min-width: 1200px) {
  .contain-iframe-qs {
    width: 100%;
    height: 0;
    padding-bottom: 56.25%;
    position: relative;
  }
}
</style>