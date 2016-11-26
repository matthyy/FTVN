<?php

namespace AppBundle\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class WebArticleController extends Controller
{
    /**
    * @Route("/", name="home")
    */

    public function homeAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$articleRepository = $em->getRepository("AppBundle:Article");

    	$articles = $articleRepository->findAll();

    	return $this->render('AppBundle:FTVN:index.html.twig', array('articles' => $articles));
    }

    /**
    * @Route("/article.{slug}", name="article_slug")
    */

    public function articleSlugAction(Article $article, Request $request)
    {

    	return $this->render('AppBundle:FTVN:article.html.twig',array('article' => $article));

    }

    /**
    * @Route("/creer", name="create_article")
    */

    public function createArticleAction(Request $request)
    {

    	$form = $this->createForm(ArticleType::class);
        $form->handleRequest($request);
    	if($form->isSubmitted() && $request->getMethod("POST"))
    	{
            $article = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
    		$em->flush();

    		return $this->redirectToRoute("home");
    	}

 	   	return $this->render('AppBundle:FTVN:create.html.twig', array('form'=> $form->createView()));
    }

    /**
    * @Route("/supprimer/{id}", name="supprimer_article")
    */

    public function supprimerArticleAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}