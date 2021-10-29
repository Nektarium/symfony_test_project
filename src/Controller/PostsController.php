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

    #[Route('/add', name: 'add')]
    public function add(): Response
    {
        $post = new Post();
        //dd($post);

        return $this->render('posts/add.html.twig', [

        ]);
    }

    #[Route('/show', name: 'show')]
    public function show(): Response
    {
        return $this->render('posts/show.html.twig', [

        ]);
    }

    #[Route('/edit', name: 'edit')]
    public function edit(): Response
    {
        return $this->render('posts/edit.html.twig', [

        ]);
    }
}
