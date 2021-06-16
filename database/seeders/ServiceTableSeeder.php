<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'parent_id' => null,
                'has_children' => 1,
                'photo' => '1617621770_service-icon-1.png',
                'status' => 1,
                'en' => [
                    'text' => 'Cap Service',
                    'description' => 'Aenean dictum odio sit amet congue semper. In laoreet metus nec dolor ullamcorper, ut iaculis risus scelerisque.',
                ],
                'ar' => [
                    'text' => 'Cap Service',
                    'description' => 'Service 1 Description',
                ],
            ],
            [
                'parent_id' => null,
                'has_children' => 1,
                'photo' => '1617621770_service-icon-1.png',
                'status' => 1,
                'en' => [
                    'text' => 'Towing Truck',
                    'description' => 'Aenean dictum odio sit amet congue semper. In laoreet metus nec dolor ullamcorper, ut iaculis risus scelerisque.',
                ],
                'ar' => [
                    'text' => 'Towing Truck',
                    'description' => 'Service 1 Description',
                ],
            ],
            [
                'parent_id' => null,
                'has_children' => 1,
                'photo' => '1617621770_service-icon-1.png',
                'status' => 1,
                'en' => [
                    'text' => 'Transportation',
                    'description' => 'Aenean dictum odio sit amet congue semper. In laoreet metus nec dolor ullamcorper, ut iaculis risus scelerisque.',
                ],
                'ar' => [
                    'text' => 'Service 1',
                    'description' => 'Service 1 Description',
                ],
            ],
            [
                'parent_id' => null,
                'has_children' => 1,
                'photo' => '1617621770_service-icon-2.png',
                'status' => 1,
                'en' => [
                    'text' => 'Renting',
                    'description' => 'Aenean dictum odio sit amet congue semper. In laoreet metus nec dolor ullamcorper, ut iaculis risus scelerisque.',
                ],
                'ar' => [
                    'text' => 'Service 2',
                    'description' => 'Aenean dictum odio sit amet congue semper. In laoreet metus nec dolor ullamcorper, ut iaculis risus scelerisque.',
                ],
            ],
            [
                'parent_id' => null,
                'has_children' => 1,
                'photo' => '1617621770_service-icon-4.png',
                'status' => 1,
                'en' => [
                    'text' => 'Parcel',
                    'description' => 'Aenean dictum odio sit amet congue semper. In laoreet metus nec dolor ullamcorper, ut iaculis risus scelerisque.',
                ],
                'ar' => [
                    'text' => 'Parcel',
                    'description' => 'Aenean dictum odio sit amet congue semper. In laoreet metus nec dolor ullamcorper, ut iaculis risus scelerisque.',
                ],
            ],

        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        $categories = [
            [
                'service_id' => 1, 'status' => 1,
                'en' => ['text' => 'category 1', 'brief' => 'category 1'],
                'ar' => ['text' => 'category 1', 'brief' => 'category 1'],
            ],
            [
                'service_id' => 1, 'status' => 1,
                'en' => ['text' => 'category 2', 'brief' => 'category 2'],
                'ar' => ['text' => 'category 2', 'brief' => 'category 2'],
            ],
            [
                'service_id' => 2, 'status' => 1,
                'en' => ['text' => 'category 1', 'brief' => 'category 1'],
                'ar' => ['text' => 'category 1', 'brief' => 'category 1'],
            ],
            [
                'service_id' => 2, 'status' => 1,
                'en' => ['text' => 'category 2', 'brief' => 'category 2'],
                'ar' => ['text' => 'category 2', 'brief' => 'category 2'],
            ]

        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

    }
}
