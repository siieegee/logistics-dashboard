@extends('layouts.app')

@section('content')

@include('components.hero')

{{-- MAIN CONTENT SECTION --}}
<div id="check" class="bg-gradient-to-b from-[#264653] to-[#1e3a44] py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-start">

            {{-- FORM SECTION --}}
            <div class="order-2 lg:order-1">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 shadow-2xl border border-white/20">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-[#6a994e] rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-white text-2xl md:text-3xl font-bold">Check Delivery Proximity</h2>
                        <p class="text-gray-200 mt-2">Enter coordinates to verify delivery location</p>
                    </div>

                    @isset($proximityCheck)
                        <div class="mb-6 p-4 rounded-lg border-l-4 {{ $proximityCheck->within_range ? 'bg-green-500/20 border-green-400 text-green-100' : 'bg-red-500/20 border-red-400 text-red-100' }}">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    @if ($proximityCheck->within_range)
                                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <p class="font-semibold">
                                        @if ($proximityCheck->within_range)
                                            Delivery is within range!
                                        @else
                                            Delivery is outside the set radius
                                        @endif
                                    </p>
                                    <p class="text-sm mt-1">Distance: {{ number_format($proximityCheck->distance, 1) }} meters</p>
                                </div>
                            </div>
                        </div>
                    @endisset

                    <form method="POST" action="{{ route('check.proximity') }}" class="space-y-6">
                        @csrf
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-white font-semibold text-sm" for="latitude">
                                    Delivery Latitude
                                </label>
                                <input type="text" id="latitude" name="latitude"
                                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/30 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#6a994e] focus:border-transparent transition duration-200"
                                    placeholder="e.g., 14.5995">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-white font-semibold text-sm" for="longitude">
                                    Longitude
                                </label>
                                <input type="text" id="longitude" name="longitude"
                                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/30 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#6a994e] focus:border-transparent transition duration-200"
                                    placeholder="e.g., 121.0437">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-white font-semibold text-sm" for="radius">
                                Alert Radius
                            </label>
                            <div class="relative">
                                <select id="radius" name="radius"
                                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/30 text-white 
                                            focus:outline-none focus:ring-2 focus:ring-[#6a994e] focus:border-transparent 
                                            transition duration-200
                                            appearance-none
                                            [&>option]:bg-[#264653] [&>option]:text-white
                                            ">
                                    <option value="100">100 meters</option>
                                    <option value="250" selected>250 meters</option>
                                    <option value="500">500 meters</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" 
                                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M6 9l6 6 6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full bg-gradient-to-r from-[#6a994e] to-[#588c43] hover:from-[#588c43] hover:to-[#4a7c39] text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-white/50 shadow-lg">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Check Proximity
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- MAP SECTION --}}
            <div class="order-1 lg:order-2">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 shadow-2xl border border-white/20">
                    <div class="mb-4">
                        <h3 class="text-white text-xl font-semibold mb-2">Interactive Map</h3>
                        <p class="text-gray-200 text-sm">Click on the map to select coordinates</p>
                    </div>
                    <div class="rounded-lg overflow-hidden shadow-lg">
                        @include('components.map')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- INSTRUCTIONS SECTION --}}
@include('components.instructions')

@endsection
