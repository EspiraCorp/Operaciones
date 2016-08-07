<?php

// src/Incentives/BaseBundle/Controller/AutenticacionController.php;
namespace Incentives\BaseBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
 
class AutenticacionController extends Controller
{
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
 
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
 
        return $this->render(
            'IncentivesBaseBundle:Autenticacion:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }
 

    public function redireccionAction()
    {
		//$user = $this->container->get('security.context')->getToken()->getUser();
		//$user1 = $this->getUser();
		//echo $user->getId(); //
		if ($this->get('security.context')->isGranted('ROLE_ADMIN')) return $this->redirect($this->generateUrl('_inicio'));
		elseif ($this->get('security.context')->isGranted('ROLE_PROV')) return $this->redirect($this->generateUrl('proveedores_datos'));
		elseif ($this->get('security.context')->isGranted('ROLE_DIR')) return $this->redirect($this->generateUrl('proveedores'));
		else return $this->redirect($this->generateUrl('_inicio'));
    }
}

