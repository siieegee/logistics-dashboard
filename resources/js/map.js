// static-map.js
document.addEventListener("DOMContentLoaded", function () {
    const { warehouse, delivery, radius, withinRange } = window.mapData;

    const map = L.map('map', { zoomControl: false }).setView(delivery, 15);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
    }).addTo(map);

    L.control.zoom({ position: 'topright' }).addTo(map);

    // Alert Radius
    L.circle(warehouse, {
        color: '#fa893e',
        fillColor: '#fa893e',
        fillOpacity: 0.2,
        radius: radius
    }).addTo(map).bindPopup(`Alert Radius: ${radius}m`);

    // Warehouse Icon
    const houseSVG = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="fill:#cd5e14; stroke:white; stroke-width:12; stroke-linejoin:round;"><path d="M216.71,92.44,136,36.1a16.1,16.1,0,0,0-16,0L40.05,91.68A16,16,0,0,0,32,104.75V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V104.2A16,16,0,0,0,216.71,92.44Z"></path></svg>`;
    const warehouseIcon = L.divIcon({
        html: houseSVG,
        className: 'warehouse-icon-frameless',
        iconSize: [36, 36],
        iconAnchor: [18, 36],
        popupAnchor: [0, -36]
    });
    L.marker(warehouse, { icon: warehouseIcon }).addTo(map).bindPopup('<b>Warehouse</b>');

    // Delivery Marker
    const deliveryMarkerClass = withinRange ? 'marker-delivery-success' : 'marker-delivery-danger';
    const deliveryIcon = L.divIcon({
        className: `custom-marker ${deliveryMarkerClass}`,
        iconSize: [16, 16]
    });
    L.marker(delivery, { icon: deliveryIcon }).addTo(map).bindPopup('<b>Delivery Location</b>');
});
