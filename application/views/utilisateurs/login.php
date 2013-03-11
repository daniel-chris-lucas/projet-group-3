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

        #wrapper {
            position: relative;
            width: 100%;
            height: 100%;
        }

        #wrapper>img {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -664px;
            margin-top: 50px;
        }

        #form-wrapper {
            background: #eff3f6;
            padding: 10px;
            width: 429px;
            position: absolute;
            top: 50%;
            right: 50%;
            margin-right: -605px;
            margin-top: 170px;

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
            margin-bottom: 5px;

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
    <?= $this->load->view( 'layouts/main-banner' ) ?>

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
        <img src="<?= base_url( 'assets/img/login/login-img.png' ) ?>" alt="Connectez vous à l'application Darties" width="788" height="533">

        <div id="form-wrapper">
            <?= form_open() ?>
                <?php if( $this->session->flashdata( 'flash_form_error' ) ) : ?>
                    <div class="alert alert-error">
                        <?= $this->session->flashdata( 'flash_form_error' ) ?>
                    </div>
                <?php endif; ?>
                <div class="control-group <?= form_error( 'identifiant' ) ? 'error' : '' ?>">
                    <label for="identifiant" class="control-label">Identifiant</label>
                    <div class="controls">
                        <input type="text" name="identifiant" id="identifiant" placeholder="Identifiant" tabindex="1" 
                            value="<?= set_value( 'identifiant', '' ) ?>">
                        <?php if( form_error( 'identifiant' ) ) : ?>
                            <span class="help-block"><?= form_error( 'identifiant' ) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?= form_error( 'mdp' ) ? 'error' : '' ?>">
                    <label for="mdp" class="control-label">
                        Mot de passe 
                        <a href="<?= site_url( 'utilisateurs/forgotten_password' ) ?>" tabindex="4">
                            Vous avez oublié votre mot de passe ?
                        </a>
                    </label>
                    <div class="controls">
                        <input type="password" name="mdp" id="mdp" placeholder="Mot de Passe" tabindex="2" autocomplete="Off">
                            <span class="help-block"><?= form_error( 'mdp' ) ?></span>
                    </div>
                </div>

                <div>
                    <input type="checkbox" name="souvenir" id="souvenir" tabindex="3">
                    <label for="souvenir">Se souvenir de moi</label>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End wrapper -->
</body>
</html>