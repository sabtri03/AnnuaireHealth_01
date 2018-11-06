<?php

namespace App\DataFixtures;

use App\Entity\ServiceUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ServiceUserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //creation by doctrine fixtur of 10 new servicesUser
        for($i = 1; $i < 11; $i++){
            $serviceUser = new ServiceUser();
            $serviceUser->setName('Nom '.$i);
            $serviceUser->setSurname('Prenom '.$i);
            $serviceUser->setNewsletter(0);

            $serviceUser->setEmail($i.'@hotmail.com');
            $serviceUser->setAdresseStreet('Rue numero '.rand(0,20));
            $serviceUser->setBanned(0);
            $serviceUser->setInscribe(1);
            $serviceUser->setInscribeDate(new \Datetime());
            $serviceUser->setAdresseNumber(rand(0,400));
            $serviceUser->setPassword('Password'.$i);
            $serviceUser->setNbTry(0);

            // other fixtures can get this object using the CPLocaliteFixtures::CP_REFERENCE  constant et CPLocaliteFixtures::LOCALITE_REFERENCE  constant
            $cps = $this->getReference(CPLocaliteFixtures::CP_REFERENCE);
            $serviceUser->setPostCode($cps->$i);
            $localite = $this->getReference(CPLocaliteFixtures::LOCALITE_REFERENCE);
            $serviceUser->setCity($localite->$i);

            //$serviceUser->setAvatar('https://via.placeholder.com/140x100?text=Avatar');

            $manager->persist($serviceUser);
        }
        $manager->flush();
    }
    /*public function getDependencies()
    {
        return array(
            CPLocaliteFixtures::class,
        );
    }*/
}
