<div class="mb-4">
    <h2 class="text-lg font-semibold mb-2 text-white">Select location on map:</h2>
    
    <div id="map" style="height: 400px;"></div>

    <!-- Hidden inputs for latitude and longitude -->
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
</div>

@push('scripts')
<script>
    const map = L.map('map').setView([14.5995, 120.9842], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    let marker;

    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });
</script>
@endpush
