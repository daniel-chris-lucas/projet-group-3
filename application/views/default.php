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

    <style>
        .SystemTitle {
            font-size: 18px !important;
        }
    </style>
</head>
<body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please 
        <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">
        activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <?= $this->load->view( "layouts/main-banner" ) ?>

    <?php if( $this->session->flashdata( 'flash_error' ) ) : ?>
        <div class="alert alert-error">
            <?= $this->session->flashdata( 'flash_error' ) ?>
        </div>
    <?php elseif( $this->session->flashdata( 'flash_info' ) ) : ?>
        <div class="alert alert-info">
            <?= $this->session->flashdata( 'flash_info' ) ?>
        </div>
    <?php endif; ?>

    <!-- Start wrapper -->
    <div id="wrapper">
        <?= $this->load->view( 'layouts/filters' ) ?>

        <!-- Start main section -->
        <div id="main-section">
            <?= $this->load->view( 'layouts/main-nav' ) ?>

            <!-- Start main -->
            <div id="main" role="main" style="position: relative;" <?= $this->data['current_profile'] 
                    ? 'class="' . $this->data['current_profile'] . ' ' . $this->data['active'] . '"' 
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

    <div id="loading-bg">
        <img src="<?= base_url( 'assets/img/ajax-loader.gif' ) ?>" alt="Loading spinner">
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        window.jQuery || 
        document.write('<script src="<?= base_url( "assets/js/vendor/jquery-1.8.3.min.js" ) ?>"><\/script>')
    </script>

    <script src="<?= base_url( 'assets/js/vendor/bootstrap.min.js' ) ?>"></script>
    <script src="<?= base_url( 'assets/js/vendor/highcharts.js' ) ?>"></script>
    <script src="<?= base_url( 'assets/js/plugins.js' ) ?>"></script>
    <script src="<?= base_url( 'assets/js/main.js' ) ?>"></script>

    <script>
        ( function( $ ) {
            $( 'select.filter-dropkick' ).on( 'change', function() {
                updateFilters();
                
                // Fade in dark background and loader
                $( 'div#loading-bg' ).fadeIn( 'slow' );

                // Run ajax request
                $.ajax( {
                    type: 'POST',
                    url: '<?= site_url( "ajax" ) ?>',
                    data: {
                        ind:       $( 'select#indicateur' ).val(),
                        temps_t:   $( 'select#date' ).val(),
                        annee:     $( 'select#annee' ).val(),
                        _devise:   $( 'select#devise' ).val(),
                        _enseigne: $( 'select#enseigne' ).val(),
                        _region:   $( 'select#region' ).val(),
                        _cumul:    $( 'select#cumul' ).val(),
                        _produits: $( 'select#produits' ).val(),
                        _program:  '<?= isset( $program ) ? $program : null ?>',
                    },
                    timeout: 10000
                }).done( function( data ) {
                    removeLoader( data );
                    bootstrapTables();
                    colorCoding();
                    updateFiltersBar();
                    changeSASErrors();
                    addCharts();
                }).fail( function( jqXHR, textStatus, errorThrown ) {
                    $( 'div#loading-bg' ).fadeOut( 'slow' );
                    $( '#ajax-area' ).empty().html(
                        '<h2>Erreur</h2><h3>Veuillez contacter l\'administrateur pour résoudre ce problème</h3>'
                    );
                });
            });

            // deactivate invalid filters
            $.each( <?= json_encode( $active_filters ) ?>, function( key, value ) {
                $( 'select#' + value ).removeAttr( 'disabled' );
            });

            // load default information for the page
            var launchAjax = false;
            $.each( <?= json_encode( $default_filters ) ?>, function( key, value ) {
                if( value != 'null' ) launchAjax = true;
                $( 'select#' + key ).val( value );
            });
            if( launchAjax ) $( 'select#indicateur' ).trigger( 'change' );


            // Update chosen filters list
            function updateFilters() {
                $( '#chosen-filters' ).empty();
                var filtersArr = {};
                var filtersStr = '';
                filtersArr["indicateur"] = $( '#indicateur' ).val();
                var selected = $( '#date' ).find( 'option:selected' );
                filtersArr["date"] = selected.data( 'display' ) != null ? selected.data( 'display' ) : "null";
                filtersArr["annee"] = $( '#annee' ).val() != null ? $( '#annee' ).val() : "null";
                filtersArr["devise"] = $( '#devise' ).val();
                filtersArr["enseigne"] = $( '#enseigne' ).val();
                filtersArr["region"] = $( '#region' ).val();
                filtersArr["cumul"] = $( '#cumul' ).val();
                var selected = $( '#produits' ).find( 'option:selected' );
                filtersArr["produits"] = selected.data( 'display' ) != null ? selected.data( 'display' ) : "null";

                $.each( filtersArr, function( key, value) {
                    if( value != "null" ) filtersStr += value + ' / ';
                });
                filtersStr = filtersStr.slice( 0, -2 );
                $( 'p#chosen-filters' ).empty().html( filtersStr );
            }

            // Update height of filters bar
            function updateFiltersBar() {
                $( 'nav#filters-nav' ).height( $( 'div#main' ).height() + parseInt( $( 'div#main' ).css( 'padding-bottom' ) ) +1 );
            }

            
            // Modify tables to add bootstrap classes
            function bootstrapTables() {
                $( 'table.Table' ).addClass( 'table table-bordered table-hover' ).removeClass( 'Table' );
                $( '#ajax-area hr' ).remove();
                $( '#ajax-area table tbody tr:last-child' ).addClass( 'blue-bg' );
            }

            
            function removeLoader( data ) {
                $( 'div#loading-bg' ).fadeOut( 'slow' );
                $( '#ajax-area' ).empty().html( data );
            }


            // add red and green to percentages in commercial home page
            function colorCoding() {
                $.each( $( '.commercial.accueil #ajax-area table tbody tr td:last-child' ), function( key, value ) {
                    var val = $( value ).html();
                    var res = $.trim( parseFloat( val.slice( 0, -1 ) ) );
                    res > 0 ? $( value ).addClass( 'positive' ) : $( value ).addClass( 'negative' );
                });
            }


            // Change stored process error messages
            function changeSASErrors() {
                $( '#ajax-area' ).children( 'h1' ).empty().html( 'Aucun resultat n\'a été trouvé pour cette requête' );
                $( '#ajax-area' ).children( 'h3' ).empty().html( 'Veuillez changer les filtres pour modifier la requête' );
            }


            // Get values from tables for charts
            function getValues() {
                // remove useless headings
                $( '.SysTitleAndFooterContainer' ).remove();
                $( '.commercial.analyse #ajax-area .branch:nth-child( 1 ) table' )
                        .addClass( 'highchart-table' );
                $( '.commercial.analyse #ajax-area .branch:nth-child( 2 ) table' )
                        .addClass( 'highchart-table' );

                $.each( $( '.highchart-table' ), function( key, value ) {
                    console.log( this );
                    //console.log( )
                });
                //console.log( $( '.highchart-table thead tr:last-child th' ).html() );
            }


            // add Highcharts graphs
            function addCharts() {
                getValues();
            }
        })( jQuery );
    </script>
</body>
</html>