<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $userData = [
            [
                'name' => 'Zaky',
                'username' => 'zaky',
                'password' => bcrypt('zaky'),
                'email' => 'jaki@example.com',
                'phone' => '001122331144',
                'role' => 'administrator',
                'address' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Aldi Setiawan',
                'username' => 'aldi',
                'password' => bcrypt('aldi'),
                'email' => 'aldi@example.com',
                'phone' => '001122331141',
                'role' => 'buyer',
                'address' => 'Bandar Lampung',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        User::insert($userData);
        $data = [
        [  
            'gender' => 'Laki-laki'
        ],
        [
            'gender' => 'Perempuan'
        ],
        [
            'gender' => 'Unisex'
        ],
    ]; 

        Category::insert($data);

        $productData = [
            [
                'name' => 'Hoodie PLHM',
                'category_id' => 1,
                'price' => 75000,
                'description' => '- code = HD10<br>
                - size = -<br>
                - Ld = 47cm<br>
                - P = 70cm<br>
                - condition = 90%<br>
                - merk = PLHM<br>
                - minus = -<br>
                <br>
                @ 75k<br>
                DM/WA for more details<br>
                <br>
                _____________<br>
                Info order 📨<br>
                DM or WhatsApp<br>
                _____________<br>
                * Notes<br>
                Tinggi model = 158cm<br>
                Berat Model = 45kg',
                'stock' => 3,
                'photo' => 'photos/products/product-1.jpg',
                'video_link' => 'https://youtu.be/0zuDPVPCv8g',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Crewneck FRILLMOND',
                'category_id' => 1,
                'price' => 65000,
                'description' => '
                - code = CN14<br>
                - size = -<br>
                - Ld = 54cm<br>
                - P = 57cm<br>
                - condition = 85%<br>
                - merk = FRILLMOND<br>
                - minus = -<br>
                <br>
                @ 65k<br>
                DM/WA for more details<br>
                <br>
                _____________<br>
                Info order 📨<br>
                DM or WhatsApp<br>
                _____________<br>
                * Notes<br>
                Tinggi model = 158cm<br>
                Berat Model = 45kg',
                'stock' => 1,
                'photo' => 'photos/products/product-2.jpg',
                'video_link' => 'https://youtu.be/YZeL5wv1mJY',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Crewneck TORA',
                'category_id' => 1,
                'price' => 65000,
                'description' => '
                - code = CN13<br>
                - size = -<br>
                - Ld = 62cm<br>
                - P = 61cm<br>
                - condition = 85%<br>
                - merk = TORA<br>
                - minus = -<br>
                <br>
                @ 65k<br>
                DM/WA for more details<br>
                <br>
                _____________<br>
                Info order 📨<br>
                DM or WhatsApp<br>
                _____________<br>
                * Notes<br>
                Tinggi model = 158cm<br>
                Berat Model = 45kg',
                'stock' => 2,
                'photo' => 'photos/products/product-3.jpg',
                'video_link' => 'https://youtu.be/HzxzpoaLGrM',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Crewneck Simple',
                'category_id' => 1,
                'price' => 50000,
                'description' => '
                - code = CN10 <br>
                - size = -<br>
                - Ld = 80cm<br>
                - P = 60cm<br>
                - condition = 80%<br>
                - merk = Simple<br>
                - minus = slide terakhir<br>
                <br>
                @ 50k<br>
                DM/WA for more details<br>
                <br>
                _____________<br>
                Info order 📨<br>
                DM or WhatsApp<br>
                _____________<br>
                * Notes<br>
                Tinggi model = 158cm<br>
                Berat Model = 45kg',
                'stock' => 1,
                'photo' => 'photos/products/product-4.jpg',
                'video_link' => 'https://youtu.be/2rEqXbdzmNA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Product::insert($productData);

        $cartData = [
            [
                'user_id' => 2,
                'product_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'product_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        Cart::insert($cartData);

    }
}
