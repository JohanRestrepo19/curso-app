<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name' => ['required', 'string'],
      'last_name' => ['required', 'string'],
      'number_id' => ['required', 'numeric', 'unique:users,number_id'],
      'email' => ['required', 'email', 'unique:users,email'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'role' => ['required']
    ];
  }


  public function messages()
  {
    return [
      'name.required' => 'El nombre es requerido.',
      'name.string' => 'El nombre debe ser una cadena.',

      'last_name.required' => 'El apellido es requerido.',
      'last_name.string' => 'El apellido debe ser una cadena.',

      'number_id.required' => 'El documento es requerido.',
      'number_id.numeric' => 'El documento debe ser número.',
      'number_id.unique' => 'El documento ya está en uso.',

      'email.required' => 'El email es requerido.',
      'email.email' => 'El email no es válido.',
      'email.unique' => 'El email ya está en uso.',

      'password.required' => 'La contraseña es requerida.',
      'password.string' => 'La constraseña no es válida.',
      'password.min' => 'La constraseña debe tener al menos 8 caracteres.',
      'password.confirmed' => 'La constraseña no coincide.',
    ];
  }
}
