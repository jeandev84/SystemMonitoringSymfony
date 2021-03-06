<?php
namespace App\Controller;

use App\Entity\Website;
use App\Form\WebsiteType;
use App\Repository\WebsiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * Class AdminController
 * @package App\Controller
*/
class AdminController extends AbstractController
{

    /**
     * @Route("/admin/login", name="login")
     * @param AuthenticationUtils $utils
     * @return Response
    */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        return $this->render('admin/login.html.twig', [
            'error' => $error !== null
        ]);
    }


    /**
     * @Route("/admin/logout", name="logout")
    */
    public function logout()
    {
    }

    /**
     * @Route("/admin", name="admin.dashboard")
     * @IsGranted("ROLE_ADMIN")
     * @param WebsiteRepository $websiteRepository
     * @return Response
     *
     * IsGranted() sera interessant pour gerer certaines routes en particulier
    */
    public function index(WebsiteRepository $websiteRepository)
    {
        $websites = $websiteRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'websites' => $websites
        ]);
    }


    /**
     * @Route("/admin/new", name="admin.new")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $website = new Website();
        $form = $this->createForm(WebsiteType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /* dump($website); */
            $entityManager->persist($website);
            $entityManager->flush();
            $this->addFlash('success', 'Site web ajoute avec success');
            return $this->redirectToRoute('admin.dashboard');
        }

        return $this->render('admin/new.html.twig', [
           'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/{id}/edit", name="admin.edit")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param Website $website
     * @return RedirectResponse
     */
    public function edit(Request $request, EntityManagerInterface $entityManager, Website $website)
    {
        $form = $this->createForm(WebsiteType::class, $website);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /* dump($website); */
            $entityManager->persist($website);
            $entityManager->flush();
            $this->addFlash('success', 'Site web edite avec success');
            return $this->redirectToRoute('admin.dashboard');
        }

        return $this->render('admin/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/{id}/remove", name="admin.remove")
     * @param EntityManagerInterface $entityManager
     * @param Website $website
     * @return RedirectResponse
     */
    public function remove(EntityManagerInterface $entityManager, Website $website)
    {
        $entityManager->remove($website);
        $entityManager->flush();
        $this->addFlash('warning', 'Le site web a ete supprime avec success');
        return $this->redirectToRoute('admin.dashboard');
    }
}
