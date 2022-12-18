<script>
  import axios from 'axios'

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
              <label for="author_id" class="form-label">Categoria</label>
              <select class="form-control" id="author_id" v-model="book.author_id">
                <option disabled value="">Selecciona un autor</option>
                <option v-for="author in authors" :key="author.id">
                  {{ author.name }}
                </option>
              </select>
            </div>

            <!-- Categoria -->
            <div class="mb-3">
              <label for="category_id" class="form-label">Categoria</label>
              <select class="form-control" id="category_id" v-model="book.category_id">
                <option disabled value="">Selecciona una categoria</option>
                <option v-for="category in categories" :key="category.id">
                  {{ category.name }}
                </option>
              </select>
            </div>

            <!-- Stock -->
            <div class="mb-3">
              <label for="stock" class="form-label">Stock</label>
              <input type="number" min="1" class="form-control" id="stock" v-model="book.stock" />
            </div>

            <hr />

            <div class="d-flex justify-content-evenly">
              <button type="submit" class="btn btn-primary">
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
