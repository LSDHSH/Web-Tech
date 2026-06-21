<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
	public function run(): void
	{
		Role::updateOrCreate(
			['name' => 'admin'],
			['display_name' => 'Administrator']
		);
		
		Role::updateOrCreate(
			['name' => 'user'],
			['display_name' => 'User']
		);
	}
}
