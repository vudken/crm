<?php

namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/tasks_fc', name: 'tasks_fc')]
    public function index(): Response
    {
        $repo =  $this->em->getRepository(Task::class);
        $tasks = $repo->findAll();

        return $this->render('tasks/fleetcomplete.html.twig', [
            'tasks' => $tasks
        ]);
    }
}
