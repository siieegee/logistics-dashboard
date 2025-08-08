<div class="bg-gradient-to-b from-[#1e3a44] to-[#264653] py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">How It Works</h2>
            <div class="w-24 h-1 bg-[#6a994e] rounded-full mx-auto"></div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Step 1 --}}
            <div class="text-center">
                <div class="w-16 h-16 bg-[#6a994e] rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-xl">1</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Enter Coordinates</h3>
                <p class="text-gray-300 text-sm">Input the delivery location's latitude and longitude, or click on the interactive map</p>
            </div>

            {{-- Step 2 --}}
            <div class="text-center">
                <div class="w-16 h-16 bg-[#6a994e] rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-xl">2</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Set Alert Radius</h3>
                <p class="text-gray-300 text-sm">Choose your preferred proximity range from 100m to 1km based on delivery requirements</p>
            </div>

            {{-- Step 3 --}}
            <div class="text-center">
                <div class="w-16 h-16 bg-[#6a994e] rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-xl">3</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Check Proximity</h3>
                <p class="text-gray-300 text-sm">Click the button to calculate the distance and verify if delivery is within range</p>
            </div>

            {{-- Step 4 --}}
            <div class="text-center">
                <div class="w-16 h-16 bg-[#6a994e] rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-xl">4</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Get Results</h3>
                <p class="text-gray-300 text-sm">Receive instant feedback with color-coded alerts and precise distance measurements</p>
            </div>
        </div>

        {{-- Additional Info --}}
        <div class="mt-16 bg-white/5 rounded-2xl p-8 backdrop-blur-sm border border-white/10">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h3 class="text-white font-bold text-xl mb-4">Smart Proximity Detection</h3>
                    <ul class="space-y-3 text-gray-200">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#6a994e] mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Real-time distance calculations using GPS coordinates
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#6a994e] mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Customizable alert radius for different delivery scenarios
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#6a994e] mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Instant visual feedback with color-coded status indicators
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[#6a994e] mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Interactive map integration for easy coordinate selection
                        </li>
                    </ul>
                </div>
                <div class="text-center">
                    <div class="inline-block p-8 bg-gradient-to-br from-[#6a994e]/20 to-[#588c43]/20 rounded-2xl">
                        <svg class="w-24 h-24 text-[#6a994e] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <p class="text-white font-semibold mt-4">Precision Logistics</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
