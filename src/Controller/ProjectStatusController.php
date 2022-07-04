<?php

namespace App\Controller;

use App\Entity\ProjectStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/project_status')]
class ProjectStatusController extends ApiCrudController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->setRepository($em->getRepository(ProjectStatus::class));
    }
}