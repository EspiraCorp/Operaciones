<?php

namespace Acme\PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Acme\PruebaBundle\Model\Location;
use Acme\PruebaBundle\Form\Type\LocationType;
use Acme\PruebaBundle\Entity\City;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmePruebaBundle:Default:index.html.twig', array('name' => $name));
    }

    public function pruebaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cities = $em->getRepository("PruebaBundle:City")->findAll();

        return array(
            'cities' => $cities
        );
    }

    public function newLocationAction(Request $request)
    {
        $location = new Location();
        $form = $this->createForm(new LocationType(), $location);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {

                // do amazing things

                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('smtc_success', 'Se ha creado una localización:');
                $flashBag->add('smtc_success', sprintf('Dirección: %s', $location->address));
                $flashBag->add('smtc_success', sprintf('Ciudad: %s', $location->city->getName()));

                return $this->redirect($this->generateUrl('acme_dependent_selects'));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    public function editLocationAction(City $city)
    {
        $location = new Location();
        $location->address = sprintf("Calle X número %d", rand(1,100));
        $location->city = $city;
        $form = $this->createForm(new LocationType(), $location);

        $request = $this->getRequest();

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {

                // do amazing things

                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('smtc_success', 'Se ha editado una localización:');
                $flashBag->add('smtc_success', sprintf('Dirección: %s', $location->address));
                $flashBag->add('smtc_success', sprintf('Ciudad: %s', $location->city->getName()));

                return $this->redirect($this->generateUrl('acme_dependent_selects'));
            }
        }

        return array(
            'form' => $form->createView(),
            'city' => $city
        );
    }
}