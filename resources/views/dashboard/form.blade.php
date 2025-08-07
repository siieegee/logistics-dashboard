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
<div id="check" class="bg-[#264653] pb-12 px-4">
    <div class="flex flex-col md:flex-row gap-8 justify-center items-start">
        {{-- FORM --}}
        <form method="POST" action="{{ route('check.proximity') }}"
              class="bg-[#3a5a40] p-6 md:p-8 rounded-lg shadow-lg w-full max-w-md">
            @csrf
            <h2 class="text-white text-2xl font-bold mb-6 text-center">Check Delivery Proximity</h2>

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
        <div class="w-full md:w-1/2">
            @include('components.map')
        </div>
    </div>
</div>


@endsection
