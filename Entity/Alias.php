<?php

namespace Schematify\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="aliases")
 */
class Alias 
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(referencedColumnName="id")
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
