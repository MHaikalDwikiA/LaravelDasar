<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
    $this->get('/hello')
        ->assertSeeText("Hello Haikal");

    $this->get('/hello-again')
        ->assertSeeText("Hello Haikal");
    }

    public function testNested()
    {
    $this->get('/hello-world')
        ->assertSeeText("World Danis");
    }

    public function testTemplate()
    {
        $this->view('/hello', ['name' => 'Haikal'])
            ->assertSeeText("Hello Haikal");

        $this->view('/hello.world', ["name" => 'Danis'])
            ->assertSeeText("World Danis");


    }
}
