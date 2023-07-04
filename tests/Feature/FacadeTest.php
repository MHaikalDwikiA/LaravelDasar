<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {

    $config = $this->app->make("config");
    $firstname3 = $config->get("contoh.Bima.first");

    $firstname1 = config("contoh.Bima.first");
    $firstname2 = Config::get("contoh.Bima.first");

    self::assertEquals($firstname1, $firstname2);
    self::assertEquals($firstname1, $firstname3);

    // var_dump(Config::all());
    var_dump($config->all());
    }

    public function testConfigMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.Bima.first')
            ->andReturn('haikal jelek');

        $firstname = Config::get("contoh.Bima.first");

        self::assertEquals("haikal jelek", $firstname);
    }
}
