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
    <?= Asset::css( "dk_theme_darties.css" ) ?>

    <?= Asset::js( "vendor/modernizr-2.6.2-respond-1.1.0.min.js" ) ?>
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
        <?= View::forge( "layouts/filters" ) ?>

        <!-- Start main section -->
        <div id="main-section">
            <?= View::forge( "layouts/main-nav" ) ?>

            <!-- Start main -->
            <div id="main" role="main" <?= Session::get( "profile" ) ? 'class="' . Session::get( "profile" ) . '"' : '' ?>>
                <?= $content ?>
            </div>
            <!-- End main -->

            <footer>
                <p>
                	<?= Asset::img( "logo-krystal-conseil.png", array( "alt" => "Krystal Conseil", "width" => 36, "height" => 28 ) ) ?>
                	Réalisation par Krystal Conseil
                </p>
            </footer>
        </div>
        <!-- End main section -->
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