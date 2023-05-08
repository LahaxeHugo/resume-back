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
use App\Repository\ProjectRepository;

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
        $jsonObject = $this->defaultSerialize([
            'site_details' => $this->remapOuput($siteDetailRepository->findBy(['type' => 'site'])),
            'skills' => $skillRepository->findAll(),
            'diplomas' => $diplomaRepository->findAll(),
            'experiences' => $experienceRepository->findAll()
        ]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    #[Route('/contact', name: 'api_contact')]
    public function contact(SiteDetailRepository $siteDetailRepository): Response {
        $jsonObject = $this->defaultSerialize([$this->remapOuput($siteDetailRepository->findBy(['type' => 'contact']))]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    #[Route('/project', name: 'api_project')]
    public function project(ProjectRepository $projectRepository): Response {
        $jsonObject = $this->defaultSerialize([$this->remapOuput($projectRepository->findAll())]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    private function defaultSerialize($array) {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()]; 
        $serializer = new Serializer($normalizers, $encoders);

        return $this->serializer->serialize(
            $array, 
            'json', 
            ['circular_reference_handler' => function ($object) {return $object->getId(); }
        ]);
    }

    private function remapOuput($array) {
        if(!count($array)) return $array;
        $out = [];
        foreach($array as $item) $out[$item->getName()] = $item->getValue();
        return $out;
    }
}