<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Routing\Route;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testRouter()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText("hello Haikal");
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect("/pzn");
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText("404 hello haikal");
    }
}
