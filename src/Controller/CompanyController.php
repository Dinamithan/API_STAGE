<?php

namespace App\Controller;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use App\Service\ApiKeyService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CompanyController extends AbstractController
{

    /**
     * @Route("/api/company",
     *  name="app_api_company"
     * ,methods={"GET"})
     */
    public function index( CompanyRepository $companyRepository, NormalizerInterface $normalizer, Request $request, ApiKeyService $apiKeyService ): JsonResponse
    {

        $authorized = $apiKeyService->checkApiKey($request);
        if($authorized == true)
        {

        $companys = $companyRepository->findAll();

        $companysNormalised = $normalizer->normalize($companys, 'json', 
    ['circular_reference_handler' => function ($object){
        return $object->getId();
    }]);        $json = json_encode($companys);


        dd($companysNormalised, $json, $companys);
        
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiStudentController.php',
        ]);
    }else{
        return $this->json(['Mauvaise clé API.']);
    }
    }

        /**
     * @Route("/api/company",
     *  name="app_api_company_add"
     * ,methods={"POST"})
     */
    public function add( Request  $request, EntityManagerInterface $entityManager, ApiKeyService $apiKeyService): JsonResponse
    {
        $authorized = $apiKeyService->checkApiKey($request);

        if($authorized == true)
        {
        //dd ($request->toArray());
        $dataFromRequest = $request->toArray();
        
        
        // nouvelles instances de student
        $company = new Company();
        $company->setName($dataFromRequest['name']);
        $company->setStreet($dataFromRequest['street']);
        $company->setZipcode($dataFromRequest['zipcode']);
        $company->setCity($dataFromRequest['city']);
        $company->setWebsite($dataFromRequest['website']);

        
        
        // insertion en base
        
        $entityManager->persist($company);
        $entityManager->flush();
        
        return $this->json(['status'=> 'Ajout OK',]);
        }else{
            return $this->json(['Mauvaise clé API.']);

        }
    }


}
