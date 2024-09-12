<?php

namespace App\Http\Pipes;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;


class HUBPipeline
{
    const HOTELS_PIPES = [
        "hotelLegs" => HotelLegsPipe::class
        // Keep adding hotels providers
    ];

    public static function search(Request $request): JsonResponse
    {

        $hotelPipesSelected = array_map(fn ($hotelId) => HUBPipeline::HOTELS_PIPES[$hotelId], $request->hotelId);
        $results = Pipeline::send($request)
            ->through($hotelPipesSelected)
            ->then(fn($result) => $result->results);

        return response()->json($results);
    }
}
