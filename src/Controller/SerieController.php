<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function show(int $id,SerieRepository $serieRepository): Response
    {
        // Récupérer en base de données la série ayant l'id $id
        $serie = $serieRepository->find($id);

        return $this->render('serie/show.html.twig', compact('serie'));
    }

    /**
     * @Route("/new", name="serie_new")
     */
    public function new(): Response
    {
        return $this->render('serie/new.html.twig');
    }


}
