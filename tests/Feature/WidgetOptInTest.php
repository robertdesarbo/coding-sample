<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\WidgetOptIn;

class WidgetOptInTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_opting_in_to_a_widget_with_a_success_status_code()
    {
        $response = $this->post('/api/widget-opt-in', [
            'email' => $this->faker->unique()->safeEmail(),
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'opt_in' => true
        ]);

        $response->assertStatus(201);
    }

    public function test_opting_in_to_a_widget_with_a_validation_error_status_code()
    {
        $response = $this->post('/api/widget-opt-in', [
            'email' => $this->faker->unique()->safeEmail(),
        ]);

        $response->assertStatus(422);
    }

    public function test_opting_in_to_a_widget_with_correct_database_values()
    {
        $this->post('/api/widget-opt-in', [
            'email' => 'test@gmail.com',
            'first_name' => 'Robert',
            'last_name' => 'DeSarbo',
            'opt_in' => true
        ]);

        $this->assertDatabaseHas('widget_opt_ins', [
            'email' => 'test@gmail.com',
            'first_name' => 'Robert',
            'last_name' => 'DeSarbo',
            'opt_in' => true
        ]);
    }

    public function test_opting_in_to_a_widget_with_no_duplicate_emails()
    {
        $this->post('/api/widget-opt-in', [
            'email' => 'test@gmail.com',
            'first_name' => 'Robert',
            'last_name' => 'DeSarbo',
            'opt_in' => true
        ]);

        $this->post('/api/widget-opt-in', [
            'email' => 'test@gmail.com',
            'first_name' => 'Frank',
            'last_name' => 'Robot',
            'opt_in' => true
        ]);

        $this->assertDatabaseCount('widget_opt_ins', 1);

        $this->assertDatabaseMissing('widget_opt_ins', [
            'email' => 'test@gmail.com',
            'first_name' => 'Frank',
            'last_name' => 'Robot',
            'opt_in' => true
        ]);
    }

    public function test_opting_out_of_a_widget_with_correct_database_values()
    {
        $widgetOptIn = WidgetOptIn::create([
            'email' => 'test@gmail.com',
            'first_name' => 'Robert',
            'last_name' => 'DeSarbo',
            'opt_in' => true
        ]);

        $this->patch('/api/widget-opt-in/'.$widgetOptIn->id, [
            'opt_in' => false
        ]);

        $this->assertDatabaseHas('widget_opt_ins', [
            'id' => $widgetOptIn->id,
            'opt_in' => false
        ]);
    }
}
