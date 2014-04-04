<?php

namespace Olabs\MIRBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="EntityImageRepository")
 * @ORM\Table(name="entity_image")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="entity_name", type="string")
 * @ORM\DiscriminatorMap({"partner" = "X5\MainBundle\Entity\PartnerImage", "action" = "X5\MainBundle\Entity\ActionImage", "news" = "X5\MainBundle\Entity\NewsImage", "product" = "X5\MainBundle\Entity\ProductImage", "recipe" = "X5\MainBundle\Entity\RecipeImage", "shop" = "X5\MainBundle\Entity\ShopImage" })
 */
class EntityImage
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
