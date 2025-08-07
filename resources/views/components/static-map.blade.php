<div id="map" class="w-full h-64 rounded mb-6"></div>

@push('scripts')
    <script>
        const warehouseLat = @json($warehouseLat);
        const warehouseLng = @json($warehouseLng);
        const deliveryLat = @json($deliveryLat);
        const deliveryLng = @json($deliveryLng);
        const radius = @json($radius);

        const map = L.map('map', {
            center: [warehouseLat, warehouseLng],
            zoom: 15,
            zoomControl: false,
            dragging: false,
            scrollWheelZoom: false,
            doubleClickZoom: false,
            boxZoom: false,
            keyboard: false,
            tap: false,
            touchZoom: false
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.circle([warehouseLat, warehouseLng], {
            color: '#264653',
            fillColor: '#2a9d8f',
            fillOpacity: 0.2,
            radius: radius
        }).addTo(map);

        L.marker([warehouseLat, warehouseLng]).addTo(map)
            .bindPopup('Warehouse').openPopup();

        L.marker([deliveryLat, deliveryLng]).addTo(map)
            .bindPopup('Delivery');
    </script>
@endpush
