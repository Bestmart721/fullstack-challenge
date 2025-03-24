<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Services\WeatherService;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users', function (WeatherService $weatherService) {
    $users = User::all()->map(function ($user) use ($weatherService) {
        $weather = $weatherService->getWeather($user->latitude, $user->longitude);
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'weather' => $weather['error'] ?? $weather,
        ];
    });

    return response()->json($users);
});