<?php

namespace Olabs\MIRBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 */
class MappedEntityImage extends EntityImage
{

    /**
     * @var Image
     * @ORM\OneToOne(targetEntity="Olabs\MIRBundle\Entity\Image", cascade={"persist"})
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=false)
     */
    protected $image;

    /**
     * Size category of resized image
     * @var String
     * @ORM\Column(name="size_category", type="string", nullable=true)
     */
    protected $size_category;

    /**
     * Size type of resized image
     * @var String
     * @ORM\Column(name="size_type", type="string", nullable=true)
     */
    protected $size_type;


    /**
     * Creation date
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_date;

    /**
     * Get thumbnail
     *
     * @return \Olabs\MIRBundle\Entity\Image
     */
    public function getThumbnail()
    {
        $thumbnail = new Image();
        foreach ($this->children as $child) {
            if ($child->getSizeCategory() == 'main_thumbnail') {
                $thumbnail = $child;
            }
        }
        return $thumbnail;
    }
    
        /**
     * Get thumbnail
     *
     * @return \Olabs\MIRBundle\Entity\Image
     */
    public function getFullSize()
    {
        $thumbnail = new Image();
        foreach ($this->children as $child) {
            if ($child->getSizeCategory() == 'full_size') {
                $thumbnail = $child;
            }
        }
        return $thumbnail;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $currentDateTime = new \DateTime();
        if (!$this->getCreatedDate()) {
            $this->setCreatedDate($currentDateTime);
        }
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

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
     * Set created_date
     *
     * @param \DateTime $createdDate
     * @return \Olabs\MIRBundle\Entity\EntityImage
     */
    public function setCreatedDate($createdDate)
    {
        $this->created_date = $createdDate;

        return $this;
    }

    /**
     * Get created_date
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->created_date;
    }

    /**
     * Set image
     *
     * @param \Olabs\MIRBundle\Entity\Image $image
     * @return \Olabs\MIRBundle\Entity\EntityImage
     */
    public function setImage(\Olabs\MIRBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Olabs\MIRBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set size_category
     *
     * @param string $sizeCategory
     * @return \Olabs\MIRBundle\Entity\EntityImage
     */
    public function setSizeCategory($sizeCategory)
    {
        $this->size_category = $sizeCategory;

        return $this;
    }

    /**
     * Get size_category
     *
     * @return string
     */
    public function getSizeCategory()
    {
        return $this->size_category;
    }

    /**
     * Set size_type
     *
     * @param string $sizeType
     * @return \Olabs\MIRBundle\Entity\EntityImage
     */
    public function setSizeType($sizeType)
    {
        $this->size_type = $sizeType;

        return $this;
    }

    /**
     * Get size_type
     *
     * @return string
     */
    public function getSizeType()
    {
        return $this->size_type;
    }
}
