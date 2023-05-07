<?php

namespace App\Controller;

use App\Entity\Task;
use App\Enum\Email;
use App\Service\FleetCompleteApi;
use App\Service\Util;
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
        // $emails = Email::cases();
        $fc = new FleetCompleteApi();
        // $tasks = $fc->getTasksByEmail(Email::Avd->value);
        $tasks = $fc->getTasksByEmail(Email::Comp->value);
        // $fc->getAllTasks();

        $repo =  $this->em->getRepository(Task::class);

        foreach ($tasks as $task) {
            $taskId = $task->getTaskId();
            $existingTask = $repo->findOneBy(['taskId' => $taskId]);

            if (!$existingTask) {
                $this->em->persist($task);
            }
        }

        $this->em->flush();

        // $tasks = [$repo->find(2654), $repo->find(2653)];
        // $tasks = $repo->findAll();
        // $tasks = [
        //     $repo->find(2652),
        //     $repo->find(2653),
        //     $repo->find(2654),
        // ];

        // foreach ($tasks as $task) {
        //     $ts = $task->getTimestamp();
        //     $newTs = Util::formatDate($ts);
        //     $task->setTimestamp($newTs);
        // dd($newAdress);
        // $this->em->persist($task);
        // }

        // $this->em->flush();

        // $util = new Util();
        // $tasks = array_map(fn ($task) =>
        //     // $task->setAddress(explode(",", $task->getAddress())[0]),
        //     $task = $util->formatFcTaskForView($task),
        //     $tasks
        // );

        // dd($tasks[0]);

        // return $this->render('tasks/fleetcomplete.html.twig', [
        //     'tasks' => $tasks
        // ]);

        return $this->render('tasks/fleetcomplete.html.twig');
    }
}
