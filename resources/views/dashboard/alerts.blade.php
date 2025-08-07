@if ($proximityCheck->within_range)
    <p style="color: green;"> Delivery is within {{ $proximityCheck->distance }} meters!</p>
@else
    <p style="color: red;"> Delivery is {{ $proximityCheck->distance }} meters away.</p>
@endif