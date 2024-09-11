<?php

namespace App\Helpers\Formatters;

class ResponseFormatter
{
    public static function HotelLegsToHUBResponse(array $request): array
    {

        // Please refer to the PDF task description to see the HUB response format.
        $formattedData = [];
        foreach ($request['results'] as $result) {
            $roomId = $result['room'];
            $mealPlanId = $result['meal'];
            $isCancellable = $result['canCancel'];
            $price = $result['price'];

            if (!isset($formattedData[$roomId])) {
                $formattedData[$roomId] = [
                    'roomId' => $roomId,
                    'rates' => [],
                ];
            }

            $formattedData[$roomId]['rates'][] = [
                'mealPlanId' => $mealPlanId,
                'isCancellable' => $isCancellable,
                'price' => $price,
            ];
        }

        return [
            'rooms' => array_values($formattedData),
        ];
    }

    //Continues to add response formatters as Hotel providers have

}
