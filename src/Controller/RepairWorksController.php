<?php

namespace App\Controller;

use App\Entity\Work;
use App\Enum\Email;
use App\Form\WorkFormType;
use App\Service\FleetCompleteApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RepairWorksController extends AbstractController
{
    #[Route('/repair_works', name: 'repair_works')]
    public function index(): Response
    {
        $work = new Work();
        $form = $this->createForm(WorkFormType::class, $work);

        return $this->render('repairWorks.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
