<?php

namespace App\Controller;

use App\Enum\Email;
use App\Service\FleetCompleteApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends AbstractController
{
    #[Route('/tasks', name: 'tasks')]
    public function index(): Response
    {
        $emails = Email::cases();
        $fc = new FleetCompleteApi();
        $tasks = $fc->getTasksByEmail(Email::Avd->value);
        // $tasks = $fc->getAllTasks();
        // dd($tasks);

        return $this->render('tasks/index.html.twig', [
        ]);
    }
}
