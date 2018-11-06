<?php

namespace App\DataFixtures;

use App\Entity\CodePostal;
use App\Entity\Localite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CPLocaliteFixtures extends Fixture
{
    //Constant use to connect the CPLocaliteFixtures to the WorkerFixtures to share the CodePostal
    public const CP_REFERENCE = "cp-ref";
    //Constant use to connect the CPLocaliteFixtures to the WorkerFixtures to share the City
    public const LOCALITE_REFERENCE = "Localite-ref";

    public function load (ObjectManager $manager)
    {
        $cp = new CodePostal();
        //creation by doctrine fixtur of 10 new Code Postal
        for($i = 1; $i < 20; $i++) {
            $userCP = new CodePostal();
            $userCP->setPostCode(rand(4000,4999));
            $manager->persist($userCP);
            $cp->$i = $userCP;
        }
        $manager->flush();

        // other fixtures can get this object using the CPLocaliteFixtures::CP_REFERENCE constant
        $this->addReference(self::CP_REFERENCE, $cp);

        //creation by doctrine fixtur of 10 new Code Postal
        $lc = new Localite();
        for($j = 1; $j < 20; $j++) {
            $userLocalite = new Localite();
            $userLocalite->setCity('City'.$j);
            $manager->persist($userLocalite);
            $lc->$j = $userLocalite;
        }
        $manager->flush();

        // other fixtures can get this object using the CPLocaliteFixtures::CP_REFERENCE constant
        $this->addReference(self::LOCALITE_REFERENCE, $lc);

    }
}