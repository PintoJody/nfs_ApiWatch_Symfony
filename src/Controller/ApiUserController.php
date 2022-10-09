<?php

namespace App\Controller;


use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/api/user', name: 'app_api_user')]
class ApiUserController extends AbstractController
{
    private $entityManager;
    private $doctrine;
    private $validator;
    
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->entityManager = $doctrine->getManager();
    }

    #[Route('/registration', name: 'app_api_user_registration', methods:['POST'])]
    public function registration(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $user = new User();

        //Stock password for hash
        if ($request->isMethod('POST')) {
            $user = new User();
            $datas = json_decode($request->getContent());

            $user->setEmail($datas->email);
            $plainPassword = $datas->password;

            $user->setPassword($passwordHasher->hashPassword(
                $user,
                $plainPassword
            ));

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        
        return $this->json([
            'message' => 'User n° '.$user->getId().' create successfully !',
        ]);
    }

    #[Route('/login', name: 'app_api_user_login', methods:['POST'])]
    public function login()
    {}

    #[Route('/logout', name: 'app_api_user_logout')]
    public function logout()
    {
        return $this->json([
            'message' => 'Disconnect',
        ]);
    }
    
}
