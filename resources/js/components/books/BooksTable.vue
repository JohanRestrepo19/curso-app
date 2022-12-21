<template>
	<section class="table-responsive">
		<table class="table" id="bookTable" @click="getEvent">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Autor</th>
					<th>Stock</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</section>
</template>

<script>
	import axios from 'axios'
	import swal from 'sweetalert2'
	import $ from 'jquery'
	export default {
		name: 'BooksTable',
		components: [],
		data() {
			return {
				load: false,
				booksArr: [],
				dataTable: {}
			}
		},
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				this.mountDataTable()
			},
			getEvent(event) {
				const button = event.target
				if (button.getAttribute('role') === 'edit') {
					this.handleClickEdit(button.getAttribute('data-id'))
				} else {
					this.handleClickDelete(button.getAttribute('data-id'))
				}
			},
			async fetchBooks() {
				try {
					const {
						data: { books }
					} = await axios.get('books/getAllBooks')
					return books
				} catch (error) {
					console.error(error)
					return []
				}
			},
			mountDataTable() {
				this.dataTable = $('#bookTable').DataTable({
					processing: true,
					serverSide: true,
					ajax: {
						url: '/books/getAllBooksDataTable'
					},
					columns: [
						{ data: 'title' },
						{ data: 'author.name' },
						{ data: 'stock' },
						{ data: 'action' }
					]
				})
			},
			async handleClickEdit(bookId) {
				try {
					this.load = false
					const { data } = await axios.get(`/books/getBook/${bookId}`)
					this.index()
					this.$parent.handleEditBook(data.book)
				} catch (error) {
					console.error(error)
				}
			},
			// Se pasa todo el libro solo como por tener un approach diferente
			async handleClickDelete(bookId) {
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

					this.dataTable.destroy()
					this.load = false
					await axios.delete(`/books/DeleteBook/${bookId}`)

					this.index()
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
