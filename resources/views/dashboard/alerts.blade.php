@extends('layouts.app')

@section('content')

{{-- MAIN CONTENT SECTION --}}
<div id="check" class="bg-gradient-to-br from-[#264653] to-[#2a9d8f] min-h-screen">
    <div class="container mx-auto px-4 py-8">
        
        {{-- RESULTS SECTION --}}
        <div class="bg-white rounded-lg shadow-xl mb-8 overflow-hidden">
            <div class="bg-gradient-to-r from-[#3a5a40] to-[#52796f] p-6 md:p-8">
                <div class="text-center">
                    <h2 class="text-white text-3xl md:text-4xl font-bold mb-2">Proximity Check Result</h2>
                    <p class="text-green-100 text-lg">Delivery Location Analysis</p>
                </div>
            </div>

            <div class="p-6 md:p-8">
                @if (isset($proximityCheck))
                    @if ($proximityCheck->within_range)
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-green-700 mb-3">Within Range!</h3>
                            <p class="text-gray-600 text-lg mb-4">
                                Your delivery location is successfully within our service area.
                            </p>
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 inline-block">
                                <p class="text-green-800">
                                    Distance: <span class="font-bold">{{ $proximityCheck->distance }}m</span> from center
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-red-100 rounded-full mb-4">
                                <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-red-700 mb-3">Out of Range</h3>
                            <p class="text-gray-600 text-lg mb-4">
                                Unfortunately, your delivery location is outside our current service area.
                            </p>
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 inline-block">
                                <p class="text-red-800 mb-2">
                                    Distance: <span class="font-bold">{{ $proximityCheck->distance }}m</span> from center
                                </p>
                                <p class="text-red-700 text-sm">
                                    Service radius: <span class="font-bold">{{ $radius }}m</span>
                                </p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-center py-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-3">Ready for Check</h3>
                        <p class="text-gray-500 text-lg">Please enter a delivery location to see the proximity results.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- MAP SECTION --}}
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Service Area Map</h3>
                <p class="text-gray-600 text-sm">Interactive map showing delivery zones and your location</p>
            </div>
            <div class="h-[500px] md:h-[600px] relative">
                @include('components.static-map')
            </div>
        </div>
    </div>
</div>

@endsection