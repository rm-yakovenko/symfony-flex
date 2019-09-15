<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Spec\PostSpec;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(PostRepository $postRepository)
    {
        $latestPosts = $postRepository->match(PostSpec::active());

        return $this->render('default/index.html.twig', compact('latestPosts'));
    }
}
