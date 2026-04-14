<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function store()
    {
        // Create User
        $user = User::create([
            'name' => 'Winston',
            'email' => 'winston@gmail.com',
            'password' => bcrypt('123456')
        ]);

        // One-to-One (User -> Profile)
        $profile = $user->profile()->create([
            'address' => 'Angeles City',
            'phone' => '09123456789'
        ]);

        // One-to-Many (Profile -> Orders)
        $order = $profile->orders()->create([
            'order_name' => 'First Order'
        ]);

        // Create Products
        $product1 = Product::create([
            'name' => 'Laptop',
            'price' => 25000
        ]);

        $product2 = Product::create([
            'name' => 'Mouse',
            'price' => 500
        ]);

        // Many-to-Many (Order -> Products)
        $order->products()->attach([$product1->id, $product2->id]);

        return "Data Inserted Successfully!";
    }

    public function show()
    {
        $users = User::with('profile.orders.products')->get();

        return $users;
    }
}