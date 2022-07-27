<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Report;

class SearchForm extends AbstractType
{
    public function __construct(private ManagerRegistry $doctrine) {}

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $places = $this->doctrine->getRepository(Report::class)->findAllPlaces();

        $placesOption = array_merge(['Wszystkie' => 'Wszystkie'],$places);

        $builder
            ->add('place', ChoiceType::class, [
            'label' =>'Lokal:',
            'choices'  => $placesOption,
            ])
            ->add('date_start', DateTimeType::class,[
                'required'   => false,
                'widget' => 'single_text',
                'input_format' => 'Y-m-d H:i:s',
                'html5' => true,
                'label' =>'Od:',

            ])
            ->add('date_end', DateTimeType::class,[
                'required'   => false,
                'widget' => 'single_text',
                'input_format' => 'Y-m-d H:i:s',
                'html5' => true,
                'label' =>'Do:',

            ])
            ->add('submit', SubmitType::class,[
                'label' =>'Zatwierdź'
            ])
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}

