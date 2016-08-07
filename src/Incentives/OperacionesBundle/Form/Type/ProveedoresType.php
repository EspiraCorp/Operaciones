<?php

// src/Sinaptica/OperacionesBundle/Form/Type/ProveedoresType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Incentives\OperacionesBundle\Form\EventListener\AddContactoFieldSubscriber;
use Incentives\OperacionesBundle\Form\EventListener\AddAeconomicaFieldSubscriber;

class ProveedoresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre');
        $builder->add('tipodocumento', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Tipodocumento',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Tipo de Documento',
        ));
        $builder->add('numero_documento', 'text'); 
        $builder->add('registro_camara', 'text', array('required' => false)); 
        $builder->add('regimen', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Regimen',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'required' => false
        ));
        $builder->add('sede_principal', 'text', array('required' => false)); 

        $builder->add('pais', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Pais',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'required' => false
        ));
        $builder->add('ciudad', 'entity', array(
			'class' => 'IncentivesOperacionesBundle:Ciudad',
			'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'required' => false
		));
        $builder->add('categoria', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Categoria',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'required' => false
        ));

        $builder->add('proveedortipo', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:ProveedoresTipo',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Tipo'
        ));

        $builder->add('proveedorclasificacion', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:ProveedoresClasificacion',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Clasificacion'
        ));
		$builder->add('proveedorarea', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:ProveedoresArea',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Area'
        ));
		$builder->add('directo');
		$builder->add('direccion', 'text', array('required' => false));
        $builder->add('telefono', 'text', array('required' => false));
        $builder->add('correo');
        $builder->add('pagina', 'text', array('required' => false));
        // $builder->add('aeconomica', 'collection', array(
        //         'type'  => new AeconomicaType(),
        //         'label'          => 'Actividad economica',
        //         'by_reference'   => false,
        //         //'prototype_data' => new Address(),
        //         'allow_delete'   => true,
        //         'allow_add'      => true
        // ));
        $builder->add('sedes', 'checkbox', array('required' => false));
        $builder->add('datos_sedes', 'textarea', array('required' => false));
        $builder->add('tiempo_entrega', 'integer', array('required' => false));
        $builder->add('lineaAtencion', 'text', array('required' => false));

        //Como collection solo si el resto ya esta creado
        //$builder->addEventSubscriber(new AddAeconomicaFieldSubscriber());				
		//Como collection y evento, solo la primera vez
        $builder->addEventSubscriber(new AddContactoFieldSubscriber());
		// $builder->add('contactos', 'collection', array(
		// 		'type' 	=> new ContactoType(),
  //               'label'          => 'Contactos',
  //               'by_reference'   => true,
  //               //'prototype_data' => new Contacto(),
  //               'allow_delete'   => true,
  //               'allow_add'      => true
		// ));
         $builder->add('Enviar', 'submit');

    }
 
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\Proveedores'
        );
    }

    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Incentives\OperacionesBundle\Entity\Proveedores',
            'cascade_validation' => true,
            'validation_groups' => array('registro')
        ));
    }

    public function getName()
    {
        return 'proveedores';
    }
}
