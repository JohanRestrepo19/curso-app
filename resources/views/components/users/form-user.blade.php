<div class="mb-3">
  <label for="name" class="form-label">Nombre</label>
  <input type="text" name="name" value="{{old('name') ? old('name') : (isset($user) ? $user->name : '')}}" class="form-control @error('name') is-invalid @enderror" id="name">
  @error('name')
  <span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
  </span>
  @enderror
</div>

<div class="mb-3">
  <label for="last_name" class="form-label">Apellido</label>
  <input type="text" name="last_name" value="{{old('last_name') ? old('last_name') : (isset($user) ? $user->last_name : '')}}" class="form-control @error('last_name') is-invalid @enderror" id="last_name">
  @error('last_name')
  <span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
  </span>
  @enderror
</div>


<div class="mb-3">
  <label for="role" class="form-label">Rol</label>

  <select name="role" class="form-select">
    @foreach($roles as $role)
    <option value="{{$role}}">{{$role}}</option>
    @endforeach
  </select>

  @error('role')
  <span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
  </span>
  @enderror
</div>

<div class="mb-3">
  <label for="number_id" class="form-label">Cédula</label>
  <input type="number" name="number_id" value="{{old('number_id') ? old('number_id') : (isset($user) ? $user->number_id : '')}}" class="form-control @error('number_id') is-invalid @enderror" id="number_id">
  @error('number_id')
  <span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
  </span>
  @enderror
</div>

<div class="mb-3">
  <label for="email" class="form-label">Correo</label>
  <input type="email" name="email" value="{{old('email') ? old('email') : (isset($user) ? $user->email : '')}}" class="form-control @error('email') is-inval @enderror" id="email">
  @error('email')
  <span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
  </span>
  @enderror
</div>

<div class="mb-3">
  <label for="password" class="form-label">Contraseña</label>
  <input type="password" name="password" value="{{old('password') ? old('password') : (isset($user) ? $user->pasword : '')}}" class="form-control @error('password') is-invalid @enderror" id="password">
  @error('password')
  <span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
  </span>
  @enderror
</div>

<div class="mb-3">
  <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
  <input type="password" name="password_confirmation" value="{{old('password_confirmation') ? old('password_confirmation') : ''}}" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirm_password">
  @error('password_confirmation')
  <span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
  </span>
  @enderror
</div>

<div class="d-flex justify-content-evenly">
  <button type="submit" class="btn btn-primary w-25">Enviar</button>
  <a href="/users" class="btn btn-danger w-25">Cancelar</a>
</div>
