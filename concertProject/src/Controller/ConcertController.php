<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\BandsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ConcertsRepository;
use App\Entity\Concerts;
use App\Form\ConcertType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/concerts")
 */
class ConcertController extends AbstractController //
{
    /**
     * @Route("/", name="concerts")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Concerts::class);

        $concert = $repository->findDateWhereDateHigheThanToday();

            return $this->render('concerts/index.html.twig', [
                'concerts' => $concert
            ]);
    }

    /**
     * Affiche la liste des concerts
     * @Route("/concerts_list", name="concerts_list")
     */
    public function concertsList(ConcertsRepository $concert): Response
    {
        $concerts = $concert->findAll();

        return $this->render('concerts/concerts_list.html.twig', [
            'concerts' => $concerts
        ]);
    }

    /**
     * Crée un nouveau concert
     *
     * @Route("/concerts/create", name="concert_create")
     * @isGranted("ROLE_ADMIN")
     */
    public function createConcert(Request $request): Response
    {
        $concert = new Concerts();

        $form = $this->createForm(ConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $concert = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            $this->addFlash('success', 'Concert crée! Music is power!');
            return $this->redirectToRoute('concerts_list');
        }

        return $this->render('concerts/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * Affiche le concert dont l'id est passé en paramètre
     * @Route("/concerts/{id}", name="show_concert")
     */
    public function concertsById(int $id, ConcertsRepository $concert): Response
    {
        $concertsById = $concert->find($id);

        return $this->render('concerts/show.html.twig', [
            'concertsById' => $concertsById,
        ]);
    }




    /**
     * Update un concert
     *
     * @Route("/concerts/edit/{id}", name="concert_edit")
     * @isGranted("ROLE_ADMIN")
     */
    public function editConcert(Request $request, Concerts $concert): Response
    {
        $form = $this->createForm(ConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $show = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            $this->addFlash('success', 'Concert update! Music is power!');
            return $this->redirectToRoute('concerts_list');
        }

        return $this->render('concerts/new.html.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * Concert has been create
     * @Route("/concerts/success", name="concert_success")
     * @isGranted("ROLE_ADMIN")
     */
    public function success(Request $request): Response
    {
        return $this->render('concerts/success.html.twig');
    }

    /**
     * Delete a concert
     * @Route("/delete/concerts/{id}", name="concert_delete")
     * @isGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Concerts $concert): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($concert);
        $entityManager->flush();

        return $this->redirectToRoute('concerts_list');
    }

    /**
     * Update a concert
     * @Route("/concerts/update/{id}", name="concert_update")
     * @isGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Concerts $concert): Response
    {

        $form = $this->createForm(ConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $show = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            return $this->redirectToRoute('concert_success');
        }

        return $this->render('concerts/new.html.twig', [
            'form' => $form->createView() ,
        ]);
    }






}
