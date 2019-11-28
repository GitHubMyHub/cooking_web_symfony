<?php

namespace App\Controller;

use App\Entity\Food;
use App\Entity\Likes;
use App\Entity\LikesMemory;
use App\Functions\Functions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{

    private $username;
    private $entriesPerPage = 15;

    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(UserInterface $user = null)
    {

        //dump($user);die;
        if(!is_null($user)){
            $this->username = $user->getUsername();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $newFoods = $entityManager->getRepository(Food::class)->findNewestFoods(['visible' => 1]);
        $veganFoods = $entityManager->getRepository(Food::class)->findBy(['visible' => 1, 'category' => 2], null, 3);
        $bakeFoods = $entityManager->getRepository(Food::class)->findBy(['visible' => 1, 'category' => 3], null, 3);

        //dump($veganFoods);die;

        return $this->render('home/index.html.twig', ["userName" => $this->username, "newFoods" => $newFoods, "veganFoods" => $veganFoods, "bakeFoods" => $bakeFoods]);
    }

    /**
     * @Route("/category/{categoryParam}", name="food_category")
     */
    public function foodCategory($categoryParam, UserInterface $user = null)
    {

        if(!is_null($user)){
            $this->username = $user->getUsername();
        }
        $entityManager = $this->getDoctrine()->getManager();

        switch($categoryParam){
            case "vegan":
                $titleParam["title"] = "Vegane Rezepte";
                $titleParam["picture"] = "carrot";
                $gesamt = $entityManager->getRepository(Food::class)->findBy(['visible' => 1, 'category' => 2]);
                $pages = Functions::getSeitenGesamt(count($gesamt), $this->entriesPerPage);

                $food = $entityManager->getRepository(Food::class)->findBy(['visible' => 1, 'category' => 2], ['id' => 'DESC'], $this->entriesPerPage, 0);
            break;
            case "bakery":
                $titleParam["title"] = "Back Rezepte";
                $titleParam["picture"] = "cake";
                $gesamt = $entityManager->getRepository(Food::class)->findBy(['visible' => 1, 'category' => 3]);
                $pages = Functions::getSeitenGesamt(count($gesamt), $this->entriesPerPage);

                $food = $entityManager->getRepository(Food::class)->findBy(['visible' => 1, 'category' => 3], ['id' => 'DESC'], $this->entriesPerPage, 0);
            break;
            default:
                $titleParam["title"] = "Neue Rezepte";
                $titleParam["picture"] = "recipe";
                $gesamt = $entityManager->getRepository(Food::class)->findNewestFoods(['visible' => 1]);
                $pages = Functions::getSeitenGesamt(count($gesamt), $this->entriesPerPage);

                $food = $entityManager->getRepository(Food::class)->findBy(['visible' => 1], ['id' => 'DESC'], $this->entriesPerPage, 0);
            break;
        }

        //dump($gesamt);die;
        //dump($titleParam);die;

        return $this->render('home/view_list_foods.html.twig', ["userName" => $this->username, "category" => $categoryParam, "titleParams" => $titleParam, 'page' => 1, 'pages' => $pages, 'foods' => $food]);
    }

    /**
     * @Route("/category/{categoryParam}/{page}", name="food_category_page")
     */
    public function foodCategoryPage($categoryParam, $page, UserInterface $user = null)
    {
        if(!is_null($user)){
            $this->username = $user->getUsername();
        }
        $entityManager = $this->getDoctrine()->getManager();

        switch($categoryParam){
            case "vegan":
                $titleParam["title"] = "Vegane Rezepte";
                $titleParam["picture"] = "carrot";
                $gesamt = $entityManager->getRepository(Food::class)->findBy(['visible' => 1, 'category' => 2]);

                $pages = Functions::getSeitenGesamt(count($gesamt), $this->entriesPerPage);
                $offset = Functions::getOffset($page);

                $food = $entityManager->getRepository(Food::class)->findBy(['visible' => 1, 'category' => 2], ['id' => 'DESC'], $this->entriesPerPage, $offset);
            break;
            case "bakery":
                $titleParam["title"] = "Back Rezepte";
                $titleParam["picture"] = "cake";
                $gesamt = $entityManager->getRepository(Food::class)->findBy(['visible' => 1, 'category' => 3]);

                $pages = Functions::getSeitenGesamt(count($gesamt), $this->entriesPerPage);
                $offset = Functions::getOffset($page);

                $food = $entityManager->getRepository(Food::class)->findBy(['visible' => 1, 'category' => 3], ['id' => 'DESC'], $this->entriesPerPage, $offset);
            break;
            default:
                $titleParam["title"] = "Neue Rezepte";
                $titleParam["picture"] = "recipe";
                $gesamt = $entityManager->getRepository(Food::class)->findNewestFoods(['visible' => 1]);

                $pages = Functions::getSeitenGesamt(count($gesamt), $this->entriesPerPage);
                $offset = Functions::getOffset($page);

                $food = $entityManager->getRepository(Food::class)->findBy(['visible' => 1], ['id' => 'DESC'], $this->entriesPerPage, $offset);
            break;
        }

        return $this->render('home/view_list_foods.html.twig', ["userName" => $this->username, "category" => $categoryParam, "titleParams" => $titleParam, 'page' => $page, 'pages' => $pages, 'foods' => $food]);
    }

    /**
     * @Route("/food/{id}", name="food_item")
     */
    public function food($id, UserInterface $user = null)
    {
        if(!is_null($user)){
            $this->username = $user->getUsername();
        }

        $entityManager = $this->getDoctrine()->getManager();
        //$food = $entityManager->getRepository(Food::class)->findOneBy(['id' => $id]);
        $food = $entityManager->getRepository(Food::class)->findFoodItem($id);
        //dump($food);die;

        return $this->render('home/view_list_food.html.twig', ["userName" => $this->username, "food" => $food]);
    }

    /**
     * @Route("/foodsearch/{term}", name="food_search")
     */
    public function basicFoodSearch($term, UserInterface $user = null)
    {
        if(!is_null($user)){
            $this->username = $user->getUsername();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $gesamt = $entityManager->getRepository(Food::class)->findByNameOffset($term);

        $pages = Functions::getSeitenGesamt(count($gesamt), $this->entriesPerPage);

        $foods = $entityManager->getRepository(Food::class)->findByNameOffset($term, $this->entriesPerPage, 0);

        //dump($foods);die;

        return $this->render('home/view_list_search_foods.html.twig', ["userName" => $this->username, "searchTerm" => $term, 'page' => 1, 'pages' => $pages, "foods" => $foods]);
    }

    /**
     * @Route("/foodsearch/{term}/{page}", name="food_search_page")
     */
    public function basicFoodSearchPage($term, $page, UserInterface $user = null)
    {
        if(!is_null($user)){
            $this->username = $user->getUsername();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $gesamt = $entityManager->getRepository(Food::class)->findByNameOffset($term);

        $pages = Functions::getSeitenGesamt(count($gesamt), $this->entriesPerPage);
        $offset = Functions::getOffset($page);

        $foods = $entityManager->getRepository(Food::class)->findByNameOffset($term, $this->entriesPerPage, $offset);

        //dump($foods);die;

        return $this->render('home/view_list_search_foods.html.twig', ["userName" => $this->username, "searchTerm" => $term, 'page' => $page, 'pages' => $pages, "foods" => $foods]);
    }

    /**
     * @Rest\View()
     */
    public function foodSearch($term)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $foods = $entityManager->getRepository(Food::class)->findFoods($term);

        return $foods;
    }

    /**
     * @Rest\View()
     */
    public function setLikes(Request $request)
    {        

        $foodId = preg_replace("/http:\/\/food.com\/food\//", "", $request->server->get("HTTP_REFERER"));
        //dump($foodId);die;
        
        $entityManager = $this->getDoctrine()->getManager();
        $likesMemory = $entityManager->getRepository(LikesMemory::class)->findOneBy(["foodId" => $foodId, "ip" => $request->server->get("REMOTE_ADDR")]);
        //dump($likesMemory);die;
        if(!$likesMemory){
            //dump("Nothing");die;
            // Save IP and Food ID in Table
            $likeInMemory = new LikesMemory();
            $likeInMemory->setFoodId($foodId);
            $likeInMemory->setIp($request->server->get("REMOTE_ADDR"));
            $entityManager->persist($likeInMemory);
            $entityManager->flush();

            $likes = $entityManager->getRepository(Likes::class)->findOneBy(["foodId" => $foodId]);
            //dump($likes);die;
            if(!$likes){
                $newLike = new Likes();
                $newLike->setFoodId($foodId);
                $newLike->setFoodLike(1);
                $entityManager->persist($newLike);
                $entityManager->flush();
                return $newLike;
            }
            return $likes;

        }else{
            $likes = $entityManager->getRepository(Likes::class)->findOneBy(["foodId" => $foodId]);
            return $likes;
        }
        
        //dump($likesMemory);die;
        //dump($request->server->get("REMOTE_ADDR"));die;

    }

}
