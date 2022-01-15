<?php


namespace App\Controller;


use App\Entity\Bands;
use App\Repository\ArtistsRepository;
use App\Repository\BandsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BandController extends AbstractController
{

    /**
     * Affiche la liste des groupes
     * @Route("/bands_list", name="bands_list")
     */
    public function bandsListAction(BandsRepository $band): Response
    {
        $bands = $band->findAll();

        return $this->render('bands/bands_list.html.twig', [
            //'concerts' => ['Concert1', 'Concert2']
            'bands' => $bands,
        ]);
    }

    /**
     * Affiche le groupe dont l'id est passé en paramètre
     * @Route("/bands/{id}", name="bands_show")
     */
    public function bandsByIdAction(int $id, BandsRepository $band): Response
    {
        $bandsById = $band->find($id);

        return $this->render('bands/show.html.twig', [
            //'concerts' => ['Concert1', 'Concert2']
            'bandsById' => $bandsById,


        ]);
    }
}