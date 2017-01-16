<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 14.01.17
 * Time: 15:39
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClickRepository")
 * @ORM\Table(name="click")
 */

class Click
{
    public function __construct($id, $server = null)
    {
        $this->setId($id);
        $this->setError(0);
        $this->setIsBadDomain(false);

        if($server)
        {
            if(isset($server['SERVER_NAME']))
            {
                $this->setIp($server['SERVER_NAME']);
            }

            if(isset($server['HTTP_USER_AGENT']))
            {
                $this->setUserAgent($server['HTTP_USER_AGENT']);
            }

            if(isset($server['HTTP_REFERER']))
            {
                $this->setReferrer($server['HTTP_REFERER']);
            }
        }
    }

    /**
     * @ORM\Column(type="integer", unique=true)
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, name="ua", nullable=true)
     */
    private $userAgent;

    /**
     * @ORM\Column(type="string", length=50, name="ip", nullable=true)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", length=255, name="ref", nullable=true)
     */
    private $referrer;

    /**
     * @ORM\Column(type="string", length=50, name="param1")
     */
    private $param1;

    /**
     * @ORM\Column(type="string", length=50, name="param2")
     */
    private $param2;

    /**
     * @ORM\Column(type="integer")
     */
    private $error;

    /**
     * @ORM\Column(type="boolean", name="bad_domain")
     */
    private $isBadDomain;

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
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param mixed $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * @param mixed $referrer
     */
    public function setReferrer($referrer)
    {
        $this->referrer = $referrer;
    }

    /**
     * @return mixed
     */
    public function getParam1()
    {
        return $this->param1;
    }

    /**
     * @param mixed $param1
     */
    public function setParam1($param1)
    {
        $this->param1 = $param1;
    }

    /**
     * @return mixed
     */
    public function getParam2()
    {
        return $this->param2;
    }

    /**
     * @param mixed $param2
     */
    public function setParam2($param2)
    {
        $this->param2 = $param2;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getIsBadDomain()
    {
        return $this->isBadDomain;
    }

    /**
     * @param mixed $isBadDomain
     */
    public function setIsBadDomain($isBadDomain)
    {
        $this->isBadDomain = $isBadDomain;
    }
}