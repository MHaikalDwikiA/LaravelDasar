<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
   public function testDependency()
   {
    $foo1 = $this->app->make(Foo::class);// new foo()
    $foo2 = $this->app->make(Foo::class);// new foo()

    self::assertEquals("Foo", $foo1->foo());
    self::assertEquals("Foo", $foo2->foo());
    self::assertSame($foo1, $foo2);
   }

   public function testBind()
   {

    $this->app->bind(Person::class, function ($app){
        return new Person("Juki", "John");
    });

    $person1 = $this->app->make(Person::class);// closure() // new Person("Juki", "John");
    $person2 = $this->app->make(Person::class);// closure() // new Person("Juki", "John");

    self::assertEquals("Juki", $person1->firstName);
    self::assertEquals("Juki", $person2->firstName);
    self::assertNotSame($person1, $person2);
   }

   public function testSingleton()
   {
    $this->app->singleton(Person::class, function ($app){
        return new Person("Juki", "John");
    });

    $person1 = $this->app->make(Person::class);// closure() // new Person("Juki", "John"); if not exists
    $person2 = $this->app->make(Person::class);// return existing

    self::assertEquals("Juki", $person1->firstName);
    self::assertEquals("Juki", $person2->firstName);
    self::assertSame($person1, $person2);
}

    public function testInstance()
    {
        $person = new Person("Juki", "Jhon");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);// $person
        $person2 = $this->app->make(Person::class);// $person

        self::assertEquals("Juki", $person1->firstName);
        self::assertEquals("Juki", $person2->firstName);
        self::assertSame($person1, $person2);
    }


    //error euy

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });

        // $this->app->singleton(Bar::class, function ($app) {
        //     $foo = $app->make(Foo::class);
        //     return new Bar($foo);
        // });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);
        // $bar1 = $this->app->make(Bar::class);
        // $bar2 = $this->app->make(Bar::class);

        // self::assertSame($bar1, $bar2);
        self::assertSame($foo, $bar->foo);
    }

    //error euy

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function ($app){
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);
        self::assertEquals("Halo haikal",$helloService->hello("haikal"));
    }
}
