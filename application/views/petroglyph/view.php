<?=$header?>
<p>Petroglyphs #<?=$petroglyph->id?></p>

    Name: <?=$petroglyph->name?><br>
    Lat: <?=$petroglyph->lat?><br>
    Lng: <?=$petroglyph->lng?><br>
    <?if (isset($img_src)):?>
    Image:<br>
    <img src="<?=$img_src?>" width="600">
    <?endif?>
    <br><br>
    <a href="admin/<?=$petroglyph->id?>">Edit</a><br>
    <a href="delete/<?=$petroglyph->id?>">Delete</a><br>
<?=$footer?>
