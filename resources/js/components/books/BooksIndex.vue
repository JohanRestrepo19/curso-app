<script>
	import axios from 'axios'
	import BooksTable from './BooksTable.vue'

	export default {
		name: 'BooksIndex',
		components: { BooksTable },
		data() {
			return {
				books: [],
				loadingBooks: true
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
			}
		}
	}
</script>

<template>
	<div class="card m-5">
		<div class="card-header d-flex justify-content-between">
			<h2>Libros</h2>
			<a class="btn btn-primary">Crear libro</a>
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
	</div>
</template>
