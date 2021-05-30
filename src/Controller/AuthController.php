<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Biglietto;

class AuthController extends AbstractController
{
    /**
     * @Route("/login", name="auth")
     */
     public function auth(): Response
    {
        /*
        $indirizzi = $this->getDoctrine()
            ->getRepository(Biglietto::class)
            ->findAll();

            dd($indirizzi);
        */
        return $this->render('auth/login.html.twig');
    }

}
