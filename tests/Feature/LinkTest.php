<?php

namespace Tests\Feature;

use App\Models\Link;
use App\Service\LinkService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_same_uri()
    {
        $response = $this->post('/', [
            'url' => 'http://test.ru',
            'short_uri' => 'same',
        ]);

        $response->assertSessionDoesntHaveErrors();

        $response = $this->post('/', [
            'url' => 'http://test.ru',
            'short_uri' => 'same',
        ]);
        $response->assertSessionHasErrors('short_uri');
    }


    public function test_uri_with_slashes()
    {
        $response = $this->post('/', [
            'url' => 'http://test.ru',
            'short_uri' => 'some/uri',
        ]);
        $response->assertSessionDoesntHaveErrors();

        $response = $this->get('/some/uri');
        $response->assertStatus(302);
    }

    public function test_expired_links()
    {

        $response = $this->post('/', [
            'url' => 'http://test.ru',
            'short_uri' => 'uri',
            'expires_at' => Carbon::now()->addMinutes(10)->format('Y-m-d\TH:i'),
            'timezone' => 0
        ]);
        $response->assertSessionDoesntHaveErrors();

        $response = $this->get('uri');

        $response->assertStatus(302);

        $response = $this->post('/', [
            'url' => 'http://test.ru2',
            'short_uri' => 'uri2',
            'expires_at' => Carbon::now()->subMinutes(1),
            'timezone' => 0
        ]);
        $response->assertSessionDoesntHaveErrors();

        $response = $this->get('uri2');

        $response->assertStatus(404);
    }


    public function test_expires_timezone()
    {
        $response = $this->post('/', [
            'url' => 'http://test.ru',
            'short_uri' => 'uri',
            'expires_at' => Carbon::now(),
            'timezone' => -120
        ]);
        $response->assertSessionDoesntHaveErrors();

        $response = $this->get('uri');

        $response->assertStatus(404);
    }

    public function test_reach_statistic()
    {
        $response = $this->post('/', [
            'url' => 'http://test.ru',
            'short_uri' => 'some_uri',
        ]);
        $response->assertSessionDoesntHaveErrors();

        $this->assertDatabaseCount('link_statistics', 0);

        $this->get('some_uri');
        $this->get('some_uri');
        $this->get('some_uri');
        $this->get('some_uri');
        $this->get('some_uri');

        $this->assertDatabaseCount('link_statistics', 5);

        $this->get('some_uri');
        $this->get('some_uri');
        $this->get('some_uri');
        $this->get('some_uri');
        $this->get('some_uri');

        $this->assertDatabaseCount('link_statistics', 10);
    }
}
