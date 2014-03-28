<?php

namespace Example\NewBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Example\NewBundle\Entity\Example;
use Olabs\MIRBundle\Service\ImageGalleryManager;
use Olabs\MIRBundle\Service\ImageHandler;

class ExampleManager
{
    /** @var  EntityManager */
    private $em;

    /** @var ImageHandler  */
    private $imageHandler;

    /** @var ImageGalleryManager  */
    private $imageGalleryManager;

    /**
     * @var \Example\NewBundle\Entity\ExampleRepository
     */
    protected $newsRepo;

    /**
     * @param Example $example
     */
    public function delete($example)
    {
        $example->setIsDeleted(true);
    }
    public function recover($example)
    {
        $example->setIsDeleted(false);
    }

    public function __construct(EntityManager $em, ImageHandler $imageHandler, ImageGalleryManager $imageGalleryManager)
    {
        $this->em = $em;
        $this->imageHandler = $imageHandler;
        $this->imageGalleryManager = $imageGalleryManager;
    }

    public function saveExample(Example $example)
    {
//        $this->saveImageGallery($action);
        $this->imageGalleryManager->processGallerySaveImages($example, $example->getImages());

    }
}