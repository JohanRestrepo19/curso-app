<script>
  import axios from 'axios'
  import swal from 'sweetalert2'
  export default {
    name: 'BooksTable',
    props: { books: { type: Array } },
    components: [],
    data() {
      return {
        booksArr: []
      }
    },
    created() {
      this.index()
    },
    methods: {
      index() {
        this.booksArr = this.books
      },
      async handleClickEdit(bookId) {
        try {
          const {
            data: { book }
          } = await axios.get(`/books/getBook/${bookId}`)
          this.$parent.handleEditBook(book)
        } catch (error) {
          console.error(error)
        }
      },
      // Se pasa todo el libro solo como por tener un approach diferente
      async handleClickDelete(book) {
        try {
          const result = await swal.fire({
            icon: 'info',
            title: 'Quieres eliminar el libro?',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
          })

          /* Read more about isConfirmed, isDenied below */
          if (!result.isConfirmed) return

          await axios.delete(`/books/DeleteBook/${book.id}`)

          swal.fire({
            icon: 'success',
            title: 'Felicitaciones!',
            text: 'Tu libro fue eliminado',
            showConfirmButton: false,
            timer: 1500
          })
          this.$parent.handleRefreshBooks()
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
  <section class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Autor</th>
          <th>Stock</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(book, index) in books" :key="book.id">
          <th>{{ index + 1 }}</th>
          <td>{{ book.title }}</td>
          <td>{{ book.author.name }}</td>
          <td>{{ book.stock }}</td>
          <td>
            <button class="btn btn-info btn-sm mx-2" @click="handleClickEdit(book.id)">
              editar
            </button>
            <button class="btn btn-danger btn-sm mx-2" @click="handleClickDelete(book)">
              eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </section>
</template>
