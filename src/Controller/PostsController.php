<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{   
    #[Route('/posts', name: 'posts')]
    public function index(): Response
    {   
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        
        return $this->render('posts/index.html.twig', [
            'controller_name' => 'PostsController',
            'posts' => $posts,
        ]);
    }

    #[Route('/create', name: 'create')]
    public function add(Request $request): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('create'),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }

        return $this->redirectToRoute('posts');
    }

    #[Route('/add', name: 'add')]
    public function create(): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('create'),
        ]);

        return $this->render('posts/add.html.twig', [
            'post_form' => $form->createView(),
        ]);
    }

    #[Route('/show/{id}', name: 'show')]
    public function show(Post $post): Response
    {
        return $this->render('posts/show.html.twig', [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
        ]);
    }

    #[Route('/update/{id}', name: 'update')]
    public function edit(Post $post, Request $request): Response
    {
        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('update', ['id' => $post->getId()]),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }

        return $this->redirectToRoute('posts');
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function update(Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('update', ['id' => $post->getId()]),
        ]);

        return $this->render('posts/edit.html.twig', [
            'post_form' => $form->createView(),
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Post $post): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('posts');
    }
}
