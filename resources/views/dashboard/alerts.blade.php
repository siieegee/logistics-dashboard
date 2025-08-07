@extends('layouts.app')

@section('content')
    <div class="bg-[#264653] min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-xl w-full bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-bold text-center text-[#264653] mb-6">Proximity Check Result</h2>

            @if ($proximityCheck->within_range)
                <div class="bg-green-100 text-green-800 px-4 py-6 rounded relative mb-6 text-center">
                    <p class="font-bold text-2xl text-green-700 mb-2">Within Range</p>
                    <p class="text-gray-700 text-base">Delivery is within <strong>{{ $proximityCheck->distance }}</strong> meters.</p>
                </div>
            @else
                <div class="bg-red-100 text-red-800 px-4 py-6 rounded relative mb-6 text-center">
                    <p class="font-bold text-2xl text-red-700 mb-2">Out of Range</p>
                    <p class="text-gray-700 text-base">Delivery is <strong>{{ $proximityCheck->distance }}</strong> meters away from the allowed radius.</p>
                </div>
            @endif

            <div class="text-center">
                <a href="{{ route('proximity.form') }}"
                   class="inline-block bg-[#6a994e] hover:bg-[#588c43] text-white font-semibold px-6 py-2 rounded-md transition duration-300">
                    Check Another Location
                </a>
            </div>
        </div>
    </div>
@endsection
