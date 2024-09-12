<?php

namespace Tests\Unit;

use App\Helpers\Formatters\ResponseFormatter;
use PHPUnit\Framework\TestCase;

class ResponseFormatterTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_HotellegsToHubReponse(): void
    {
        $inputData = [
            'results' => [
                [
                    'room' => 1,
                    'meal' => 1,
                    'canCancel' => false,
                    'price' => 123.48
                ],
                [
                    'room' => 1,
                    'meal' => 1,
                    'canCancel' => true,
                    'price' => 150.00
                ],
                [
                    'room' => 2,
                    'meal' => 1,
                    'canCancel' => false,
                    'price' => 148.25
                ],
                [
                    'room' => 2,
                    'meal' => 2,
                    'canCancel' => false,
                    'price' => 165.38

                ]
            ]
        ];


        $result = (new ResponseFormatter)->HotelLegsToHUBResponse($inputData);

        $expectedOutput = [
            'rooms' => [
                [
                    'roomId' => 1,
                    'rates' => [
                        [
                            'mealPlanId' => 1,
                            'isCancellable' => false,
                            'price' => 123.48
                        ],
                        [
                            'mealPlanId' => 1,
                            'isCancellable' => true,
                            'price' => 150.00
                        ]
                    ]
                ],
                [
                    'roomId' => 2,
                    'rates' => [
                        [
                            'mealPlanId' => 1,
                            'isCancellable' => false,
                            'price' => 148.25
                        ],
                        [
                            'mealPlanId' => 2,
                            'isCancellable' => false,
                            'price' => 165.38

                        ]
                    ]
                ]
            ]
        ];


        $this->assertEquals($expectedOutput, $result);
    }
}
