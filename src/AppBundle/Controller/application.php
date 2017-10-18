<?php
/**
 * Created by PhpStorm.
 * User: pobodoq
 * Date: 9/28/2017
 * Time: 12:08 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class application extends controller
{
    /**
     * @Route("program")
     */
    public function application(){
        return $this->render('/application/application.html.twig', []);
    }

    /**
     * @Route("program/izvjestaj")
     */
    public function report(){
        return $this->render('/application/report.html.twig', []);
    }


}