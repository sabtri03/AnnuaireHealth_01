<?php

namespace App\EventListener;



use App\Entity\Pictures;
use App\Entity\ServiceUser;
use App\Entity\Worker;
use App\Services\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadListener {
    use LoggerTrait;
    /**
     * @var FileUploader
     */
    private $uploader;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * ImageUploadListener constructor.
     *
     * @param FileUploader $uploader
     */
    public function __construct( FileUploader $uploader, LoggerInterface $logger ) {
        $this->uploader = $uploader;
        $this->logger = $logger;
    }
    public function prePersist( LifecycleEventArgs $args ) {
        $entity = $args->getEntity();
        $this->uploadFile($entity);
    }
    public function preUpdate( PreUpdateEventArgs $args ) {
        $this->log(Logger::DEBUG, 'in preUpdate');
        $entity = $args->getEntity();

        $previousImage = null;
        // si l'entité modifiée est Worker
        if($entity instanceof Worker){
            // on récupère les changements
            $changes = $args->getEntityChangeSet();
            // si il y a un changement à la propriété `logo`
            if(array_key_exists('logo', $changes)){
                // on récupère l'entité existant avant le changement
                $previousImage = $changes['logo'][0];
            }
            // si la nouvelle version du User n'a plus de Logo
            if(is_null($entity->getLogo())){
                // on lui réinjecte l'image précédente
                $entity->addLogo($previousImage);
            }else{
                // si une nouvelle Image est uploadée
                // et qu'il en existe déjà une dans l'entité
                if(! is_null($previousImage)){
                    $this->uploader->removeFile($previousImage);
                }
            }
        }
        $this->uploadFile($entity);
    }

    private function uploadFile($entity){
        if(!$entity instanceof Pictures){
            return;
        }
        $picture = $entity->getPicture();
        $this->log(Logger::DEBUG, "hello Alex");
        $this->log(Logger::DEBUG, $picture);
        if($picture instanceof UploadedFile){
            $this->log(Logger::DEBUG, "debut uploadedFile");
            $filename = $this->uploader->upload($picture);
            $entity->setPicture($filename);
            $entity->setRank(1);  //Can't be null

        } elseif ($picture instanceof File) {

            $entity->setPicture($picture->getFilename());
        }
    }

    public function log( $level, $message, array $context = array() ) {
        $this->logger->log($level, $message, $context);
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Pictures) {
            return;
        }

        if ($fileName = $entity->getPicture()) {
            $entity->setPicture(new File($this->uploader->getTargetDirectory().'/'.$fileName));
        }
    }
}