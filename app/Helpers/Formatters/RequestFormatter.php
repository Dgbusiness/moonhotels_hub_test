<?php

namespace App\Helpers\Formatters;

use DateTime;

class RequestFormatter
{
    public static function HUBToHotelLegsRequest(Object $request): array
    {

        // Please refer to the PDF task description to see the HUB request format.
        $numbersOfNights = (new DateTime($request->checkOut))->diff(new Datetime($request->checkIn));
        return [
            "hotel" => $request->hotelId,
            "checkInDate" => $request->checkIn,
            "numberOfNights" => $numbersOfNights->days,
            "guests" => $request->numberOfGuests,
            "rooms" => $request->numberOfRooms,
            "currency" => $request->currency
        ];
    }

    //Continues to add request formatters as Hotel providers have
}
