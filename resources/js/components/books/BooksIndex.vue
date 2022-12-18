<script>
  import axios from 'axios'
  import { Modal } from 'bootstrap'
  import BooksTable from './BooksTable.vue'
  import BookModal from './BookModal.vue'

  export default {
    name: 'BooksIndex',
    components: { BooksTable, BookModal },
    data() {
      return {
        books: [],
        loadingBooks: true,
        isModalLoaded: false,
        modal: null
      }
    },
    mounted() {
      this.index()
    },
    methods: {
      async index() {
        this.books = await this.fetchBooks()
        this.loadingBooks = false
      },
      async fetchBooks() {
        try {
          const {
            data: { books }
          } = await axios.get('/api/Books/getAllBooks')
          return books
        } catch (error) {
          console.error(error)
          return []
        }
      },
      handleMountModal() {
        this.modal = new Modal(document.getElementById('bookModal'), {
          keyboard: false
        })
        this.modal.show()

        document.getElementById('bookModal').addEventListener('hidden.bs.modal', () => {
          this.isModalLoaded = false
        })
      },
      handleOpenModal() {
        this.isModalLoaded = true
        setTimeout(this.handleMountModal, 100)
      }
    }
  }
</script>

<template>
  <div class="card m-5">
    <div class="card-header d-flex justify-content-between">
      <h2>Libros</h2>
      <button @click="handleOpenModal()" class="btn btn-primary">Crear libro</button>
    </div>

    <div class="card-body">
      <div v-if="loadingBooks" class="d-flex justify-content-center my-4">
        <div class="spinner-border text-info" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>

      <section v-else>
        <books-table :books="books" />
      </section>
    </div>
    <section v-if="isModalLoaded">
      <book-modal />
    </section>
  </div>
</template>
