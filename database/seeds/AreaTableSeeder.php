<?php

use Illuminate\Database\Seeder;
use App\Area;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // array containing areas in specific NestedSet format.
        $areas = [
            [
                'name' => 'US',
                'children' => [
                    [
                        'name' => 'Alabama',
                        'children' => [
                            ['name' => 'Auburn'],
                            ['name' => 'Birmingham'],
                            ['name' => 'Dothan'],
                            ['name' => 'Florence / Muscle shoals'],
                            ['name' => 'Huntsville / Decatur'],
                            ['name' => 'Mobile'],
                            ['name' => 'Montgomery'],
                            ['name' => 'Tuscaloosa'],
                        ],
                    ],
                    [
                        'name' => 'Alaska',
                        'children' => [
                            ['name' => 'Anchorage / Mat-su'],
                            ['name' => 'Fairbanks'],
                            ['name' => 'Kenai Peninsula'],
                            ['name' => 'Southeast Alaska'],
                        ],
                    ],
                    [
                        'name' => 'Arizona',
                        'children' => [
                            ['name' => 'Flagstaff / Sedona'],
                            ['name' => 'Mohave County'],
                            ['name' => 'Phoenix'],
                            ['name' => 'Prescott'],
                            ['name' => 'Show Low'],
                            ['name' => 'Sierra Vista'],
                            ['name' => 'Tucson'],
                            ['name' => 'Yuma'],
                        ],
                    ],
                    [
                        'name' => 'Arkansas',
                        'children' => [
                            ['name' => 'Fayetteville'],
                            ['name' => 'Fort Smith'],
                            ['name' => 'Jonesboro'],
                            ['name' => 'Little Rock'],
                            ['name' => 'Texarkana'],
                        ],
                    ],
                    [
                        'name' => 'California',
                        'children' => [
                            ['name' => 'Bakersfield'],
                            ['name' => 'Chico'],
                            ['name' => 'Fresno / Madera'],
                            ['name' => 'Gold Country'],
                            ['name' => 'Hanford-Corcoran'],
                            ['name' => 'Humboldt County'],
                            ['name' => 'Inland Empire'],
                            ['name' => 'Los Angeles'],
                            ['name' => 'Mendocino County'],
                            ['name' => 'Merced'],
                            ['name' => 'Modesto'],
                            ['name' => 'Monterey Bay'],
                            ['name' => 'Orange County'],
                            ['name' => 'Palm Springs'],
                            ['name' => 'Redding'],
                            ['name' => 'Sacramento'],
                            ['name' => 'San Diego'],
                            ['name' => 'San Francisco Bay Area'],
                            ['name' => 'San Luis Obispo'],
                            ['name' => 'Santa Barbara'],
                            ['name' => 'Santa Maria'],
                            ['name' => 'Siskiyou County'],
                            ['name' => 'Stockton'],
                            ['name' => 'Susanville'],
                            ['name' => 'Ventura County'],
                            ['name' => 'Visalia-Tulare'],
                            ['name' => 'Yuba-Sutter'],
                        ],
                    ],
                ],

            ],
            [
                'name' => 'UK',
                'children' => [
                    ['name' => 'London'],
                    ['name' => 'Oxford'],
                    ['name' => 'Surrey'],
                    ['name' => 'Edinburgh'],
                    ['name' => 'Reading'],
                ],
            ],
        ];

        // Iterate through each area (e.g. US)
        foreach ($areas as $area) {
            Area::create($area);
        }

    }
}
