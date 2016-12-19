<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
    public function homeAction(Request $request, $message)
    {
        $data = array('msg' => $message,
                      'nav' => $request->server->get('HTTP_USER_AGENT'));
        return $this->render('default/home.html.twig', $data);
    }
}
