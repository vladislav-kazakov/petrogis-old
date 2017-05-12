function initMap() {
    map = new google.maps.Map(document.getElementById('map_canvas'), {
        center: new google.maps.LatLng(50.2, 87.5),
        zoom: 8
    });
}