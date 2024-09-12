<?php

namespace Database\Seeders;

use App\Models\PaypalProduct;
use App\Traits\PayPalTrait;
use Illuminate\Database\Seeder;

class AddProductPaypalSeeder extends Seeder
{
    use PayPalTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Video Streaming Service',
            'description' => 'Video streaming service',
            'type' => 'SERVICE',
            'category' => 'SOFTWARE',
            'home_url' => 'https://thefamilyflix.com/'
        ];

        $response = $this->createProduct($data);

        if (isset($response->id)) {
            $paypal_product = new PaypalProduct();
            $paypal_product->product_id = $response->id;
            $paypal_product->product_name = $response->name;
            $paypal_product->save();
        } else {
            echo "Product creation failed";
        }
    }
}
