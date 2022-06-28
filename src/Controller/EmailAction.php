<?php
namespace App\Controller;

use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailAction extends AbstractController
{
  public function __invoke(Request $request,UserRepository $userRepository,EntityManagerInterface $entityManager)
  {
    $token=$request->get('token');
    $user=$userRepository->findOneBy(['token'=>$token]);
    if(!$user){
        return new JsonResponse(['token'=>'token invalid'],Response::HTTP_BAD_REQUEST);
    }
    if($user->isIsActivated()){
        return new JsonResponse(['token'=>'token invalid'],Response::HTTP_BAD_REQUEST);
    }
    if($user->getExpireAt()<new \DateTime()){
        return new JsonResponse(['token'=>'token invalid'],Response::HTTP_BAD_REQUEST);
    }
    $user->setIsActivated(1);
    $entityManager->flush();
    return new JsonResponse(['message'=>'Votre compte a ete activive avec succes']);
  }
}
?>