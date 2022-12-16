<script>
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
						<button class="btn btn-info btn-sm mx-2">editar</button>
						<button class="btn btn-danger btn-sm mx-2">eliminar</button>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
</template>
