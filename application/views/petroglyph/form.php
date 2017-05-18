<?=$header?>
<h1>petro form</h1>
<form enctype="multipart/form-data" method="post">
    Name: <input type="text" name="name" value="<?=$petroglyph['name']?>"><br>
    Lat: <input type="text" name="lat" value="<?=$petroglyph['lat']?>"><br>
    Lng: <input type="text" name="lng" value="<?=$petroglyph['lng']?>"><br>
    Image: <input type="file" name="image"><br>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<?=$footer?>
