<?php

namespace Test;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use TestCase;

class HomeControllerTest extends TestCase
{
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = User::find(Uuid::NIL);
    }

    public function testHomePage()
    {
        $this->actingAs($this->user)
            ->visit('/')->see('Dashboard');
        $this->checkLayout();
    }

    public function testUserCreatePage()
    {
        $this->actingAs($this->user)
            ->visit('/user/create')
            ->see('User Create')
            ->see('Submit');
        $this->checkLayout();
    }
}
