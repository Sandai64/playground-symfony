<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello", name="hello")
     */
    public function index(AnimalRepository $repo) : Response
    {
        return $this->render('hello/index.html.twig', [
            'animal_list' => $repo->findAll(),
        ]);
    }
}
