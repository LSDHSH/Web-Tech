<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('daily_wordle', function (Blueprint $table)
    {
      $table->id();
      $table->date('date')->index(); 
      $table->string('type')->index(); 
      $table->json('data'); 
      $table->unique(['date', 'type']);
    });
  } 
  
  public function down(): void
  {
    Schema::dropIfExists('daily_wordle');
  }
};
