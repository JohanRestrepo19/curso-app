<x-app>
	<div class="card m-4 overflow-hidden">
		<div class="card-header d-flex justify-content-between align-items-center">
			<h2>Usuarios</h2>
			<a href="{{route('user.create')}}">
				<button class="btn btn-primary">
					Crear Usuario
				</button>
			</a>
		</div>

		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">CC</th>
						<th scope="col">Nombre</th>
						<th scope="col">Apellido</th>
						<th scope="col">Correo</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<th scope="row">{{$user->number_id}}</th>
						<td>{{$user->name}}</td>
						<td>{{$user->last_name}}</td>
						<td>{{$user->email}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</x-app>
