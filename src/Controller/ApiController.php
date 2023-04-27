<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use App\Repository\SiteDetailRepository;
use App\Repository\SkillRepository;
use App\Repository\DiplomaRepository;
use App\Repository\ExperienceRepository;

class ApiController extends AbstractController
{

    private $serializer;

    public function __construct(SerializerInterface $serializer) {
        $this->serializer = $serializer;
    }
    
    #[Route('/home', name: 'api_home')]
    public function home(
        SiteDetailRepository $siteDetailRepository,
        SkillRepository $skillRepository,
        DiplomaRepository $diplomaRepository,
        ExperienceRepository $experienceRepository
    ): Response {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()]; 
        $serializer = new Serializer($normalizers, $encoders);

        $jsonObject = $this->serializer->serialize(
            [
                'site_details' => $siteDetailRepository->findBy(['type' => 'site']),
                'skills' => $skillRepository->findAll(),
                'diplomas' => $diplomaRepository->findAll(),
                'experiences' => $experienceRepository->findAll()
            ], 
            'json', 
            ['circular_reference_handler' => function ($object) {return $object->getId(); }
        ]);

        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }
}