<?php

namespace App\Controller;

use App\Entity\Watch;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/watch', name: 'app_api_watch')]
class ApiWatchController extends AbstractController
{

    private $entityManager;
    private $doctrine;
    private $validator;
    
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->entityManager = $doctrine->getManager();
    }

    #[Route('/show', name: 'app_api_list_show', methods:['GET'])]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $datas = $this->doctrine->getRepository(Watch::class)->findAll();
        $result = [];

        foreach($datas as $data){
            $result[] = [
                "id" => $data->getId(),
                "name" => $data->getName(),
                "shortDescription" => $data->getShortDescription(),
                "description" => $data->getDescription(),
                "price" => $data->getPrice(),
                "note" => $data->getNote(),
                "color" => $data->getColor(),
                "gps" => $data->isGps(),
                "size" => $data->getSize(),
                "bluetooth" => $data->isBluetooth(),
                "weight" => $data->getWeight(),
                "picture" => $data->getPicture(),
                "createdAt" => $data->getCreatedAt()
            ];
        }

        return $this->json([
            'data' => $result
        ]);
    }

    #[Route('/show/{id}', name: 'app_api_list_show_single', methods:['GET'])]
    public function single(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $datas = $this->doctrine->getRepository(Watch::class)->findBy(['id' => $request->get('id')]);
        $result = [];

        foreach($datas as $data){
            $result[] = [
                "id" => $data->getId(),
                "name" => $data->getName(),
                "shortDescription" => $data->getShortDescription(),
                "description" => $data->getDescription(),
                "price" => $data->getPrice(),
                "note" => $data->getNote(),
                "color" => $data->getColor(),
                "gps" => $data->isGps(),
                "size" => $data->getSize(),
                "bluetooth" => $data->isBluetooth(),
                "weight" => $data->getWeight(),
                "picture" => $data->getPicture(),
                "createdAt" => $data->getCreatedAt(),
            ];
        }

        return $this->json([
            'data' => $result
        ]);
    }

    #[Route('/new', name: 'app_api_watch_new', methods:['POST'])]
    public function new(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $watch = new Watch();
        
        $watch->setName($request->get('name'));
        $watch->setShortDescription($request->get('shortDescription'));
        $watch->setDescription($request->get('description'));
        $watch->setPrice($request->get('price'));
        $watch->setNote($request->get('note'));
        $watch->setColor($request->get('color'));
        $watch->setGps($request->get('gps'));
        $watch->setSize($request->get('size'));
        $watch->setBluetooth($request->get('bluetooth'));
        $watch->setWeight($request->get('weight'));
        $watch->setPicture($request->get('picture'));

        $errors = $validator->validate($watch);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
    
            return $this->json([
                'error' => $errorsString,
            ]);
        }else{
            $this->entityManager->persist($watch);
            $this->entityManager->flush();

            return $this->json([
                'message' => 'Add watch n°'.$watch->getId().' successfully in database !',
            ]);
        }

    }

    #[Route('/edit/{id}', name: 'app_api_watch_edit', methods: ['POST'])]
    public function edit(Request $request, Watch $watch): JsonResponse
    {
        $watch->setName($request->get('name'));
        $watch->setShortDescription($request->get('shortDescription'));
        $watch->setDescription($request->get('description'));
        $watch->setPrice($request->get('price'));
        $watch->setNote($request->get('note'));
        $watch->setColor($request->get('color'));
        $watch->setGps($request->get('gps'));
        $watch->setSize($request->get('size'));
        $watch->setBluetooth($request->get('bluetooth'));
        $watch->setWeight($request->get('weight'));
        $watch->setPicture($request->get('picture'));

        $this->entityManager->persist($watch);
        $this->entityManager->flush();


        return $this->json('Success ! Watch n°'. $watch->getId() .' is update !');
    }

    #[Route('/delete/{id}', name:'app_api_watch_delete', methods:['DELETE'])]
    public function delete(Watch $watch): JsonResponse
    {
        $this->entityManager->remove($watch);
        $this->entityManager->flush();

        return $this->json([
            'message' => 'Watch is delete !'
        ]);
    }
    
}
