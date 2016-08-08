<?php

namespace Test;

use App\Models\User;
use TestCase;

class HomeControllerTest extends TestCase
{
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = User::find('00000000-0000-0000-0000-000000000000');
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
