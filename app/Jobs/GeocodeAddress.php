<?php

namespace App\Jobs;

use App\Models\Entity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodeAddress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Entity $entity)
    {
        $this->delay = now()->addSeconds(2);
    }

    public function handle(): void
    {
        if ($this->entity->coordinates && $this->entity->address && $this->entity->city_id) {
            return;
        }

        try {
            $response = Http::withHeaders([
                'User-Agent' => 'vsearmyane.com/1.0 (vsearmyane@gmail.com)',
            ])->get('https://nominatim.openstreetmap.org/search', [
                'q' => $this->entity->city->name . ', ' . $this->entity->address,
                'format' => 'json',
            ]);

            $data = $response->json();

            if (!empty($data[0])) {
                $this->entity->update([
                    'lat' => $data[0]['lat'],
                    'lon' => $data[0]['lon'],
                ]);
            } else {
                Log::error("Geocoding failed: {$this->entity->id}", ['status' => $response->status()]);
            }
        } catch (\Exception $e) {
            Log::error("Geocoding failed for Entity ID: {$this->entity->id}", ['error' => $e->getMessage()]);
            $this->release(60); // Повторить через 60 сек
        }
    }
}
