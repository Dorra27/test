<?php

namespace LivraisonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PointCollecte
 *
 * @ORM\Table(name="point_collecte")
 * @ORM\Entity
 */
class PointCollecte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_magasin", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=100, nullable=false)
     */
    private $pays;

    /**
     * @var integer
     *
     * @ORM\Column(name="log", type="integer", nullable=true)
     */
    private $log;

    /**
     * @var integer
     *
     * @ORM\Column(name="lat", type="integer", nullable=true)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="horaire_travail", type="string", length=100, nullable=true)
     */
    private $horaireTravail;

    /**
     * @var string
     *
     * @ORM\Column(name="jour", type="string", length=100, nullable=true)
     */
    private $jour;


}

