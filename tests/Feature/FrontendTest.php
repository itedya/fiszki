<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class FrontendTest extends TestCase
{
    public function test_if_frontent_regex_works()
    {
        $response = $this->get('/' . Str::random(6));
        $response->assertStatus(200);

        $response = $this->get('/api/' . Str::random(32));
        $response->assertStatus(404);
    }

    public function test_if_js_loads()
    {
        $response = $this->get('/js/app.js');
        $response->assertStatus(200);
    }

    public function test_if_css_loads()
    {
        $response = $this->get('/css/app.css');
        $response->assertStatus(200);
    }
}
