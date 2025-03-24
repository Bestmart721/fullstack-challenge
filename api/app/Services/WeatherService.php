<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    public function getWeather($latitude, $longitude)
    {
        $cacheKey = "weather_{$latitude}_{$longitude}";
        return Cache::remember($cacheKey, 3600, function () use ($latitude, $longitude) {
            $response = Http::get(env('WEATHER_API_URL'), [
                'lat' => $latitude,
                'lon' => $longitude,
                'appid' => env('WEATHER_API_KEY'),
                'units' => 'metric',
            ]);

            if ($response->failed()) {
                return [
                    'error' => 'Weather data unavailable',
                    'status' => $response->status(),
                ];
            }

            return $response->json();
        });
    }
}