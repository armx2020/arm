<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MapController extends Controller
{
    public function nearbyEntities(Request $request)
    {
        $validated = $request->validate([
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'radius' => 'numeric|min:100|max:10000' // радиус в метрах
        ]);

        Log::info($validated);
        $objects = Entity::nearby(
            $validated['lat'],
            $validated['lon'],
            $validated['radius'] ?? 5000
        )->get();

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $objects->map(function ($item) {
                return [
                    'type' => 'Feature',
                    'id' => $item->id,
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [(float)$item->lat, (float)$item->lon]
                    ],
                    'properties' => [
                        'hintContent' => $item->name,
                        'balloonContent' => "<strong>{$item->name}</strong><br>Расстояние: ".round($item->distance)." м",
                        'clusterCaption' => $item->name
                    ]
                ];
            })->toArray()
        ]);
    }
}
