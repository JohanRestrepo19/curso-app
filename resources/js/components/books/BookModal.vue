<script>
  import axios from 'axios'
  import swal from 'sweetalert2'

  export default {
    data() {
      return {
        isCreating: true,
        categories: [],
        authors: [],
        book: {}
      }
    },
    created() {
      this.index()
    },
    methods: {
      async index() {
        const [categories, authors] = await Promise.all([
          this.fetchCategories(),
          this.fetchAuthors()
        ])
        this.categories = categories
        this.authors = authors
      },
      async fetchCategories() {
        try {
          const {
            data: { categories }
          } = await axios.get('/api/Categories/GetAllCategories')
          return categories
        } catch (error) {
          console.error(error)
          return []
        }
      },
      async fetchAuthors() {
        try {
          const {
            data: { authors }
          } = await axios.get('/api/Authors/GetAllAuthors')
          return authors
        } catch (error) {
          console.error(error)
          return []
        }
      },
      async handleSubmit(event) {
        event.preventDefault()

        try {
          this.isCreating
            ? await axios.post('/api/Books/SaveBook', this.book)
            : await axios.put(`/api/Books/UpdateBook/${this.book.id}`, this.book)

          swal.fire({
            icon: 'success',
            title: 'Felicitaciones!',
            text: 'Tu libro fue almacenado',
            showConfirmButton: false,
            timer: 1500
          })
          this.$parent.handleCloseModal()
        } catch (error) {
          console.error(error)
          swal.fire({
            icon: 'error',
            title: 'Ops...',
            text: 'Algo salió mal'
          })
        }
      }
    }
  }
</script>

<template>
  <!-- Modal -->
  <div class="modal fade" id="bookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal header -->
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            {{ `${isCreating ? 'Crear' : 'Editar'}` }} Libro
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <!-- Form -->
          <form>
            <!-- Titulo -->
            <div class="mb-3">
              <label for="title" class="form-label">Titulo</label>
              <input type="text" class="form-control" id="title" v-model="book.title" />
            </div>

            <!-- Descripcion -->
            <div class="mb-3">
              <label for="description" class="form-label">Descripcion</label>

              <textarea
                class="form-control"
                id="description"
                rows="3"
                v-model="book.description"
              ></textarea>
            </div>

            <!-- Autor -->
            <div class="mb-3">
              <label class="form-label">Autor</label>
              <v-select
                :options="authors"
                label="name"
                :reduce="author => author.id"
                v-model="book.author_id"
              />
            </div>

            <!-- Categoria -->
            <div class="mb-3">
              <label class="form-label">Categoria</label>
              <v-select
                :options="categories"
                label="name"
                :reduce="category => category.id"
                v-model="book.category_id"
              />
            </div>

            <!-- Stock -->
            <div class="mb-3">
              <label for="stock" class="form-label">Stock</label>
              <input type="number" min="1" class="form-control" id="stock" v-model="book.stock" />
            </div>

            <hr />

            <div class="d-flex justify-content-evenly">
              <button type="submit" class="btn btn-primary" @click="handleSubmit">
                {{ `${isCreating ? 'Crear' : 'Editar'}` }} Libro
              </button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
