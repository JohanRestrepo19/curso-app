<x-app>
	<section class="container">
		<div class="card">
			<div class="card-header">
				<h2>Editar Usuario</h2>
			</div>

			<div class="card-body">
				<form action="{{route('user.update.put', ['user' => $user])}}" method="POST" class="d-flex flex-column">
					@csrf
					@method('PUT')
					<x-users.form-user :user="$user" />
				</form>
			</div>
	</section>
</x-app>
