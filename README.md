Olabs/MIRBundle
=========
Example
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
AppKernel.php
=========
    new Olabs\MIRBundle\OlabsMIRBundle(),
=========
#/app/config/config.yml
    image_resize:
        image_loader:
            imagine_class: 'Imagine\Gd\Imagine'
            type: 'file'

Product.php
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
     * @param \Olabs\MirBundle\Entity\Image $image
     * @return ProductImage
     */
    public function setImages(\Doctrine\Common\Collections\Collection $images)
        {
        $this->images = $images;
        return $this;
        }
    }
ProductImage.php    
=========     
    <?php

    namespace you_project\Entity;

    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
    use Symfony\Component\Validator\Constraints as Assert;
    use JMS\Serializer\Annotation as JMS;
    use Olabs\MIRBundle\Entity\Image;
    use Olabs\MIRBundle\Entity\MappedEntityImage;
    use you_project\Entity\Product;

    /**
    * Product image
    *
    * @ORM\Entity()
    * @ORM\HasLifecycleCallbacks()
    * @JMS\ExclusionPolicy("all")
    */
    class ProductImage extends MappedEntityImage
    {


    /**
     * @var Product
     * @ORM\OneToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", nullable=true)
     */
    protected $product;

    /**
     * @ORM\OneToMany(targetEntity="ProductImage", mappedBy="parent")
     */
    protected $children;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="ProductImage", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    protected $parent;
    /**
     * Add children
     *
     * @param \you_project\Entity\ProductImage $children
     * @return ProductImage
     */
    public function addChild(\you_project\Entity\ProductImage $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \you_project\Entity\ProductImage $children
     */
    public function removeChild(\you_project\Entity\ProductImage $children)
    {
        $this->children->removeElement($children);
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
     * Set parent
     *
     * @param \you_project\Entity\ProductImage $parent
     * @return ProductImage
     */
    public function setParent(\you_project\Entity\ProductImage $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \you_project\Entity\ProductImage
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set product
     *
     * @param \you_project\Entity\Product $product
     * @return ProductImage
     */
    public function setProduct(\you_project\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }
    /**
     * Get product
     *
     * @return \you_project\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
    }
    
you_project\Form\Type\ProductType.php    
=========   
    <?php

    namespace you_project\Form\Type\Product;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolverInterface;
    use you_project\Entity\Product;
    use Olabs\MIRBundle\Form\Type\Entity\Image\EditType as ProductImageEditType;

    class EditType extends AbstractType
    {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('title', 'text', array('required' => true, 'label' => 'Title'));
        $builder->add('logo', new ProductImageEditType(), array('required' => true, 'label' => 'Image'));
        $builder->add('images', 'collection', array(
            'label' => 'Images',
            'type' => new ProductImageEditType(),
            'allow_delete' => true,
            'allow_add' => true,
            'by_reference' => false,
        ));



    }

    public function getName()
    {
        return 'product_form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'you_project\Entity\Product',
                'csrf_protection' => false,
            )
        );
    }
    }
    
you_project/Resources/config/services.xml    
=========      
    <?xml version="1.0" ?>

    <container xmlns="http://symfony.com/schema/dic/services"
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://symfony.com/schema/dic/services
           http://symfony.com/schema/dic/services/services-1.0.xsd">


    <services>
        <service id="project.main.product_manager" class="you_project\Service\ProductManager">
            <argument type="service" id ="doctrine.orm.entity_manager"/>
            <argument type="service" id ="olabs.main.image_handler"/>
            <argument type="service" id ="olabs.main.image_gallery_manager"/>
        </service>
    </services>
    </container>
you_project/Service/ProductManager.php    
=========      
    <?php

    namespace you_project\Service;


    use you_project\Entity\Product;
    use Doctrine\ORM\EntityManager;
    use you_project\Entity\ProductImage;

    class ProductManager
    {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \you_project\Entity\ProductRepository
     */
    protected $productRepo;

    /**
     * @param Product $product
     */
    public function delete($product)
    {
        $product->setIsDeleted(true);
    }
    public function recover($product)
    {
        $product->setIsDeleted(false);
    }

    public function __construct(EntityManager $em, ImageHandler $imageHandler, ImageGalleryManager $imageGalleryManager)
    {
        $this->em = $em;
        $this->imageHandler = $imageHandler;
        $this->imageGalleryManager = $imageGalleryManager;
    }

    public function saveProduct(Product $product)
    {
        $this->imageGalleryManager->processGallerySaveImage($product, $product->getLogo(), 'logo');
        $product->setLogo($product->getLogo());
        $this->imageGalleryManager->processEntityGallerySave($product);

    }

    }
you_project/Controller/ProductController.php    
=========       
    public function editAction()
    {
    .............

        if ($form->isValid()) {
            /** @var ProductManager $productManager */
            $productManager = $this->get('project.main.product_manager');
            $productManager->saveProduct($product);
    .............
    }
you_project/Resources/views/Product/edit.html.twig    
=========   
    {% block javascripts %}
    {{ parent() }}

    {% javascripts output='js/compiled/subformImages.js'
    '@YouProjectBundle/Resources/public/js/subform/images.js'
    %}
    <script type="text/javascript" src="{{ asset_url }}"></script>
    {% endjavascripts %}
    {% endblock %}
    .............
    {% if product.logo %}
        <img src="{{ product.logo.getThumbnail.image.getWebPath }}">
    {% endif %}
    {{ form_widget(form.logo.image.file, {'attr': {
    'class': 'file' }}) }}
    {{ form_errors(form.logo) }}
    
    {{ include('YouProjectBundle::imagesForm.html.twig', {'images':form.images, 'entityName':'product'}) }}
    
you_project/Resources/views/imagesForm.html.twig    
=========  
    {% set subformProto = '
    <div class="subform">
        <div class="grid4">
            <input type="file" id="' ~ entityName ~ '_form_images___name___image_file" name="' ~ entityName ~
            '_form[images][__name__][image][file]" />
        </div>
    </div>
    ' %}

    <div class="imageSubforms fluid clearfix">
    <span class="input-label">{{ images.vars.label }}</span>
    <div class="fluid clearfix">
        {% for entity_image in images %}
            <div class="grid1" id="existed_image_{{ loop.index }}">
                <div style="display: none">
                    {{ form_row(entity_image.image.file) }}
                </div>

                <div>

                    <img src="{{ entity_image.vars.data.getThumbnail.image.getWebPath }}">

                </div>
                <div>
                    <a href="#" onclick="$('#existed_image_{{ loop.index }}').remove();return false;"
                    style="text-decoration:none; border-bottom:1px dashed;">Remove</a>
                </div>
            </div>
        {% endfor %}
    </div>

    <div class="subformsCollection fluid clearfix" data-prototype="{{ subformProto | e}}"  style="margin-top: 15px;">
    </div>

    <div class="fluid">
        <a class="addSubform" href="#" style="text-decoration:none; border-bottom:1px dashed;">Add image</a>
    </div>
    </div>
