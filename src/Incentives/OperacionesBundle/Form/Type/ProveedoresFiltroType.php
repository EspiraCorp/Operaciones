<?php

// src/Sinaptica/OperacionesBundle/Form/Type/ProveedoresType.php
namespace Incentives\OperacionesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ProveedoresFiltroType extends AbstractType
{
    
     public $pais_id;
     public $nombre;
     public $ciudad_id;
     public $numero_documento;
     public $correo;
     public $estado_id;
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
     
     
    function __construct($filtros) {
        
        $this->pais_id = (isset($filtros['pais'])) ? $filtros['pais'] : "";
        $this->ciudad_id = (isset($filtros['ciudad'])) ? $filtros['ciudad'] : "";
        $this->nombre = (isset($filtros['nombre'])) ? $filtros['nombre'] : "";
        $this->numero_documento = (isset($filtros['numero_documento'])) ? $filtros['numero_documento'] : "";
        $this->correo = (isset($filtros['correo'])) ? $filtros['correo'] : "";
        $this->estado_id = (isset($filtros['estado'])) ? $filtros['estado'] : "";
        
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', 'text', array('data' => $this->nombre ));
        $builder->add('numero_documento', 'text', array('required' => false, 'data' => $this->numero_documento )); 
        $builder->add('registro_camara', 'text', array('required' => false )); 
        $builder->add('pais', 'entity', array(
            'class' => 'IncentivesOperacionesBundle:Pais',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'required' => false,
            'data' => $this->pais_id ,
        ));
        $builder->add('ciudad', 'entity', array(
			'class' => 'IncentivesOperacionesBundle:Ciudad',
			'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'required' => false,
            'data' => $this->ciudad_id ,
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

        $builder->add('estado', 'entity', array(
            'class' => 'IncentivesCatalogoBundle:Estados',
            'property' => 'nombre',
            'empty_value' => 'Seleccione una opcion',
            'label' => 'Estado',
            'data' => $this->estado_id,
        ));

		$builder->add('direccion', 'text', array('required' => false));
        $builder->add('telefono', 'text', array('required' => false));
        $builder->add('fax', 'text', array('required' => false));
        $builder->add('correo', 'text', array('data' => $this->correo ));


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
