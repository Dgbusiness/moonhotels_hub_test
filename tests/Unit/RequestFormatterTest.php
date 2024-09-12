<?php

namespace Tests\Unit;

use App\Helpers\Formatters\RequestFormatter;
use PHPUnit\Framework\TestCase;

class RequestFormatterTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_HubToHotellegsRequest(): void
    {
        $inputData = [
            'hotelId' => 1,
            'checkIn' => '2018-10-20',
            'checkOut' => '2018-10-25',
            'numberOfGuests' => 3,
            'numberOfRooms' => 2,
            'currency' => 'EUR'
        ];
        $result = (new RequestFormatter)->HUBToHotelLegsRequest( (object) $inputData);

        $expectedOutput = [
            'hotel' => 1,
            'checkInDate' => '2018-10-20',
            'numberOfNights' => 5,
            'guests' => 3,
            'rooms' => 2,
            'currency' => 'EUR'
        ];

        $this->assertEquals($expectedOutput, $result);

    }
}
