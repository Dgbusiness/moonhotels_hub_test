<?php

namespace App\Http\Pipes;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;


class HUBPipeline
{
    public static function search(Request $request): JsonResponse
    {

        $results = Pipeline::send($request)
            ->through([
                HotelLegsPipe::class,
                // Keep adding hotels providers
            ])
            ->then(fn($result) => $result->results);

        return response()->json($results);
    }
}
