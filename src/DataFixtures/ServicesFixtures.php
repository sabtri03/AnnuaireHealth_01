<?php

namespace App\DataFixtures;

use App\Entity\Services;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ServicesFixtures extends Fixture
{
    //Constant use to connect the ServiceFixtures to the WorkerFixtures
    public const SERVICES_REFERENCE = "Services-ref";

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //create an object to inject all the services in it => obj add services to a worker
        $worker = new Services();

        //creation by doctrine fixture of 10 new services
        for($i = 1; $i < 11; $i++){
            $services = new Services();
            $services->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In volutpat ipsum et sapien luctus, posuere hendrerit ex sodales. Duis iaculis quis enim ac consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam finibus sem vitae tellus rhoncus rutrum.');
            $services->setNom('Service'.$i);
            $services->setEnAvant(0);
            $services->setValide(0);
                //$services->addOffer('Services_'.id, $services);
            $manager->persist($services);

                //add the services to the object that will be send to worker via addReference()
                $worker->$i = $services;
        }
        $manager->flush();

        // other fixtures can get this object using the CPLocaliteFixtures::CP_REFERENCE constant
        $this->addReference(self::SERVICES_REFERENCE, $worker);
    }
}
