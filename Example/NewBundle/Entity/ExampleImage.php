<?php

namespace Example\NewBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Olabs\MIRBundle\Entity\MappedEntityImage;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Example image
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @JMS\ExclusionPolicy("all")
 */



class ExampleImage extends MappedEntityImage
{


    /**
     * @var Example
     * @ORM\OneToOne(targetEntity="Example")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", nullable=true)
     */
    protected $example;



    /**
     * Set ex
     *
     * @param \Example\NewBundle\Entity\Example $example
     * @return ExampleImage
     */
    public function setExample(\Example\NewBundle\Entity\Example $example = null)
    {
        $this->example = $example;

        return $this;
    }

    /**
     * Get ex
     *
     * @return \Example\NewBundle\Entity\Example
     */
    public function getExample()
    {
        return $this->example;
    }

}