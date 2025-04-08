<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function nearbyEntities(Request $request)
    {
        $validated = $request->validate([
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'radius' => 'numeric|min:100|max:10000' // радиус в метрах
        ]);

        return Entity::nearby(
            $validated['lat'],
            $validated['lon'],
            $validated['radius'] ?? 5000
        )->get();
    }
}
