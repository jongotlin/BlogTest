<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $usernameAndLoginCounts = $this->entityManager->getRepository(User::class)->getAggregatedLoginStatistics();

        return $this->render('admin/index.html.twig', [
            'usernameAndLoginCounts' => $usernameAndLoginCounts,
        ]);
    }
}
