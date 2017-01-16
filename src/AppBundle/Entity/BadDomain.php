<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 14.01.17
 * Time: 15:40
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * @ORM\Entity
 * @ORM\Table(name="bad_domains")
 */

class BadDomain
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @GeneratedValue
     */

    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}