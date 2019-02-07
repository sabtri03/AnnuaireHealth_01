<?php

namespace App\EventListener;



use App\Entity\Pictures;
use App\Services\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
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
            $filename = $this->uploader->upload($picture);
            $entity->setPicture($filename);
        }
    }
    public function log( $level, $message, array $context = array() ) {
        $this->logger->log($level, $message, $context);
    }
}