<?=$header?>
    <h1>petro</h1>
    <p>We just wanted to say it! :)</p>
    <?foreach ($petroglyphs as $petroglyph):?>
        <?=$petroglyph->name?><br>
    <?endforeach?>
<?=$footer?>

