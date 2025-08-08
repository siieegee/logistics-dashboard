@extends('layouts.app')

@section('content')

{{-- HERO TEXT ABOVE FORM --}}
<div class="bg-[#264653] py-12 px-4 text-center">
    <h1 class="text-2xl md:text-4xl font-extrabold text-white leading-tight mb-4">
        AI-Powered <span style="color: #6a994e;">Proximity Alerts</span> for Warehouse Deliveries
    </h1>
    <p class="text-sm md:text-base text-gray-200 mb-6 max-w-2xl mx-auto">
        Ensure timely and accurate drop-offs with our smart logistics proximity detection system.
    </p>
</div>

{{-- FORM + MAP SECTION --}}
<div id="check" class="bg-[#264653] pb-12">
    <div class="flex flex-col md:flex-row justify-center items-stretch w-full">
        {{-- Removed gap-8 here --}}

        {{-- FORM --}}
        <form method="POST" action="{{ route('check.proximity') }}"
            class="bg-[#3a5a40] p-6 md:p-8 shadow-lg w-full max-w-sm mx-0">
            @csrf
            <h2 class="text-white text-2xl font-bold mb-6 text-center">Check Delivery Proximity</h2>

            {{-- Show result alert if available --}}
            @isset($proximityCheck)
                @if ($proximityCheck->within_range)
                    <p class="text-green-400 font-semibold mb-4">
                        ✅ Delivery is within {{ $proximityCheck->distance }} meters!
                    </p>
                @else
                    <p class="text-red-400 font-semibold mb-4">
                        ⚠️ Delivery is {{ $proximityCheck->distance }} meters away.
                    </p>
                @endif
            @endisset

            <div class="mb-4">
                <label class="block text-white font-semibold mb-1" for="latitude">Delivery Latitude:</label>
                <input type="text" id="latitude" name="latitude"
                    class="w-full px-4 py-2 rounded-md border border-[#588157] bg-[#588157] text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-white">
            </div>

            <div class="mb-4">
                <label class="block text-white font-semibold mb-1" for="longitude">Longitude:</label>
                <input type="text" id="longitude" name="longitude"
                    class="w-full px-4 py-2 rounded-md border border-[#588157] bg-[#588157] text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-white">
            </div>

            <div class="mb-6">
                <label class="block text-white font-semibold mb-1" for="radius">Alert Radius (m):</label>
                <select id="radius" name="radius"
                        class="w-full px-4 py-2 rounded-md border border-[#588157] bg-[#588157] text-white focus:outline-none focus:ring-2 focus:ring-white">
                    <option value="100">100m</option>
                    <option value="250" selected>250m</option>
                    <option value="500">500m</option>
                </select>
            </div>

            <div class="flex justify-center">
                <button type="submit"
                        class="bg-[#6a994e] hover:bg-[#588c43] text-white font-semibold px-6 py-2 rounded-md transition duration-300">
                    Check Proximity
                </button>
            </div>
        </form>

        {{-- MAP --}}
        <div class="w-full md:w-1/2 md:pr-0 md:pl-0 flex-grow">
            @include('components.map')
        </div>
    </div>
</div>

{{-- INSTRUCTIONS --}}
<div class="bg-[#264653] flex items-center justify-center py-5 px-4 mb-10 min-h-[300px]">
    <div class="bg-[#264653] rounded-lg max-w-4xl mx-auto p-6 text-left text-white">
        <h2 class="text-xl font-bold mb-4">How to Use</h2>
        <ol class="list-decimal list-inside text-sm md:text-base space-y-2">
            <li>Enter the delivery location's <strong>latitude</strong> and <strong>longitude</strong> in the fields provided or choose a location on the map.</li>
            <li>Select your preferred <strong>alert radius</strong> (in meters).</li>
            <li>Click <strong>Check Proximity</strong> to see if the delivery is within the set range.</li>
            <li>The result will be shown with:
            <ul class="list-disc list-inside ml-6 mt-1">
            <li class="text-green-400">Green if within range ✅</li>
            <li class="text-red-400">Red if outside range ⚠️</li>
            </ul>
            </li>
        </ol>
    </div>
</div>

@endsection
