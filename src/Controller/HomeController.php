<?php

namespace App\Controller;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\ForgotPasswordType;

use Symfony\Component\HttpFoundation\RequestStack;

class HomeController extends AbstractController
{
    #[Route('', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/afterlogin', name: 'app_afterlogin')]
    public function logedin(): Response
    {
        return $this->render('home/afterlogin.html.twig', [     
        ]);
    }

    //ZEYED FEL LOGIN
    #[Route('/temp/login', name: 'app_temp_login')]
    public function login_tmp(UserRepository $ur, Request $request, RequestStack $rs): Response
    {
        $u = $ur->findOneBy(["login" => $request->request->get("email"), "pwd" => $request->request->get("password")]);
        if($u){
            $this->sessionSetUser($u, $rs);
            return new Response("/afterlogin");
        }
        return new Response("/");
    }

    public function sessionSetUser($user, $rs){
        $session = $rs->getSession();
        $session->set('current_user', $user);
    }
}
?>