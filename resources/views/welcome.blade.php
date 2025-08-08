@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row items-stretch bg-[#264653] p-6 md:p-12 min-h-[600px]">
    <!-- Left Content -->
    <div class="md:w-1/2 flex flex-col justify-center items-center text-center md:items-start md:text-left px-4 md:px-8 ml-10">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-6">
            AI-Powered <span style="color: #6a994e;"><br>
            Proximity Alerts</span><br>
            for Warehouse Deliveries
        </h1>
        <p class="text-lg md:text-xl text-gray-200 mb-6">
            Ensure timely and accurate drop-offs with our smart logistics proximity detection system.
        </p>
        <div class="flex justify-center w-full md:justify-start">
            <a href="{{ route('proximity.form') }}"
               class="inline-block text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300"
               style="background-color: #6a994e;">
                Check Proximity
            </a>
        </div>
    </div>

    <!-- Right Icon -->
    <div class="md:w-1/2 flex items-center justify-center mt-8 md:mt-0">
        <img src="https://cdn-icons-png.flaticon.com/512/6756/6756142.png"
             alt="Warehouse Delivery Icon"
             class="w-full max-w-[300px] md:max-w-[400px]">
    </div>
</div>
@endsection
