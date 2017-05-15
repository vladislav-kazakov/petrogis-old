<?=$header?>

<div id="map_canvas" style="width:800px; height:600px"></div>
<script type="text/javascript" src = "assets/js/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeYhPhJAnwj95GXDg5BRT7Q2dTj303dQU&callback=initMap"
        type="text/javascript"></script>
<script type="text/javascript">
    var arr = [
        <?foreach ($petroglyphs as $petroglyph):?>
        ["<?=$petroglyph->name?>", <?=$petroglyph->lat?>, <?=$petroglyph->lng?>],
        <?endforeach?>
    ];

    for (var i =0; i<arr.length; i++)
    {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(arr[i][1], arr[i][2]),
            map: map,
            title: arr[i][0]
        });
    }
</script>

<?=$footer?>

