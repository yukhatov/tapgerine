<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 16.01.17
 * Time: 18:35
 */
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\BadDomain;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Process;

class LoadProcessData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $domain = new BadDomain();
        $domain->setName('test.com');

        $manager->persist($domain);
        $manager->flush();
    }
}
