<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;

class ApiKeyService
{
    /**
     * @param Request $request
     * @return bool
     */
    public function checkApiKey (Request $request): bool
    {
        $API_KEY = $request->headers->get('API-KEY');

        if ($API_KEY = strlen(42))
            $output = true;
        else
            $output = false;
        

    return $output;
    }

}