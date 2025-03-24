<?php

namespace Tests\Feature;

use Tests\TestCase;

class WeatherTest extends TestCase
{
    public function test_users_endpoint_returns_weather_data()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'email', 'weather'],
        ]);
    }
}