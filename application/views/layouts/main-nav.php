<!-- Start main nav -->
<nav id="main-nav" class="clearfix">
    <ul>
        <?php foreach( $this->data['menu'] as $item_name => $item ) : ?>
            <li<?= $item_name == $this->data['active'] ? ' class="active"' : '' ?>>
                <a href="<?= isset( $item['lien'] )
                        ? $item['lien']
                        : site_url( $this->session->userdata( 'profile' ) . '/' . $item_name ) ?>"
                >
                    <img src="<?= base_url( 'assets/img/menus/menu-' . $item_name  . '.png' ) ?>" 
                            width="<?= $item['img_width'] ?>" height="<? $item['img_height'] ?>">
                    <?= $item['nom'] ?>
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