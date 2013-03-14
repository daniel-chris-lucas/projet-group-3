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

    <script src="<?= base_url( 'assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js' ) ?>"></script>

    <style>
        .modal h3 {
            font-family: "Ubuntu", sans-serif;
            text-align: center;
        }

        .modal-body, .modal-footer {
            text-align: center;
        }
    </style>
</head>
<body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please 
        <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">
        activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <?= $this->load->view( 'layouts/main-banner' ) ?>

    <div style="position: relative;">
        <?= form_open() ?>
            <div class="modal show" tabindex="-1">
                <header class="modal-header">
                    <h3>Mot de passe oublié</h3>
                </header>
                <div class="modal-body">  
                    <?php if( $this->session->flashdata( 'flash_error' ) ) : ?>
                        <div class="alert alert-error">
                            <h4>Erreur</h4>
                            <?= $this->session->flashdata( 'flash_error' ) ?>
                        </div>
                    <?php endif; ?>
                    <?php if( $this->session->flashdata( 'flash_info' ) ) : ?>
                        <div class="alert alert-info">
                            <?= $this->session->flashdata( 'flash_info' ) ?>
                        </div>
                    <?php endif; ?>             
                    <div class="control-group <?= form_error( 'email' ) ? 'error' : '' ?>">
                        <label for="email" class="control-label">Adresse Email</label>
                        <div class="controls">
                            <input type="text" name="email" id="email" placeholder="Adresse Email" tabindex="1" 
                                value="<?= set_value( 'email', '' ) ?>">
                            <?php if( form_error( 'email' ) ) : ?>
                                <span class="help-block"><?= form_error( 'email' ) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>               
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </div>
        </form>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        window.jQuery || 
        document.write('<script src="<?= base_url( "assets/js/vendor/jquery-1.8.3.min.js" ) ?>"><\/script>')
    </script>
    <script src="<?= base_url( 'assets/js/plugins.js' ) ?>"></script>
    <script src="<?= base_url( 'assets/js/main.js' ) ?>"></script>
</body>
</html>