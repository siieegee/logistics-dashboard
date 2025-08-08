<div id="map" style="width: 100%; height: 100vh; min-height: 450px;"></div>

@push('scripts')
<script>
    // Convert Blade variables to numbers (fallback values if null)
    var warehouseLat = Number("{{ $warehouseLat ?? 14.5995 }}");
    var warehouseLng = Number("{{ $warehouseLng ?? 120.9842 }}");
    var deliveryLat = Number("{{ $deliveryLat ?? 0 }}");
    var deliveryLng = Number("{{ $deliveryLng ?? 0 }}");
    var radius = Number("{{ $radius ?? 500 }}"); // meters

    const map = L.map('map').setView([warehouseLat, warehouseLng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Define warehouse icon
    const warehouseIcon = L.icon({
        iconUrl: '{{ asset("images/warehouse.png") }}',
        iconSize:     [40, 40],
        iconAnchor:   [20, 40],
        popupAnchor:  [0, -40]
    });

    // Define delivery icon
    const deliveryIcon = L.icon({
        iconUrl: '{{ asset("images/delivery.png") }}',
        iconSize:     [40, 40],
        iconAnchor:   [20, 40],
        popupAnchor:  [0, -40]
    });

    // Add warehouse marker with custom icon
    L.marker([warehouseLat, warehouseLng], { icon: warehouseIcon })
        .addTo(map)
        .bindPopup('Warehouse Location')
        .openPopup();

    // Default circle color
    let circleColor = 'green';

    // Add delivery marker with custom icon if coordinates exist
    if (deliveryLat && deliveryLng) {
        L.marker([deliveryLat, deliveryLng], { icon: deliveryIcon })
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
