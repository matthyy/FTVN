<?php

namespace AppBundle\Controller\API;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ApiArticleController extends Controller
{

    /**
     * @Route("/articles", name="api_articles")
     * @Method({"GET"})   
     */

    public function articlesAction()
    {

        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository("AppBundle:Article");
        $articles = $articleRepository->findAll();

        $articlesArray = $this->extractArticles($articles);

        return new JsonResponse($articlesArray, 200);
    }

    /**
    * @Route("/articles/{id}", name="api_detail_article", requirements={"id" = "\d+"})
    * @Method({"GET"})
    */

    public function getArticleAction(Article $article)
    {

        if (!$article) {
            throw new Exception("Error Processing Request", 1);
            
        }

        $arr = $this->convertArticleToArray($article);
        return new JsonResponse($arr, 200);
    }

    /**
     * @Route("/articles", name="api_create_article")
     * @Method("POST")
     */

    public function createArticleAction(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(ArticleType::class);
        $form->submit($data);
        $article = $form->getData();
               
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        $arr = $this->convertArticleToArray($article);

        // return new JsonResponse($data);

        $response = new JsonResponse($arr, 201);

        $articleUrl = $this->generateUrl(
            'api_detail_article',
            ['id' => $article->getId()]
        );
        $response->headers->set('Location', $articleUrl); 
        return $response;
    
    }

    /**
    * @Route("/articles/{id}", name="api_delete_article", requirements={"id" = "\d+"})
    * @Method({"DELETE"})
    */

    public function deleteArticleAction($id)
    {
            
        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository("AppBundle:Article");
        $article = $articleRepository->findOneBy(array('id' => $id));
    
        if($article)
        { 
            $em->remove($article);
            $em->flush();
            return new Response(null,204);
         }

    }



    private function extractArticles($articles)
    {
        $arr["articles"]= [];
        
        foreach ($articles as $article) {
            $arr["articles"][] = array(
                'id' => $article->getId(),
                'title' => $article->gettitle(),
                'leading'=> $article->getLeadingg(),
                'body' => $article->getBody(),
                'createdAt' => $article->getCreatedAt(),
                'slug' => $article->getSLug(),
                'createdBy'=> $article->getCreatedBy());
        }

        return $arr;

    }

    private function convertArticleToArray(Article $article)
    {
       $arr["articles"] = array(
            'id' => $article->getId(),
            'title' => $article->gettitle(),
            'leading'=> $article->getLeadingg(),
            'body' => $article->getBody(),
            'createdAt' => $article->getCreatedAt(),
            'slug' => $article->getSLug(),
            'createdBy'=> $article->getCreatedBy()
            );
       return $arr;
    }
}
