<!-- Start main banner -->
<header id="main-header">
    <table>
        <tr>
            <td width="132">
                <aside class="header-logos">
                    <?= Asset::img( "logo-iut-vannes.png", 
                            array( "alt" => "IUT de Vannes", "width" => 48, "height" => 60 ) ) ?>
                    <?= Asset::img( "logo-darties.png", 
                            array( "alt" => "Darties", "width" => 60, "height" => 60 ) ) ?>
                </aside>
            </td>
            <td>
                <?php if( Session::get( "username" ) ) : ?>
                    <h1>Tableau de Bord - <?= $current_profile ?></h1>
                <?php else : ?>
                    <h1>Tableau de Bord Evène</h1>
                <?php endif; ?>
            </td>
            <td width="202">
                <?php if( Session::get( "username" ) ) : ?>
                    <aside class="header-info">
                        <p>
                            <?= strtoupper( $current_user ) . " - " . $current_profile ?><br>
                            Date: <?= date( "d/m/Y" ) ?><br>
                            Dernière M.A.J - [Date MAJ]
                        </p>
                    </aside>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</header>
<!-- End main banner -->