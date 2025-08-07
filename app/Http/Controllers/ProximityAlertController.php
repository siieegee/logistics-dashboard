<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProximityAlertController extends Controller
{
    public function checkProximity(Request $request)
    {
        // Validate input
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'nullable|numeric',
        ]);

        // Get input values
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = $request->radius ?? 250;

        // Call Flask API
        $response = Http::post('https://your-flask-api-url/check_proximity', [
            'warehouse' => [14.5995, 120.9842],
            'delivery' => [$latitude, $longitude],
            'radius' => $radius
        ]);

        // Get response JSON
        $data = $response->json();

        // Save to database
        Log::create([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'radius' => $radius,
            'distance' => $data['distance'] ?? null,
            'within_range' => $data['within_range'] ?? null,
        ]);

        return view('dashboard.alerts', ['data' => $data]);
    }
}
