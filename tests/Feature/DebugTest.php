<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DebugTest extends TestCase
{
    use RefreshDatabase;

    public function test_debug(): void
    {
        $user = User::factory()->create();

        $this->withoutExceptionHandling();

        try {
            $response = $this->actingAs($user)->get('/profile');
            fwrite(STDERR, "PROFILE STATUS: {$response->status()}\n");
        } catch (\Throwable $e) {
            fwrite(STDERR, 'PROFILE EXCEPTION: ' . get_class($e) . ': ' . $e->getMessage() . "\n");
            fwrite(STDERR, 'PROFILE FILE: ' . $e->getFile() . ':' . $e->getLine() . "\n");
        }

        try {
            $response = $this->actingAs($user)->get(route('admin.institutions.index'));
            fwrite(STDERR, "INST STATUS: {$response->status()}\n");
        } catch (\Throwable $e) {
            fwrite(STDERR, 'INST EXCEPTION: ' . get_class($e) . ': ' . $e->getMessage() . "\n");
            fwrite(STDERR, 'INST FILE: ' . $e->getFile() . ':' . $e->getLine() . "\n");
        }

        $this->assertTrue(true);
    }
}
