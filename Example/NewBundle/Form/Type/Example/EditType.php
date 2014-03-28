<?php

namespace Example\NewBundle\Form\Type\Example;


use Olabs\MIRBundle\Form\Entity\Image\EditType as ExampleImageEditType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('images', 'collection', array(
            'label' => 'Images',
            'type' => new ExampleImageEditType(),
            'allow_delete' => true,
            'allow_add' => true,
            'by_reference' => false,
        ));
    }

    public function getName()
    {
        return 'info_form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Example\NewBundle\Entity\Example',
                'csrf_protection' => false,
            )
        );
    }
}