<?php

namespace VehiculeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity
 */
class Vehicule
{
    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=50)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=50, nullable=true)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="puissance", type="string", length=50, nullable=true)
     */
    private $puissance;

    /**
     * @var string
     *
     * @ORM\Column(name="energie", type="string", length=500, nullable=true)
     */
    private $energie;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=50, nullable=true)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="kilometrage", type="string", length=50, nullable=true)
     */
    private $kilometrage;

    /**
     * @var string
     *
     * @ORM\Column(name="nbPlace", type="string", length=11, nullable=true)
     */
    private $nbplace;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=50, nullable=false)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=255, nullable=false)
     */
    private $prix;


}

