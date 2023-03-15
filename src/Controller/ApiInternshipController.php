<?php

namespace App\Controller;

use App\Entity\Internship;
use App\Entity\Student;
use App\Repository\CompanyRepository;
use App\Repository\InternshipRepository;
use App\Repository\StudentRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiInternshipController extends AbstractController
{
    /**
     * @Route("/api/internship",
     *  name="app_api_internship"
     * ,methods={"GET"})
     */
    public function index( InternshipRepository $internshipRepository, NormalizerInterface $normalizer ): JsonResponse
    {
        $internship = $internshipRepository->findAll();

        $internshipNormalised = $normalizer->normalize($internship, 'json', 
    ['circular_reference_handler' => function ($object){
        return $object->getId();
    }]);        $json = json_encode($internship);

        dd($internshipNormalised, $json, $internship);
        
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiStudentController.php',
        ]);
    }


    /**
     * @Route("/api/internship",
     *  name="app_api_internship_add"
     * ,methods={"POST"})
     */
    public function add(StudentRepository $studentRepository, CompanyRepository $companyRepository, Request  $request, EntityManagerInterface $entityManager): JsonResponse
    {
        //dd ($request->toArray());
        $dataFromRequest = $request->toArray();
        $student = $studentRepository->find( $dataFromRequest['id_student_id'] );
        $company = $companyRepository->find( $dataFromRequest['id_company_id'] );
        
        // nouvelles instances de internship
        $internship = new Internship();
        $internship->setIdStudent( $student );
        $internship->setIdCompany( $company );
        $internship->setStartDate( new DateTime ($dataFromRequest['start_date']));
        $internship->setEndDate( new DateTime ($dataFromRequest['end_date']));


        // insertion en base
        
        $entityManager->persist($internship );
        $entityManager->flush();
        
        return $this->json(['status'=> 'Ajout OK',]);

    }



}
