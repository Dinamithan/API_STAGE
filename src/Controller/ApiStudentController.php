<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use App\Repository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class ApiStudentController extends AbstractController
{
    /**
     * @Route("/api/student",
     *  name="app_api_student"
     * ,methods={"GET"})
     */
    public function index( StudentRepository $studentRepository ): JsonResponse
    {

        $students = $studentRepository-> findAll();

        dd($students);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiStudentController.php',
        ]);
    }
    /**
     * @Route("/api/student",
     *  name="app_api_student_add"
     * ,methods={"POST"})
     */
    public function add( Request  $request, EntityManager $entityManager): JsonResponse
    {
        dd ($request->toArray());
        $dataFromRequest = $request->toArray();
        
        
        // nouvelles instances de student
        $student = new Student();
        $student->setName($dataFromRequest['name']);
        $student->setFirstName($dataFromRequest['firstname']);
        $student->setPicture($dataFromRequest['picture']);
        $student->setDateOfBirth($dataFromRequest['date_of_birth']);
        $student->setGrade($dataFromRequest['grade']);
        
        dd($student);

        // insertion en base
        
        $entityManager->persist($student );
        $entityManager->flush();
                
        return $this->json(['status'=> 'Ajout OK',]);
    }
}
