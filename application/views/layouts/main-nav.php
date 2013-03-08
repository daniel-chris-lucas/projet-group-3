<!-- Start main nav -->
<nav id="main-nav" class="clearfix">
    <ul>
        <?php foreach( $this->data['menu'] as $item_name => $item ) : ?>
            <li<?= $item_name == $this->data['active'] ? ' class="active"' : '' ?>>
                <a href="<?= isset( $item['lien'] )
                        ? $item['lien']
                        : site_url( $this->data['current_profile'] . '/' . $item_name ) ?>"
                >
                    <img src="<?= base_url( 'assets/img/menus/menu-' . $item_name  . '.png' ) ?>" 
                            width="<?= $item['img_width'] ?>" height="<? $item['img_height'] ?>">
                    <?= $item['nom'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<!-- End main nav -->