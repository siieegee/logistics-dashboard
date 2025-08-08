<div class="mb-4">
    <div id="map" style="height: 450px;"></div>
</div>

@push('scripts')
<script>
    // Convert Blade variables to numbers (fallback values if null)
    var warehouseLat = Number("{{ $warehouseLat ?? 14.5995 }}");
    var warehouseLng = Number("{{ $warehouseLng ?? 120.9842 }}");
    var deliveryLat = Number("{{ $deliveryLat ?? 0 }}");
    var deliveryLng = Number("{{ $deliveryLng ?? 0 }}");
    var radius = Number("{{ $radius ?? 500 }}"); // meters


    const map = L.map('map').setView([warehouseLat, warehouseLng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Always show warehouse
    L.marker([warehouseLat, warehouseLng])
        .addTo(map)
        .bindPopup('Warehouse Location')
        .openPopup();

    // Default circle color
    let circleColor = 'green';

    // If delivery coordinates exist
    if (deliveryLat && deliveryLng) {
        // Add delivery marker
        L.marker([deliveryLat, deliveryLng])
            .addTo(map)
            .bindPopup('Delivery Location');

        // Check distance
        const distance = map.distance(
            [warehouseLat, warehouseLng],
            [deliveryLat, deliveryLng]
        );

        if (distance > radius) {
            circleColor = 'red'; // Out of range
        }
    } else {
        // If no delivery location, zoom to fit just the circle
        const circleBounds = L.circle([warehouseLat, warehouseLng], {
            radius: radius
        }).getBounds();
        map.fitBounds(circleBounds, { padding: [50, 50] });
    }

    // Draw circle with dynamic color
    L.circle([warehouseLat, warehouseLng], {
        color: circleColor,
        fillColor: circleColor,
        fillOpacity: 0.2,
        radius: radius
    }).addTo(map);
</script>
@endpush
