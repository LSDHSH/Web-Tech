<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('wordl:generate')->dailyAt('00:00');