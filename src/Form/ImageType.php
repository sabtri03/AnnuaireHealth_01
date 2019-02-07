<?php
namespace App\Form;

use App\Entity\Pictures;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class ImageType extends FileType
{
    private $imagePath;

    /**
     * @param $imagePath
     */
    public function __construct( $imagePath ) {
        $this->imagePath = $imagePath;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->addModelTransformer(new CallbackTransformer(
            function(Pictures $picture=null){
                if($picture instanceof Pictures){
                    try{
                        $f = new Picture($this->imagePath."/".$picture->getPicture());
                        return $f;
                    }catch(FileNotFoundException $e){
                        dump($e->getMessage());
                    }
                }return null;
            },

            function(UploadedFile $uploadedFile =null ){
                if($uploadedFile instanceof UploadedFile){
                    $picture = new Pictures();
                    $picture->setPicture($uploadedFile);
                    return $picture;
                }
            }
        ));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'required' => false,
        ]);
    }
}