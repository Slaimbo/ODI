<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class SearchPersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {    
        $builder
            ->add('nompersonne', TextType::class, 
                    array('required' => false, 'label' => 'nom'))
            ->add('prenompersonne',TextType::class, 
                    array('required' => false, 'label' => 'prenom'))	
           ->add('email',EmailType::class, 
                    array('required' => false, 'label' => 'email'))	
            ->add('search', SubmitType::class)
        ;
    }
}