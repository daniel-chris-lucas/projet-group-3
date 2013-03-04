<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="<?= $this->config->item( 'charset' ) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Ubuntu">
    <link rel="stylesheet" href="<?= base_url( 'assets/css/style.css' ); ?>">
    <link rel="stylesheet" href="<?= base_url( 'assets/css/dk_theme_darties.css' ); ?>">

    <script src="<?= base_url( 'assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js' ) ?>"></script>
</head>
<body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please 
        <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">
        activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <?= $this->load->view( "layouts/main-banner" ) ?>

    <!-- Start wrapper -->
    <div id="wrapper">
        <?= $this->load->view( 'layouts/filters' ) ?>

        <!-- Start main section -->
        <div id="main-section">
            <?= $this->load->view( 'layouts/main-nav' ) ?>

            <!-- Start main -->
            <div id="main" role="main" <?= $this->session->userdata( 'profile' ) 
                    ? 'class="' . $this->session->userdata( 'profile' ) . '"' 
                    : '' ?>>
                <?= $body ?>
            </div>
            <!-- End main -->

            <footer>
                <p>
                    <img src="<?= base_url( 'assets/img/logo-krystal-conseil.png' ) ?>" alt="Krystal Conseil" width="36" height="28">
                    Réalisation par Krystal Conseil
                </p>
            </footer>
        </div>
        <!-- End main section -->
    </div>
    <!-- End wrapper -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        window.jQuery || 
        document.write('<script src="<?= base_url() ?>assets/js/vendor/jquery-1.8.3.min.js"><\/script>')
    </script>

    <script src="<?= base_url( 'assets/js/vendor/bootstrap.min.js' ) ?>"></script>
    <!-- <script src="<?= base_url( 'assets/js/jquery.dropkick-1.0.0.js' ) ?>"></script> -->
    <script src="<?= base_url( 'assets/js/plugins.js' ) ?>"></script>
    <script src="<?= base_url( 'assets/js/main.js' ) ?>"></script>

    <script>
        ( function( $ ) {
            var url = "url=http://saskatchewan.univ-ubs.fr:8080/SASStoredProcess/do?_username=DARTIES3-2012&_password=P@ssw0rd&_program=%2FUtilisateurs%2FDARTIES3-2012%2FMon+dossier%2Fanalyse_dc&annee=2012&ind=V&_action=execute";

            $( 'select.filter-dropkick' ).on( 'change', function() {
                $.ajax( {
                    type: 'POST',
                    url: '<?= site_url( "ajax" ) ?>',
                    data: url,
                }).done( function( data ) {
                    $( '#main' ).empty().html( data );
                }).fail( function( jqXHR, textStatus, errorThrown ) {
                    console.log( 'Error: ' + jqXHR );
                    $( '#main' ).empty().html(
                        '<h2>Erreur</h2><p>Veuillez contacter l\'administrateur pour résoudre ce problème</p>'
                    );
                });
            });
        })( jQuery );
    </script>
</body>
</html>