<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\s;

/**
 * @Route("/serie")
 */
class SerieController extends AbstractController
{
    /**
     * @Route("/", name="serie_index")
     */
    public function index(SerieRepository $serieRepository): Response
    {
        // Récupérer la liste des séries en base de données
        //$series = $serieRepository->findBy([],["popularity" => "DESC", "vote" => "DESC"], 30 );
        $series = $serieRepository->findBest();


        return $this->render('serie/index.html.twig', compact('series'));
    }

    /**
     * @Route("/{id}", name="serie_show", requirements={"id"="\d+"})
     */
    public function show(int $id, SerieRepository $serieRepository): Response
    {
        // Récupérer en base de données la série ayant l'id $id
        $serie = $serieRepository->find($id);

        return $this->render('serie/show.html.twig', [
            'serie' => $serie]);
    }

    /**
     * @Route("/new", name="serie_new")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $serie = new Serie();
        $serie->setDateCreated(new \DateTime());
//        $serie->setName('Titre de la série');
        $serieForm = $this->createForm(SerieType::class, $serie);
        $serieForm->handleRequest($request);

        if ($serieForm->isSubmitted() && $serieForm->isValid()) {
            $entityManager->persist($serie);
            $entityManager->flush();

            $this->addFlash('success', 'La série est bien enregistrée');

            return $this->redirectToRoute('serie_show', ['id' => $serie->getId()]);
        }

        return $this->render('serie/new.html.twig', [
            'serieForm' => $serieForm->createView()
        ]);
    }
}
