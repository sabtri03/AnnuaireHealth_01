<?php

namespace App\DataFixtures;

use App\Entity\Pictures;
use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class WorkerFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        //creation by doctrine fixtur of 10 new servicesUser
        for($i = 1; $i < 11; $i++){
            $worker = new Worker();
            $worker->setEmailPublic($i.'@company.com');
            $worker->setName('Nom '.$i);
            $worker->setPhoneNumber('0032 '.$i);
            $worker->setTvaNb('0000'.$i);
            $worker->setWebSite('#');

            $worker->setEmail($i.'@hotmail.com');
            $worker->setAdresseStreet('Rue numero '.rand(0,20));
            $worker->setBanned(0);
            $worker->setInscribe(1);
            $worker->setInscribeDate(new \Datetime());
            $worker->setAdresseNumber(rand(0,400));
            $worker->setPassword('Password'.$i);
            $worker->setNbTry(0);

                //get back the object codePostal to inject it to worker
                $cps = $this->getReference(CPLocaliteFixtures::CP_REFERENCE);
                    $worker->setPostCode($cps->$i);
                //get back the object localite to inject it to worker
                $localite = $this->getReference(CPLocaliteFixtures::LOCALITE_REFERENCE);
                    $worker->setCity($localite->$i);

                //creation of the Object Picture for the Logo
                $PictureLogo = new Pictures();
                $PictureLogo->setPicture('https://via.placeholder.com/140x100?text=Logo');
                $PictureLogo->setRank(1);
                    $worker->addLogo($PictureLogo);
                //creation of the Object Picture for the Photos
                $PicturePhoto = new Pictures();
                $PicturePhoto->setPicture('https://via.placeholder.com/200x100?text=Photo');
                $PicturePhoto->setRank(1);
                    $worker->addPhoto($PicturePhoto);

                //get back the Object Services from serviceFixture
                $services =$this->getReference(ServicesFixtures::SERVICES_REFERENCE);
                    $worker->addService($services->$i);
                    $j= rand(1,10);
                    $worker->addService($services->$j);

            $manager->persist($worker);

        }
        $manager->flush();

    }
   /* public function getDependencies()
    {
        return array(
            CPLocaliteFixtures::class,
        );
    }*/
}
