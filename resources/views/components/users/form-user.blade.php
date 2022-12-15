@props(['type' => 'Crear'])
<div class="card">
	<div class="card-header">
		<h2>{{$type}} Usuario</h2>
	</div>

	<div class="card-body">
		<form class="d-flex flex-column">
			<div class="mb-3">
				<label for="name" class="form-label">Nombre</label>
				<input type="text" class="form-control" id="name">
			</div>
			<div class="mb-3">
				<label for="last_name" class="form-label">Apellido</label>
				<input type="text" class="form-control" id="last_name">
			</div>
			<div class="mb-3">
				<label for="number_id" class="form-label">Cédula</label>
				<input type="number" class="form-control" id="number_id">
			</div>
			<div class="mb-3">
				<label for="email" class="form-label">Correo</label>
				<input type="email" class="form-control" id="email">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Contraseña</label>
				<input type="password" class="form-control" id="password">
			</div>
			<div class="mb-3">
				<label for="confirm_password" class="form-label">Confirmar contraseña</label>
				<input type="password" class="form-control" id="confirm_password">
			</div>
			<button type="submit" class="btn btn-primary">{{$type}}</button>
		</form>
	</div>
</div>
