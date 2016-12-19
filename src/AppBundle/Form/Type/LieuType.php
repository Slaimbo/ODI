<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use AppBundle\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LieuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {    
        $builder
            ->setMethod($options["method"])
            ->add('nom', TextType::class)
            ->add('longitude',NumberType::class, 
                  array('attr' => array('step' => 'any')))	
            ->add('latitude', NumberType::class,
                  array('attr' => array('step' => 'any')))
            ->add('dateajout', DateTimePickerType::class , 
                  array('required' => false, 'label' => 'Date', 'format' => 'dd/MM/yyyy'))
        ;
    }
}