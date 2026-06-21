<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

#[Fillable(['name', 'email', 'password', 'email_verified_at', 'two_factor_code', 'two_factor_expires_at', 'last_login'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
	use HasFactory, Notifiable;
	
	protected function casts(): array
	{
		return
		[
			'password' => 'hashed',
			'last_login' => 'datetime',
			'email_verified_at' => 'datetime',
			'two_factor_expires_at' => 'datetime',
		];
	}
	
	public function roles()
	{
    return $this->belongsToMany(Role::class);
	}
	
	public function hasRole(string $roleName): bool
	{
		return $this->roles->contains('name', $roleName);
	}
	
	public function getRouteKeyName(): string
	{
		return 'email';
	}
}
