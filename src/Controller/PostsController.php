<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{
    #[Route('/posts', name: 'posts')]
    public function index(): Response
    {   
        //$posts = [];
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        
        return $this->render('posts/index.html.twig', [
            'controller_name' => 'PostsController',
            'posts' => $posts,
        ]);
    }
}
