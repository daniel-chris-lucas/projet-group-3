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
    <!--[if lt IE 8]>
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
    <script src="<?= base_url( 'assets/js/vendor/exporting.js' ) ?>"></script>
    <script src="<?= base_url( 'assets/js/vendor/FusionCharts.js' ) ?>"></script>
    <script src="<?= base_url( 'assets/js/vendor/lib.js' ) ?>"></script>
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
                        enseigne: $( 'select#enseigne' ).val(),
                        region:   $( 'select#region' ).val(),
                        _cumul:    $( 'select#cumul' ).val(),
                        fam: $( 'select#produits' ).val(),
                        _program:  '<?= isset( $program ) ? $program : null ?>',
                        <?php if( $this->uri->segment(2) == 'palmares' ) : ?>
                            filtre_geo: $( 'select#filtre-geo' ).val(),
                        <?php endif; ?>
                    },
                    timeout: 10000
                }).done( function( data ) {
                    removeLoader( data );
                    bootstrapTables();
                    colorCoding();
                    changeSASErrors();
                    addCharts();
                    scrollingTables();
                    updateFiltersBar();
                    createGauges( "<?= $this->data['current_profile'] ?>", "<?= $this->data['active'] ?>" );
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


            // launch ajax for palmares geo filter
            $( 'select#filtre-geo' ).on( 'change', function() {
                $( 'select#indicateur' ).trigger( 'change' );
            });


            // Update chosen filters list
            function updateFilters() {
                $( '#chosen-filters' ).empty();
                var filtersArr = {};
                var filtersStr = '';
                var selected = $( '#indicateur' ).find( 'option:selected' );
                filtersArr["indicateur"] = selected.data( 'display' ) != null ? selected.data( 'display' ) : "null";
                var selected = $( '#date' ).find( 'option:selected' );
                filtersArr["date"] = selected.data( 'display' ) != null ? selected.data( 'display' ) : "null";
                filtersArr["annee"] = $( '#annee' ).val() != null ? $( '#annee' ).val() : "null";
                filtersArr["devise"] = $( '#devise' ).val();
                filtersArr["enseigne"] = $( '#enseigne' ).val();
                var selected = $( '#region' ).find( 'option:selected' );
                filtersArr["region"] = selected.data( 'display' ) != null ? selected.data( 'display' ) : "null";
                filtersArr["cumul"] = $( '#cumul' ).val();
                var selected = $( '#produits' ).find( 'option:selected' );
                filtersArr["produits"] = selected.data( 'display' ) != null ? selected.data( 'display' ) : "null";
                <?php if( $this->uri->segment(2) == 'palmares' ) : ?>
                    var selected = $( '#filtre-geo' ).find( 'option:selected' );
                    filtersArr["geo"] =  'Palmarès par ' + selected.data( 'display' ),
                <?php endif; ?>

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
                // commercial home page
                $.each( $( '.commercial.accueil #ajax-area table tbody tr td:last-child' ), function( key, value ) {
                    var val = $( value ).html();
                    var res = $.trim( parseFloat( val.slice( 0, -1 ) ) );
                    if( res > 0 )
                        $( value ).addClass( 'positive' );
                    else if( res < 0 )
                        $( value ).addClass( 'negative' );
                });

                // analyse page
                $.each( $( '.commercial.analyse #ajax-area table tbody tr td:nth-child(3n+1)' ), function( key, value ) {
                    var val = $( value ).html();
                    var res = $.trim( parseFloat( val.slice( 0, -1 ) ) );
                    if( res > 0 )
                        $( value ).addClass( 'positive' );
                    else if( res < 0 )
                        $( value ).addClass( 'negative' );
                });

                // palmares
                $.each( $( '.commercial.palmares #ajax-area table tbody tr td:last-child' ), function( key, value ) {
                    var val = $( value ).html();
                    var res = $.trim( parseFloat( val ) );
                    if( res > 0 )
                        $( value ).addClass( 'positive' );
                    else if( res < 0 )
                        $( value ).addClass( 'negative' );
                    else if( res == 0 )
                        $( value ).css( 'font-weight', 'bold' );
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

                // add highchart-table class to the first two tables on the page.
                $( '.commercial.analyse #ajax-area .branch:nth-child( 1 ) table' )
                        .addClass( 'highchart-table' );
                $( '.commercial.analyse #ajax-area .branch:nth-child( 2 ) table' )
                        .addClass( 'highchart-table' );

                $( '.highchart-table' ).closest( '.branch' ).hide();

                // create array to store table information in
                var hcArr = [];
                $( '.highchart-table' ).each( function() {
                    var $self  = $( this ),
                        obj    = {};

                    // get the indicateur from the table head
                    obj.name = $self.find( 'thead tr:last th:last' ).text();
                    obj.title = $.trim( $self.find( 'thead tr:first th:last' ).text() );
                    obj.data = [];

                    // loop through the table body and make key value pairs
                    $self.find( 'tbody th' ).each( function() {
                        obj.data.push( { name: $.trim( $( this ).text() ), y: parseFloat( $( this ).siblings( 'td' ).text() ) } );
                    });

                    hcArr.push( obj );
                });

                return hcArr;
            }


            // add Highcharts graphs
            function addCharts() {
                hcArr = getValues();
                $( '.commercial.analyse #ajax-area' ).append( '<div id="highcharts-div" style="overflow: hidden;"></div>' );

                $.each( hcArr, function( index, value ) {
                    options = setOptions( index );
                    options.series = [];
                    options.title = hcArr[index]['title'];
                    options.series.push( hcArr[index] );
                    createPlaceholders( index );
                    var chart = new Highcharts.Chart( options );
                    $( '<h5>' + hcArr[index]['title'] + '</h5>' ).insertBefore( '#graph' + index + '>div' );
                });
            }


            // create placeholders for graphs
            function createPlaceholders( index ) {
                $( '#highcharts-div' )
                    .append( '<div id="graph' + index + '" class="highchart-holder"></div>' );
            }


            // set the options for Highcharts graphics
            function setOptions( index ) {
                options = {
                    chart: { renderTo: 'graph' + index, type: 'pie' },
                    credits: { enabled: false },
                    colors: [ '#9a009a', '#de00de', '#ff5bff', '#ff97ff', '#ffd1ff', '#DB843D', '#92A8CD', 
                              '#A47D7C', '#B5CA92' ],
                    exporting: { enabled: false },

                    xAxis: {},
                    yAxis: { min: 0, labels: { formatter: function() { return this.value; } } },
                    tooltip: { formatter: function() { return '<b>' + this.point.name + '</b><br>' + this.y; } },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels : {
                                enabled: true, color: '#000', connectorColor: '#000',
                                formatter: function() {
                                    return '<b>' + this.point.name + '</b>: ' + Math.round( this.percentage ) + ' %';
                                }
                            },
                            showInLegend: true,
                        }
                    }
                };

                return options;
            }


            // make the tables in palmares scrollable
            function scrollingTables() {
                $( '.commercial.palmares #ajax-area table' ).addClass( 'scroll-table' );
                if( $( '#filtre-geo' ).val() == 'ville' ) {
                    $( '.scroll-table' ).fixedHeaderTable( {
                        height: 500
                    });
                }
            }


            // create gauges for commercial home page
            function createGauges( profile, page ) {
                if( profile == "commercial" && page == 'accueil' ) {
                    $( '.commercial.accueil #ajax-area' ).append( '<div style="float: left; position: relative; left: 50%;"><div id="FWWrapper" style="overflow: hidden"></div></div>' );
                    $( '#FWWrapper' ).append( '<div id="chartContainer1" class="FWContainer">Fusion Widgets will load here</div>' );
                    $( '#FWWrapper' ).append( '<div id="chartContainer2" class="FWContainer">Fusion Widgets will load here</div>' );
                    $( '#FWWrapper' ).append( '<div id="chartContainer3" class="FWContainer">Fusion Widgets will load here</div>' );

                    $.each( 'pre', function( index, value ) {
                        var myChart = new FusionCharts( "<?= base_url( 'assets/graphs/HLinearGauge.swf' ) ?>", "myChartID" + ( index + 1 ), "280", "100", "0", "1" );
                        myChart.setXMLData('<chart lowerLimit="-100" upperLimit="100"  palette="1" numberSuffix="%" chartRightMargin="20" gaugeRoundRadius="10">\n\
                        <colorRange>\n\
                        <color minValue="-100" maxValue="10" code="FF654F" />\n\
                        <color minValue="10" maxValue="30" code="F6BD0F" />\n\
                        <color minValue="30" maxValue="100" code="8BBA00" />\n\
                        </colorRange>\n\
                        <pointers>\n\
                        <pointer value="-50" />\n\
                        </pointers>\n\
                        <trendpoints>\n\
                          <point startValue="15" displayValue="obj." color="black" thickness="0" alpha="100" showOnTop="0" useMarker="1" markerColor="F1f1f1" markerTooltext="objectif fixe par le directeur"/>\n\
                        </trendpoints>\n\
                        </chart>');
                        myChart.render("chartContainer" + ( index + 1 ) );
                    });

                    $( '.FWContainer' ).each( function() {
                        $( this ).prepend( '<div class="trialHider"></div>' );
                    });
                }
            }
        })( jQuery );
    </script>
</body>
</html>