<?php

namespace Tests\Feature;

use App\Models\TrackingLog;
use App\Models\Url;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class UrlTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifies if the authorization is working.
     *
     * @test
     */
    public function authentication_is_required()
    {
        $this->postJson(route('urls.index'))
            ->assertUnauthorized();
    }

    /**
     * Test index route.
     *
     * @test
     */
    public function index()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->get(route('urls.index'))
            ->assertStatus(200);
    }

    /**
     * Validates the payload.
     * - address: should be required, should be an url
     *
     * @test
     */
    public function validate_the_payload()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->postJson(route('urls.store'))
            ->assertJsonValidationErrors([
                'address' => __('validation.required', ['attribute' => 'address']),
            ]);

        $this->postJson(route('urls.store'), ['address' => 'not-valid-url'])
            ->assertJsonValidationErrors([
                'address' => __('validation.url', ['attribute' => 'address']),
            ]);
    }

    /**
     * Verifies if it is creating urls.
     *
     * @test
     */
    public function creating_url()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('urls.store'), [
                'name' => 'test',
                'address' => 'https://www.teste.url',
            ]);

        $this->assertDatabaseHas('urls', [
            'name' => 'test',
            'address' => 'https://www.teste.url',
        ]);
    }

    /**
     * Verifies if it is deleting urls.
     *
     * @test
     */
    public function deleting_url()
    {
        $user = User::factory()->create();
        $url = Url::factory()->create();

        $this->actingAs($user)
            ->delete(route('urls.destroy', $url->id), [
                'name' => 'test',
                'address' => 'https://www.teste.url',
            ]);

        $this->assertDatabaseMissing('urls', [
            'name' => 'test',
            'address' => 'https://www.teste.url',
        ]);
    }

    /**
     * Track url.
     *
     * @test
     */
    public function track_url()
    {
        $url = Url::factory()->create();
        Http::fake([
            $url->address => Http::response('HTML response', 200),
        ]);

        $this->artisan('command:trackurls')->assertSuccessful();

        $log = TrackingLog::where('url_id', $url->id)->first();

        $this->assertEquals('HTML response', $log->body);
    }
}
