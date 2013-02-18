<?php
	$menu = [];
	$active = ( $this->uri->segment(1) == null ) ? "accueil" : $this->uri->segment(2);

	$menu["commercial"]["accueil"] = array( "Accueil", 23, 20, base_url() );
	$menu["commercial"]["historique"] = array( "Historique", 23, 20 );
	$menu["commercial"]["palmares"] = array( "Palmarès", 25, 22 );
	$menu["commercial"]["analyse"] = array( "Analyse", 22, 17 );
	$menu["commercial"]["dicodonnees"] = array( "Dictionnaire des Données", 20, 21 );
	$menu["commercial"]["contacts"] = array( "Contacts", 24, 16 );
	$menu["commercial"]["aide"] = array( "Aide", 22, 21 );
?>
<!-- Start main nav -->
<nav id="main-nav" class="clearfix">
    <ul>
        <?php foreach( $menu["commercial"] as $menu_item_name => $menu_item ) : ?>
            <li <?= ( $menu_item_name == $active ) ? 'class="active"' : '' ?>>
                <a href="<?= isset( $menu_item[3] ) 
	                	? $menu_item[3] 
	                	: base_url() . $this->session->userdata( 'profile' ) . '/' . $menu_item_name ?>">
                	<img src="<?= base_url() ?>assets/img/menus/dc-<?= $menu_item_name ?>.png" width="<?= $menu_item[1] ?>" height="<?= $menu_item[2] ?>">
                    <?= $menu_item[0] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="menu-buttons">
        <a href="#" class="print-button hide-text" title="Imprimer">Imprimer</a>
        <a href="#" class="email-button hide-text" title="Envoyer par Email">Envoyer par Email</a>
        <a href="<?= base_url() ?>home/logout" class="deconnexion-button hide-text">Déconnexion</a>
    </div>
</nav>
<!-- End main nav -->