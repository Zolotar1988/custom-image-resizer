<?php

namespace Olabs\MIRBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\MappedSuperclass
 * @JMS\ExclusionPolicy("all")
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
     * @JMS\Expose
     * @JMS\Groups({"info_get"})
     */
    protected $size_category;

    /**
     * @ORM\OneToMany(targetEntity="Olabs\MIRBundle\Entity\EntityImage", mappedBy="parent")
     */
    protected $children;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Olabs\MIRBundle\Entity\EntityImage", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    protected $parent;

    /**
     * Creation date
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_date;

    /**
     * @ORM\PrePersist
     */
    protected function prePersist()
    {
        $currentDateTime = new \DateTime();
        if (!$this->getCreatedDate()) {
            $this->setCreatedDate($currentDateTime);
        }
    }
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
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }
    /**
     * Set size_type
     *
     * @param string $sizeType
     * @return InfoImage
     */
    public function setSizeType($sizeType)
    {
        $this->size_type = $sizeType;

        return $this;
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
     * Set size_category
     *
     * @param string $sizeCategory
     * @return EntityImage
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
     * Set created_date
     *
     * @param \DateTime $createdDate
     * @return EntityImage
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
     * @param Image $image
     * @return MappedEntityImage
     */
    public function setImage(Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set parent
     *
     * @param \Olabs\MIRBundle\Entity\InfoImage $parent
     * @return InfoImage
     */
    public function setParent(\Lukoil\MainBundle\Entity\InfoImage $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Olabs\MIRBundle\Entity\InfoImage
     */
    public function getParent()
    {
        return $this->parent;
    }
}
