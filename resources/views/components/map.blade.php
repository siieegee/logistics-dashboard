<div id="map" style="width: 100%; height: 100%; min-height: 450px; "></div>

@push('scripts')
<script>
    const map = L.map('map').setView([14.5995, 120.9842], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Static warehouse pin
    const warehouseMarker = L.marker([14.5995, 120.9842]).addTo(map)
        .bindPopup('Warehouse Location')
        .openPopup();

    let deliveryMarker;

    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        if (deliveryMarker) {
            deliveryMarker.setLatLng(e.latlng);
        } else {
            deliveryMarker = L.marker(e.latlng).addTo(map)
                .bindPopup("Delivery Location")
                .openPopup();
        }
    });
</script>
@endpush
