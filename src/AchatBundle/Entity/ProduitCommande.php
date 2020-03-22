<?php

namespace AchatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitCommande
 *
 * @ORM\Table(name="produit_commande")
 * @ORM\Entity
 */
class ProduitCommande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_commande", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idCommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;


}

