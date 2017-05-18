<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>We've got a message for you!</title>
    <!-- Custom styles for this template -->
    <link href="<?=URL::base()?>assets/css/style.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Petrogis</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?if ($menu=='home'):?>active<?endif?>"><a href="<?=URL::base()?>welcome">Home</a></li>
                <li class="<?if ($menu=='map'):?>active<?endif?>"><a href="<?=URL::base()?>map">Map</a></li>
                <li class="<?if ($menu=='petroglyph'):?>active<?endif?>"><a href="<?=URL::base()?>petroglyph">Petroglyphs</a></li>
                <li class="<?if ($menu=='contact'):?>active<?endif?>"><a href="#contact">Contact</a></li>
                <li class="<?if ($menu=='signup'):?>active<?endif?>"><a href="#signup">Sign up</a></li>
            </ul>
            <?if ($logged_in):?>
            <div class="collapse navbar-collapse navbar-right">
                <p class="navbar-text">
                    Hello, <?=$username?>!
                </p>
                <form class="navbar-form navbar-right" action="<?=URL::base()?>logout" method="post">
                    <button type="submit" class="btn btn-success">Sign out</button>
                </form>
            </div>
            <?else:?>
            <form class="navbar-form navbar-right" action="<?=URL::base()?>login" method="post">
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
            <?endif?>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

