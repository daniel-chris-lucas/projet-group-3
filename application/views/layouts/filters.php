<!-- Start filters -->
<nav id="filters-nav">
    <form>
        <p>
            <!-- start indicateurs -->
            <select name="indicateur" id="indicateur" class="filter-dropkick" disabled>
                <option value="null">--- Indicateur ---</option>
                <option value="CA" data-display="Chiffre d'affaires">Chiffre d'Affaires</option>
                <option value="MB" data-display="Marge brute">Marge Brute</option>
                <option value="V" data-display="Ventes">Ventes</option>
            </select>
            <!-- end indicateurs -->

            <!-- start dates -->
            <select name="date" id="date" class="filter-dropkick" disabled>
                <option value="null">--- Date ---</option>
                <?php foreach( $this->data['dates'] as $date ) : ?>
                    <option value="<?= $date->IDTEMPS ?>" data-display="<?= "{$date->MOIS} {$date->ANNEE}" ?>">
                        <?= "{$date->MOIS} {$date->ANNEE}" ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <!-- end dates -->

            <select name="devise" id="devise" class="filter-dropkick" disabled>
                <option value="null">--- Devise ---</option>
            </select>
            <select name="enseigne" id="enseigne" class="filter-dropkick" disabled>
                <option value="null">--- Enseigne ---</option>
                <?php foreach( $this->data['enseignes'] as $enseigne ) : ?>
                    <option value="<?= $enseigne->ENSEIGNE ?>">
                        <?= $enseigne->ENSEIGNE ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="region" id="region" class="filter-dropkick" disabled>
                <option value="null">--- Région ---</option>
                <?php foreach( $this->data['regions'] as $region ) : ?>
                    <option value="<?= $region->IDREGION ?>" data-display="<?= str_replace( '_', ' ', $region->LIBELLE_REGION ) ?>">
                        <?= str_replace( '_', ' ', $region->LIBELLE_REGION ) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="cumul" id="cumul" class="filter-dropkick" disabled>
                <option value="null">--- Cumul ---</option>
            </select>
            <select name="produits" id="produits" class="filter-dropkick" disabled>
                <option value="null">--- Famille de Produits ---</option>
                <?php foreach( $this->data['produits'] as $produit ) : ?>
                    <option value="<?= $produit->IDFAMILLE_PRODUIT ?>" data-display="<?= $produit->LIB_FAMILLE ?>">
                        <?= $produit->LIB_FAMILLE ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
    </form>
</nav>
<!-- End filters -->