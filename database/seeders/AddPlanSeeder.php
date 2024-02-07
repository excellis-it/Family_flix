<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\PlanSpecification;
use Illuminate\Database\Seeder;

class AddPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'plan_name' => 'Starter',
                'plan_details' => 'Welcome to our starter pack where 2 people can enjoy unlimited movies and shows.',
                'plan_actual_price' => '30',
                'plan_offer_price' => '25',
                'button_text' => 'Subscribe',
                'specification' => [
                    [
                        'specification_name' => '1-2 Device Limit',
                    ],
                    [
                        'specification_name' => 'Preminum Server',
                    ],
                    [
                        'specification_name' => 'Full HD Available',
                    ], 
                    [
                        'specification_name' => 'Desktop, Mobile and TV App',
                    ],
                    [
                        'specification_name' => 'Unlimited Movies and TV Shows',
                    ],  
                ],
            ],
            [
                'plan_name' => 'Professional',
                'plan_details' => 'Our professional pack is perfect for families to enjoy the best entertainment there is',
                'plan_actual_price' => '40',
                'plan_offer_price' => '30',
                'button_text' => 'Subscribe',
                'specification' => [
                    [
                        'specification_name' => '1-3 Device Limit',
                    ],
                    [
                        'specification_name' => 'Preminum Server',
                    ],
                    [
                        'specification_name' => 'Full HD Available',
                    ], 
                    [
                        'specification_name' => 'Desktop, Mobile and TV App',
                    ],
                    [
                        'specification_name' => 'Unlimited Movies and TV Shows',
                    ],  
                ],
            ],
            [
                'plan_name' => 'Executive',
                'plan_details' => 'Avail our executive plan for best value deals for maximum number of devices',
                'plan_actual_price' => '50',
                'plan_offer_price' => '42',
                'button_text' => 'Subscribe',
                'specification' => [
                    [
                        'specification_name' => '1-5 Device Limit',
                    ],
                    [
                        'specification_name' => 'Preminum Server',
                    ],
                    [
                        'specification_name' => 'Full HD Available',
                    ], 
                    [
                        'specification_name' => 'Desktop, Mobile and TV App',
                    ],
                    [
                        'specification_name' => 'Unlimited Movies and TV Shows',
                    ],  
                ],
            ],
          
        ];

        foreach ($plans as $plan) {
            $planModel = new Plan();
            $planModel->plan_name = $plan['plan_name'];
            $planModel->plan_details = $plan['plan_details'];
            $planModel->plan_actual_price = $plan['plan_actual_price'];
            $planModel->plan_offer_price = $plan['plan_offer_price'];
            $planModel->button_text = $plan['button_text'];
            $planModel->save();

            foreach ($plan['specification'] as $specification) {
                $specificationModel = new PlanSpecification();
                $specificationModel->plan_id = $planModel->id;
                $specificationModel->specification_name = $specification['specification_name'];
                $specificationModel->save();
            }
        }                                                                                                                                                           
    }
}
