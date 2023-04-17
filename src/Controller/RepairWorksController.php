<?php

namespace App\Controller;

use App\Entity\Work;
use App\Form\WorkFormType;
use App\Service\Util;
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
                $spreadsheet = IOFactory::load($file);
                $sheet = $spreadsheet->getActiveSheet();

                $util = new Util();
                $firstRow = $sheet->getRowIterator()->current();
                $letters[] = $util->getColumnLetterByValue($firstRow, 'Address');
                $letters[] = $util->getColumnLetterByValue($firstRow, 'Description');
                $letters[] = $util->getColumnLetterByValue($firstRow, 'Material');

                $works = [];
                foreach ($sheet->getRowIterator(2) as $row) {
                    $entity = new Work();
                    $entity->setAddress($sheet->getCell($letters[0] . $row->getRowIndex())->getValue());
                    $entity->setDescription($sheet->getCell($letters[1] . $row->getRowIndex())->getValue());
                    $entity->setMaterial($sheet->getCell($letters[2] . $row->getRowIndex())->getValue());

                    $works[] = $entity;
                }

                foreach ($works as $work) {
                    $existingWork =  $this->em->getRepository(Work::class)->findOneBy([
                        'description' => $work->getDescription(),
                        'address' => $work->getAddress()
                    ]);

                    if (!$existingWork instanceof Work) {
                        $this->em->persist($work);
                    }

                    $this->em->flush();
                }

                return $this->redirect('/success');
            } else {
                return $this->redirect('/');
            }
        }

        return $this->render('repairWorks.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
