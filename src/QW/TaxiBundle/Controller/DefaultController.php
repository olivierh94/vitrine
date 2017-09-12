<?php

namespace QW\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('QWTaxiBundle:Default:index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('QWTaxiBundle:Default:about.html.twig');
    }

    public function contactAction()
    {
        return $this->render('QWTaxiBundle:Default:contact.html.twig');
    }

    public function carsAction()
    {
        return $this->render('QWTaxiBundle:Default:cars.html.twig');
    }

    public function servicesAction()
    {
        return $this->render('QWTaxiBundle:Default:services.html.twig');
    }
}
