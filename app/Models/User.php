<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Lend;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

	protected $fillable = [
		'number_id',
		'name',
		'last_name',
		'email',
		'password',
	];

	protected $appends = ['full_name'];

	protected $hidden = [
		'password',
	];

	protected $casts = [
		'created_at' => 'datetime:Y-m-d',
		'updated_at' => 'datetime:Y-m-d',
	];

	// Accesor (get)
	public function getFullNameAttribute()
	{
		return "{$this->name} {$this->last_name}";
	}

	// MUtator (create - update)
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}

	// Relations
	public function customerLends()
	{
		return $this->hasMany(Lend::class, 'customer_user_id', 'id');
	}

	public function ownerLends()
	{
		return $this->hasMany(Lend::class, 'owner_user_id', 'id');
	}
}
