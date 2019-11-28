<?php

namespace App\Controller;

use App\Entity\Food;
use App\Functions\Functions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\DateTime;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class SecurityController extends AbstractController
{
    private $entriesPerPage = 15;

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        //("<h1>Test</h1>");die;

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        //return $this->render('security/login.html.twig', ['settings' => $this->settings, 'last_username' => $lastUsername, 'error' => $error]);
        return $this->render('login/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        return $this->redirectToRoute('list_overview');
    }

    /**
    * @Route("/logout", name="security_logout")
    */
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin(AuthorizationCheckerInterface $authChecker){

        return $this->render('login/view_list_dashboard.html.twig');

    }

    /**
     * @Route("/login", name="page_intro")
     */
    public function test(AuthenticationUtils $authenticationUtils){

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);

    }

    /**
     * @Route("/admin/list_overview/", name="list_overview")
     */
    public function adminListOverview(){

        $entityManager = $this->getDoctrine()->getManager();

        $gesamt = $entityManager->getRepository(Food::class)->findAllByOffset([], ['id' => 'DESC']);
        //dump($gesamt);die;

        $pages = Functions::getSeitenGesamt(count($gesamt), $this->entriesPerPage);

        $foods = $entityManager->getRepository(Food::class)->findAllByOffset([], ['id' => 'DESC'], $this->entriesPerPage, 0);
        //dump($foods);die;

        return $this->render('login/view_list_foods.html.twig', ['page' => 1, 'pages' => $pages, 'foods' => $foods]);

    }

    /**
     * @Route("/admin/list_overview/{page}", name="list_overview_page")
     */
    public function adminListOverviewPage($page){

        $entityManager = $this->getDoctrine()->getManager();

        $gesamt = $entityManager->getRepository(Food::class)->findAllByOffset([], ['id' => 'DESC']);

        $pages = Functions::getSeitenGesamt(count($gesamt), $this->entriesPerPage);
        $offset = Functions::getOffset($page);

        $food = $entityManager->getRepository(Food::class)->findAllByOffset([], ['id' => 'DESC'], $this->entriesPerPage, $offset);
        //dump($food);die;

        return $this->render('login/view_list_foods.html.twig', ['page' => $page, 'pages' => $pages, 'foods' => $food]);

    }

    /**
     * @Route(path="/admin/food_edit/{id}", name="food_edit")
     */
    public function editFood(Request $request, $id){

        //$foods = $this->getDoctrine()->getRepository(Food::class)->findOneBy(['id' => $id], ['id' => 'DESC']);

        if(intval($request->request->get('edit')) == 1){

            //dump(new \DateTime());die;

            //$date = new \DateTime($request->request->get('creationDate'));
            $date = new \DateTime();

            if(is_null($request->files->get('picture'))){
                $fileName = $request->request->get('picture-name');
                //dump($fileName);die;
            } else {
                $fileName = Functions::getArticleName($request->request->get('foodName')) . "." . substr($request->files->get('picture')->getClientOriginalName(), -3);
                //dump($fileName);die;
                $file = $request->files->get('picture');
                $uploads_directory = 'content/' . $id;

                //dump($fileName);die;

                $file->move(
                    $uploads_directory,
                    $fileName
                );

            }

            $entityManager = $this->getDoctrine()->getManager();
            $food = $entityManager->getRepository(Food::class)->findOneBy(['id' => $id]);

            $food->setName($request->request->get('foodName'));
            $food->setDescription($request->request->get('description'));
            $food->setDescription2($request->request->get('description2'));
            $food->setDuration($request->request->get('duration'));
            $food->setPictureName($id . "/" . $fileName);
            $food->setCreationDate($date);
            $food->setVisible(intval($request->request->get('visible')));

            //dump($food);die;

            if (!$food) {
                throw $this->createNotFoundException(
                    'No Food found for id '.$id
                );
            }

            $entityManager->flush();

            return $this->redirectToRoute('food_edit', ['id' => $id]);

        }

        $food = $this->getDoctrine()->getRepository(Food::class)->findOneBy(['id' => $id]);


        //dump($food);die;
        return $this->render('login/view_edit_food.html.twig', ['food' => $food]);
    }

    /**
     * @Route("/admin/food_new/", name="food_new")
     */
    public function new(Request $request){

        //dump($request);die;
        //dump($request->request->get('save'));die;

        if(intval($request->request->get('save')) == 1){
            //$date = date('Y-m-d H:i:s', strtotime(str_replace('.', '/', $request->request->get('newsCreationTime'))));
            //$date = $request->request->get('newsCreationTime');
            //$date = new \DateTime('08.05.2012');
            $date = new \DateTime($request->request->get('newsCreationTime'));

            //var_dump($date);

            // Create new Food
            $food = new Food();
            $food->setName($request->request->get('foodName'));
            $food->setDescription($request->request->get('description'));
            //$food->setPictureName($request->request->get('foodPicture'));
            $food->setCreationDate($date);
            $food->setVisible(intval($request->request->get('visible')));


            // Save Filename
            $fileName = Functions::getArticleName($request->request->get('foodName')) . "." . substr($request->files->get('picture')->getClientOriginalName(), -3);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($food);

            $entityManager->flush();

            $food->setPictureName($food->getId() . "/" . $fileName);
            $entityManager->persist($food);

            $entityManager->flush();

            // Move File to Folder
            $file = $request->files->get('picture');
            $uploads_directory = 'content/' . $food->getId();

            $file->move(
                $uploads_directory,
                $fileName
            );

            return $this->redirectToRoute('list_overview');

        }

        return $this->render('login/view_new_food.html.twig', ["food" => []]);

    }

    /**
     * @Route("/admin/food_delete/{id}", name="food_delete")
     */
    public function delete($id){

        $entityManager = $this->getDoctrine()->getManager();
        $food = $entityManager->getRepository(Food::class)->findOneBy(['id' => $id]);

        $entityManager->remove($food);
        $entityManager->flush();

        return $this->redirectToRoute('list_overview');

    }

}
