<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController //
{
    /**
     * @Route("/concert", name="concert")
     */
    public function indexAction(): Response
    {
            return $this->render('concert/index.html.twig', [
                'controller_name' => 'ConcertController',
            ]);
    }

    /**
     * Affiche une liste de concerts
     * @Route("/list", name="list")
     */
    public function listAction(): Response
    {
        return $this->render('list/bands_list.html.twig', [
            //'concerts' => ['Concert1', 'Concert2']
            'controller_name' => 'ConcertController',
        ]);
    }






}
