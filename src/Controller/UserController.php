<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    #[Route('/user/login', methods: ['POST'])]
    public function login(): Response
    {
        $number = random_int(0, 100);

        return new JsonResponse([
            'number' => $number
        ]);
    }

    #[Route('/user/{id}', methods: ['GET'])]
    public function details(int $id): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky nu2mber: '.$number.'</body></html>'
        );
    }
}