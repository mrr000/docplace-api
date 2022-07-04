<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

abstract class ApiCrudController extends AbstractController
{
    private $repository;

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param mixed $repository
     * @return ApiCrudController
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }

    #[Route('/', methods: ['GET'])]
    public function search()
    {
        return new JsonResponse($this->repository->findAll());
    }

    #[Route('/{id}', methods: ['GET'])]
    public function details(int $id)
    {
        return new JsonResponse($this->repository->find($id));
    }

    #[Route('/', methods: ['POST'])]
    public function create(int $id)
    {
        return new JsonResponse($this->repository->find($id));
    }

    #[Route('/{id}', methods: ['PATCH'])]
    public function update(int $id)
    {
        return new JsonResponse($this->repository->find($id));
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id)
    {
        return new JsonResponse($this->repository->find($id));
    }
}