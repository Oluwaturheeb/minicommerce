<?php

namespace Tests\Feature;

use App\Models\Items;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * Visit the hompage
     */
    public function test_hompage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login(): void {
        $response = $this->post('/login', [
            'email' => 'john@example.net',
            'password' => 'password',
        ]);

        $response->assertRedirectToRoute('index');
    }

    public function test_add_item_to_cart(): void {
        $item = Items::first();
        $this->get('/login')->type('john@example.net', 'email')->type('password', 'password')->click('Login');
        $response = $this->post('/add-to-cart', [
            'cart_item' => $item->id,
            'quantity' => 2
        ]);

        $response->assertRedirectToRoute('cart');
    }



    // public function test_
}
