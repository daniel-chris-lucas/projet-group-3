<!-- Start main banner -->
<header id="main-header">
    <table>
        <tr>
            <td width="132">
                <aside class="header-logos">
                    <img src="<?= base_url( 'assets/img/logo-iut-vannes.png' ) ?>" alt="IUT de Vannes" width="48" height="60">
                    <img src="<?= base_url( 'assets/img/logo-darties.png' ) ?>" alt="Darties" width="60" height="60">
                </aside>
            </td>
            <td>
                <?php if( $this->utilisateur->loggedin() ) : ?>
                    <h1>Tableau de Bord - <?= $this->session->userdata( 'profile' ) ?></h1>
                    <aside class="header-info">
                        <span style="padding-right: 20px;"><?= strtoupper( $this->data['current_user']->PRENOM . ' ' . $this->data['current_user']->NOM_USER ) . " - " . $this->session->userdata( 'profile' ) ?></span>
                        <span style="padding-right: 20px;">Date: <?= date( "d/m/Y" ) ?></span>
                        <span>Dernière M.A.J - [Date MAJ]</span>
                    </aside>
                <?php else : ?>
                    <h1>Tableau de Bord Evène</h1>
                <?php endif; ?>
            </td>
            <td width="202">
                <?php if( $this->utilisateur->loggedin() ) : ?>
                    <div class="header-buttons">
                        <a href="#" class="print-button hide-text" title="Imprimer">Imprimer</a>
                        <a href="#" class="email-button hide-text" title="Envoyer par Email">Envoyer par Email</a>
                        <a href="<?= site_url( 'utilisateurs/logout' ) ?>" class="deconnexion-button hide-text">Déconnexion</a>
                    </div>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</header>
<!-- End main banner -->