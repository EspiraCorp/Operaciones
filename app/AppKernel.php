<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Incentives\OperacionesBundle\IncentivesOperacionesBundle(),
            new Incentives\BaseBundle\IncentivesBaseBundle(),
            new Incentives\CatalogoBundle\IncentivesCatalogoBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Incentives\RedencionesBundle\IncentivesRedencionesBundle(),
            new Incentives\InventarioBundle\IncentivesInventarioBundle(),
            new Incentives\ServiciosBundle\IncentivesServiciosBundle(),
            new Incentives\GarantiasBundle\IncentivesGarantiasBundle(),
            new Incentives\FacturacionBundle\IncentivesFacturacionBundle(),
            new Incentives\OrdenesBundle\IncentivesOrdenesBundle(),
            new BG\BarcodeBundle\BarcodeBundle(),
            new Incentives\SolicitudesBundle\IncentivesSolicitudesBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            //$bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
