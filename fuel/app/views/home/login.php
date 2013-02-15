<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="<?= Config::get( "encoding" ) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Ubuntu">

    <?= Asset::css( "style.css" ) ?>

    <?= Asset::js( "vendor/modernizr-2.6.2-respond-1.1.0.min.js" ) ?>

    <style>
        #wrapper {
            width: 1425px;
            margin: auto;
        }

            #wrapper>img { float: left; }

        #form-wrapper {
            background: #eff3f6;
            float: left;
            padding: 10px;
            height: 260px;
            position: relative;
            margin-top: 120px;

            -webkit-border-radius: 7px;
            -moz-border-radius: 7px;
            -ms-border-radius: 7px;
            -o-border-radius: 7px;
            border-radius: 7px;
        }

            #form-wrapper label { cursor: pointer; }

                #form-wrapper label a { color: #a6aac9; }

        form {
            background: #fefefe;
            padding: 40px;

            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -ms-border-radius: 5px;
            -o-border-radius: 5px;
            border-radius: 5px;

            -webkit-box-shadow: 0px 0px 5px rgba(0, 0, 0, .4);
            -moz-box-shadow: 0px 0px 5px rgba(0, 0, 0, .4);
            box-shadow: 0px 0px 5px rgba(0, 0, 0, .4);
        }

        input[type="text"], input[type="password"] { width: 100%; }

        input[type="checkbox"] { float: left; margin-right: 10px; }

        button { float: right; position: relative; top: -30px; right: -14px; }
    </style>
</head>
<body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please 
        <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">
        activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <?= View::forge( "layouts/main-banner" ) ?>

    <!-- Start wrapper -->
    <div id="wrapper">
        <?= Asset::img( "login/login-img.png", array( "alt" => "Connectez Vous a l'Application Darties",
                "width" => 891, "height" => 603
            )) ?>

        <div id="form-wrapper">
            <?= Form::open() ?>
                <p>
                    <label for="identifiant">Identifiant</label>
                    <input type="text" name="identifiant" id="identifiant" placeholder="Identifiant" tabindex="1"> 
                </p>
                <p>
                    <label for="mdp">
                        Mot de passe 
                        <a href="#" tabindex="4">Vous avez oublié votre mot de passe ?</a>
                    </label>
                    <input type="password" name="mdp" id="mdp" placeholder="Mot de Passe" tabindex="2">
                </p>
                <p>
                    <input type="checkbox" name="souvenir" id="souvenir" tabindex="3">
                    <label for="souvenir">Se souvenir de moi</label>
                    <button type="submit" class="btn btn-primary">Login</button>
                </p>
            </form>
        </div>
    </div>
    <!-- End wrapper -->

    <?= Asset::js( "//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" ) ?>
    <script>
    	window.jQuery || 
    	document.write('<script src="<?= Asset::find_file( "jquery-1.8.3.min.js", "js", "vendor/" ) ?>"><\/script>')
    </script>

    <?= Asset::js( "vendor/bootstrap.min.js" ) ?>
    <?= Asset::js( "jquery.dropkick-1.0.0.js" ) ?>
    <?= Asset::js( "plugins.js" ) ?>
    <?= Asset::js( "main.js" ) ?>
</body>
</html>