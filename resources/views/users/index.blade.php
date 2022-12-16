<x-app>
	<section class="container">
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
				<section class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">CC</th>
								<th scope="col">Nombre</th>
								<th scope="col">Apellido</th>
								<th scope="col">Correo</th>
								<th scope="col">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<tr>
								<th scope="row">{{$user->number_id}}</th>
								<td>{{$user->name}}</td>
								<td>{{$user->last_name}}</td>
								<td>{{$user->email}}</td>
								<td>

									<div class="d-flex">
										<a href="{{route('user.update', ['user' => $user->id])}}" class="btn btn-info btn-sm me-2">Editar</a>
										<form action="{{route('user.delete', ['user' => $user->id])}}" method="post">
											@csrf
											@method('delete')
											<button type="submit" class="btn btn-danger btn-sm ms-2">Eliminar</button>
										</form>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</section>
			</div>
		</div>
	</section>
</x-app>
