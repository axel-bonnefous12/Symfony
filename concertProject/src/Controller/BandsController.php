<?php

namespace App\Controller;

use App\Entity\Bands;
use App\Form\BandsType;
use App\Repository\BandsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/bands")
 */
class BandsController extends AbstractController
{
    /**
     * @Route("/", name="bands_index", methods={"GET"})
     */
    public function index(BandsRepository $bandsRepository): Response
    {
        return $this->render('bands/index.html.twig', [
            'bands' => $bandsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bands_new", methods={"GET", "POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $band = new Bands();
        $form = $this->createForm(BandsType::class, $band);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($band);
            $entityManager->flush();

            return $this->redirectToRoute('bands_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bands/new.html.twig', [
            'band' => $band,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bands_show", methods={"GET"})
     */
    public function show(Bands $band): Response
    {
        return $this->render('bands/show.html.twig', [
            'band' => $band,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bands_edit", methods={"GET", "POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Bands $band, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BandsType::class, $band);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('bands_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bands/edit.html.twig', [
            'band' => $band,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bands_delete", methods={"POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Bands $band, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$band->getId(), $request->request->get('_token'))) {
            $entityManager->remove($band);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bands_index', [], Response::HTTP_SEE_OTHER);
    }
}
