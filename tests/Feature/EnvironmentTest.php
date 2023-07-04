<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testEnvironment()
    {
        $haikal = env("haikal");

        self::assertEquals("jelek", $haikal);
    }

    public function testDefaultEnv()
    {
        $dwiki = env("fifi", "ganteng");

        self::assertEquals("ganteng", $dwiki);
    }
}
