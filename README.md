MIRBundle
=========
#/app/config/parameters.yml
    images_gallery_sizes:
        Product:
          logo:
            main_thumbnail:
              width: 50
              height: 50
            iphone:
              standart:
                width: 840
                height: 620
              thumbnail:
                width: 320
                height: 240
            android:
              standart:
                width: 840
                height: 620
              thumbnail:
                width: 320
                height: 240
          images:
            main_thumbnail:
              width: 50
              height: 50
            iphone:
              standart:
                width: 840
                height: 620
              thumbnail:
                width: 320
                height: 240
            android:
              standart:
                width: 840
                height: 620
              thumbnail:
                width: 320
                height: 240
=========
#/app/config/config.yml
image_resize:
  image_loader:
    imagine_class: 'Imagine\Gd\Imagine'
    type: 'file'
=========   
<?php

namespace you_project\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;



/**
 * Product
 *
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass="ProductRepository")
 * @ORM\Table(name="product")
 * @ORM\HasLifecycleCallbacks()
 * @JMS\ExclusionPolicy("all")
 */
class Product
{


    /**
     * identifier
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     * @JMS\Groups({"info_get", "info_list"})
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="ProductImage", inversedBy="product", cascade={"persist"})
     * @ORM\JoinColumn(name="logo_id", referencedColumnName="id", nullable=true)
     */
    private $logo;
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="ProductImage", mappedBy="product", cascade={"persist"})
     */
    private $images;

    /**
     * Title
     * @var string
     * @ORM\Column(name="title", type="string")
     * @Assert\NotBlank
     * @JMS\Expose
     * @JMS\Groups({"product_get", "product_list"})
     */
    private $title;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set logo
     *
     * @param ProductImage $logo
     * @return Product
     */
    public function setLogo($logo)
    {
        if ($logo) { $logo->setProduct($this); }
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add images
     *
     * @param ProductImage $image
     * @return Product
     */
    public function addImage(ProductImage $image)
    {
        $image->setProduct($this);

        $this->images[] = $image;

        return $this;
    }

    /**
     * @param ProductImage $image
     */
    public function removeImage(ProductImage $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
    /**
     * Set image
     *
     * @param \Lukoil\MainBundle\Entity\Image $image
     * @return ProductImage
     */
    public function setImages(\Doctrine\Common\Collections\Collection $images)
    {
        $this->images = $images;
        return $this;
    }
}
    
