<x-app>
	<section class="container">
		<div class="card my-5">
			<div class="card-header">
				<h2>Crear Usuario</h2>
			</div>

			<div class="card-body">
				<form action="{{route('user.create.post')}}" method="POST" class="d-flex flex-column">
					@csrf
					<x-users.form-user />
				</form>
			</div>
	</section>
</x-app>
