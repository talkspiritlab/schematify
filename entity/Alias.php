<?php

namespace Schematify\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bssupervisor\Repository\DefaultRepository")
 * @ORM\Table(name="aliases")
 */
class Alias {

    use HelperEntity;


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(referencedColumnName="id",columnDefinition="INT(11) DEFAULT '1' NOT NULL")
     */
    protected $user;

    /**
     * @ORM\Column(length=500)
     */
    protected $from;

    /**
     * @ORM\Column(length=500)
     */
    protected $to;

} 