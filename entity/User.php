<?php

namespace Schematify\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="users")
 */
class User implements AppEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer",columnDefinition="INT(11) DEFAULT '1' NOT NULL")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(length=250)
     */
    protected $email = '';

    /**
     * @ORM\Column(length=32,options={"default":""})
     */
    protected $pasword = '';

}
