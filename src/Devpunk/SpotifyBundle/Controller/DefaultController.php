<?php

namespace Devpunk\SpotifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DevpunkSpotifyBundle:Default:index.html.twig');
    }
}
