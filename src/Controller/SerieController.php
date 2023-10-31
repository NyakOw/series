<?php

namespace App\Controller;

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
    public function index(): Response
    {
        // TODO: Récupérer la liste des séries en base de données
        return $this->render('serie/index.html.twig');
    }

    /**
     * @Route("/{id}", name="serie_show", requirements={"id"="\d+"})
     */
    public function show(int $id): Response
    {
        // TODO: Récupérer en base de données la série ayant l'id $id
        return $this->render('serie/show.html.twig', [
            'id' => $id
        ]);
    }

    /**
     * @Route("/new", name="serie_new")
     */
    public function new(): Response
    {
        return $this->render('serie/new.html.twig');
    }


}
