<?php

namespace Tests\Integration\Actions;

use App\Actions\Loads\CreateLoadMatches;
use App\Models\Load;
use App\Models\Movement;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class CreateLoadMatchesTest extends TestCase
{
    public function it_should_create_matches_for_a_load(): void
    {
        Notification::fake();

        $load = Load::factory()->create();
        $movement = Movement::factory()->create();

        app(CreateLoadMatches::class)->execute($load, true);

        $this->assertDatabaseCount('matches', 1);
    }
}
