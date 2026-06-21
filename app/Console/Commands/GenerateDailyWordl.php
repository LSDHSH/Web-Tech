<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Repositories\Api\GameRepository;
use App\Repositories\Api\MovieRepository;
use App\Repositories\Api\SeriesRepository;
use App\Repositories\Api\CountryRepository;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Attributes\Description;

#[Signature('wordl:generate')]
#[Description('Generates the daily Wordle')]
class GenerateDailyWordl extends Command
{
	public function handle()
	{
		$today = now()->toDateString();
		$this->info("=== Starte Wordl-Generierung für den {$today} ===");
		
		$modes =
		[
			'game'    => GameRepository::class,
			'movie'  	=> MovieRepository::class,
			'series'  => SeriesRepository::class,
			'country' => CountryRepository::class,
		];
		
		foreach ($modes as $type => $class)
		{
			try
			{
				$repo = app($class);
				$data = $repo->random();
				
				DB::table('daily_wordle')->updateOrInsert(
				[
					'date'     => $today,
					'type' => $type
				],
				[
					'data'   => json_encode($data), 
				]
				);
				$this->info("Erfolgreich in der DB gespeichert für {$type}!");
			}
			catch (\Exception $e)
			{
				$this->error("Fehler in Kategorie {$type}: {$e->getMessage()}");
			}
		}
		
		$this->info("=== Generierung abgeschlossen ===");
		return Command::SUCCESS;
	}
}
