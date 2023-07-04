<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfiguration()
    {
        $firstName = config("contoh.Bima.first");
        $lastName = config("contoh.Bima.last");
        $email = config("contoh.email");
        $ig = config("contoh.ig");

        self::assertEquals("Coki", $firstName);
        self::assertEquals("dede", $lastName);
        self::assertEquals("haikalofficial13@gmail.com", $email);
        self::assertEquals("kal.da_", $ig);


    }
}
