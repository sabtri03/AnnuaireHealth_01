<?php
namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader {
    private $targetDirectory;
    /**
     * FileUploader constructor.
     *
     * @param $targetDirectory
     */
    public function __construct( $targetDirectory ) {
        $this->targetDirectory = $targetDirectory;
    }
    public function upload(UploadedFile $file){
        $filename = $this->getFilename($file);
        $file->move($this->targetDirectory, $filename);
        return $filename;
    }
    protected function getFilename(UploadedFile $file){
        return sprintf("%s.%s", md5(uniqid()), $file->guessExtension());
    }
    protected function getTargetDirectory(){
        return $this->targetDirectory;
    }
}







?>