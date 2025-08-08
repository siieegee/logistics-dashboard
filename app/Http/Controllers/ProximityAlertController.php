<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProximityAlertController extends Controller
{
    public function checkProximity(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'nullable|numeric',
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = $request->radius ?? 250;

        // Fixed warehouse location (can be moved to config)
        $warehouseLat = 14.5995;
        $warehouseLng = 120.9842;

        try {
            $response = Http::timeout(30)->post(
                env('FLASK_PROXIMITY_API') . '/check_proximity',
                [
                    'warehouse' => [$warehouseLat, $warehouseLng],
                    'delivery' => [$latitude, $longitude],
                    'radius' => $radius
                ]
            );

            if ($response->successful()) {
                $data = $response->json();

                $log = Log::create([
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'radius' => $radius,
                    'distance' => $data['distance'] ?? 0,
                    'within_range' => $data['within_range'] ?? false,
                ]);

                return view('dashboard.alerts', [
                    'proximityCheck' => $log,
                    'warehouseLat' => $warehouseLat,
                    'warehouseLng' => $warehouseLng,
                    'deliveryLat' => $latitude,
                    'deliveryLng' => $longitude,
                    'radius' => $radius
                ]);
            } else {
                return $this->fallbackLocalCalculation($latitude, $longitude, $radius, $warehouseLat, $warehouseLng);
            }
        } catch (\Exception $e) {
            return $this->fallbackLocalCalculation($latitude, $longitude, $radius, $warehouseLat, $warehouseLng);
        }
    }

    private function fallbackLocalCalculation($latitude, $longitude, $radius, $warehouseLat, $warehouseLng)
    {
        $earthRadius = 6371000; // meters

        $dLat = deg2rad($latitude - $warehouseLat);
        $dLng = deg2rad($longitude - $warehouseLng);

        $a = sin($dLat / 2) ** 2 +
             cos(deg2rad($warehouseLat)) * cos(deg2rad($latitude)) *
             sin($dLng / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        $withinRange = $distance <= $radius;

        $log = Log::create([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'radius' => $radius,
            'distance' => round($distance, 2),
            'within_range' => $withinRange,
        ]);

        return view('dashboard.alerts', [
            'proximityCheck' => $log,
            'warehouseLat' => $warehouseLat,
            'warehouseLng' => $warehouseLng,
            'deliveryLat' => $latitude,
            'deliveryLng' => $longitude,
            'radius' => $radius
        ]);
    }

    public function showLogs()
    {
        $logs = Log::orderBy('created_at', 'desc')->paginate(20);

        return view('dashboard.logs', compact('logs'));
    }
}