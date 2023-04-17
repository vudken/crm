<?php

namespace App\Controller;

use App\Entity\Work;
use App\Form\WorkFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RepairWorksController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/repair_works', name: 'repair_works')]
    public function upload(Request $request): Response
    {
        $work = new Work();
        $form = $this->createForm(WorkFormType::class, $work);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('attachment')->getData();
            $fileName = $file->getClientOriginalName();
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            if ($fileExtension === 'xlsx' || $fileExtension === 'xls') {
                // Load the file into a PhpSpreadsheet object
                $spreadsheet = IOFactory::load($file);
                // Get the first sheet in the Excel file
                $worksheet = $spreadsheet->getActiveSheet();

                $works = [];
                foreach ($worksheet->getRowIterator(2) as $row) {
                    $entity = new Work();
                    $entity->setName($worksheet->getCell('A' . $row->getRowIndex())->getValue());
                    $entity->setAddress($worksheet->getCell('B' . $row->getRowIndex())->getValue());
                    $entity->setDescription($worksheet->getCell('C' . $row->getRowIndex())->getValue());

                    // Add the entity to the array
                    $works[] = $entity;
                }

                foreach ($works as $work) {
                    $this->em->persist($work);
                }

                $this->em->flush();
            } else {
                return $this->redirect('/');
            }

            // dd($works);
            return $this->render('success.html.twig');
        }

        return $this->render('repairWorks.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
