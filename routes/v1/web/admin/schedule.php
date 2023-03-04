<?php

use App\Http\Controllers\Admin\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::resource('schedule', ScheduleController::class);
