<?php

namespace App\Http\Pipes;

use Closure;
use App\Helpers\Formatters\RequestFormatter;
use App\Helpers\Formatters\ResponseFormatter;

class HotelLegsPipe implements Pipe
{
    function getResponseFromHotelLegs(array $request): array
    {

        //We will fake hotellegs api reponse here
        $hotelLegsResponse = '{
        "results": [
            {
                "room": 1,
                "meal": 1,
                "canCancel": false,
                "price": 123.48
            },
            {
                "room": 1,
                "meal": 1,
                "canCancel": true,
                "price": 150.00
            },
            {
                "room": 2,
                "meal": 1,
                "canCancel": false,
                "price": 148.25
            },
            {
                "room": 2,
                "meal": 2,
                "canCancel": false,
                "price": 165.38

            }
        ]
    }';

        return json_decode($hotelLegsResponse, true);
    }

    public function handle($content, Closure $next)
    {
        //Format Hub Request to HotelLegs Request
        $requestHUB = $content;
        $requestHL = RequestFormatter::HUBToHotelLegsRequest($requestHUB);

        //Add the hotel results and send it to the next pipe if exists
        $hotelLegsResponse = $content->all();
        $hotelLegsResponse['results']['hotelLegs'] = ResponseFormatter::HotelLegsToHUBResponse($this->getResponseFromHotelLegs($requestHL));
        $content->replace($hotelLegsResponse);

        return $next($content);
    }
}
