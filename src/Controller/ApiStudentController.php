<?php

namespace App\Controller;


use App\Entity\Student;
use App\Repository\StudentRepository;
use App\Repository;
use App\Service\ApiKeyService;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ApiStudentController extends AbstractController
{

    /**
     * @Route("/api/student",
     *  name="app_api_student"
     * ,methods={"GET"})
     */
    public function index( StudentRepository $studentRepository, NormalizerInterface $normalizer, ApiKeyService $apikeyservice, Request $request): JsonResponse
    {
        $authorized = $apikeyservice->checkApiKey($request);
        if($authorized == true)
        {

        $students = $studentRepository-> findAll();
        
        
        $studentsNormalised = $normalizer->normalize($students, 'json', 
    ['circular_reference_handler' => function ($object){
        return $object->getId();
    }]);
        
        $json = json_encode($students);
        
        dd($students, $json, $studentsNormalised);
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiStudentController.php',
        ]);
        }
        else{
            return $this->json(['Mauvaise clé API.']);
            
        }
    
    }
    /**
     * @Route("/api/student",
     *  name="app_api_student_add"
     * ,methods={"POST"})
     */
    public function add( Request  $request, EntityManagerInterface $entityManager, ApiKeyService $apiKeyService): JsonResponse
    {

        $authorized = $apiKeyService->checkApiKey($request);

        if ($authorized == true)
        {
    
        //dd ($request->toArray());
        $dataFromRequest = $request->toArray();
        
        
        // nouvelles instances de student
        $student = new Student();
        $student->setName($dataFromRequest['name']);
        $student->setFirstName($dataFromRequest['firstname']);
        $student->setPicture($dataFromRequest['picture']);
        $student->setDateOfBirth( new DateTime ($dataFromRequest['date_of_birth']));
        $student->setGrade($dataFromRequest['grade']);
        
        
        // insertion en base
        
        $entityManager->persist($student );
        $entityManager->flush();
        
        return $this->json(['status'=> 'Ajout OK',]);
        }else{
            return $this->json(['Mauvaise clé API.']);
        }
    }

    
}
