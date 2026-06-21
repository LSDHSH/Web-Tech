<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
	use WithoutModelEvents;
	
	public function run(): void
	{
		$this->call(
		[
			RoleSeeder::class,
			GameSeeder::class,
			MovieSeeder::class,
			SeriesSeeder::class,
			CountrySeeder::class,
		]);	
	}
}
