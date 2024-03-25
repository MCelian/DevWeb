<?php
session_start();

$_SESSION['categorie'] = array(
    'Bulbes' => array(
        array(
            'photo' => '../img/bulbes_begonia.jpg',
            'reference' => 'b01',
            'description' => '3 bulbes de bégonias',
            'prix' => 5,
            'stock' => 10
        ),
        array(
            'photo' => '../img/bulbes_dahlia.jpg',
            'reference' => 'b02',
            'description' => '10 bulbes de dahlias',
            'prix' => 12,
            'stock' => 10
        ),
        array(
            'photo' => '../img/bulbes_glaieul.jpg',
            'reference' => 'b03',
            'description' => '50 glaïeuls',
            'prix' => 9,
            'stock' => 10
        )
    ),
    'Rosiers' => array(
        array(
            'photo' => '../img/rosiers_gdefleur.jpg',
            'reference' => 'r01',
            'description' => '1 pied spécial grandes fleurs',
            'prix' => 20,
            'stock' => 10
        ),
        array(
            'photo' => '../img/rosiers_parfum.jpg',
            'reference' => 'r02',
            'description' => 'Une variété sélectionné pour son parfum',
            'prix' => 9,
            'stock' => 10
        ),
        array(
            'photo' => '../img/rosiers_arbuste.jpg',
            'reference' => 'r03',
            'description' => 'Rosier arbuste',
            'prix' => 8,
            'stock' => 10
        )
    ),
    'Massif' => array(
        array(
            'photo' => '../img/massif_marguerite.jpg',
            'reference' => 'm01',
            'description' => 'Lot de 3 marguerites',
            'prix' => 5,
            'stock' => 10
        ),
        array(
            'photo' => '../img/massif_pensee.jpg',
            'reference' => 'm02',
            'description' => 'Pour un bouquet de 6 pensées',
            'prix' => 6,
            'stock' => 10
        ),
        array(
            'photo' => '../img/massif_melange.jpg',
            'reference' => 'm03',
            'description' => 'Mélange varié de 10 plantes à massif',
            'prix' => 15,
            'stock' => 10
        )
    )
);

?>