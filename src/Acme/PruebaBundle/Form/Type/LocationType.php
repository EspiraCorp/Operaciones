<?php

namespace Acme\PruebaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Acme\PruebaBundle\Form\EventListener\AddCityFieldSubscriber;
use Acme\PruebaBundle\Form\EventListener\AddProvinceFieldSubscriber;
use Acme\PruebaBundle\Form\EventListener\AddCountryFieldSubscriber;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $factory = $builder->getFormFactory();
        $citySubscriber = new AddCityFieldSubscriber($factory);
        $builder->addEventSubscriber($citySubscriber);
        $provinceSubscriber = new AddProvinceFieldSubscriber($factory);
        $builder->addEventSubscriber($provinceSubscriber);
        $countrySubscriber = new AddCountryFieldSubscriber($factory);
        $builder->addEventSubscriber($countrySubscriber);

        $builder->add('address');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\PruebaBundle\Model\Location'
        ));
    }

    public function getName()
    {
        return 'location';
    }
}