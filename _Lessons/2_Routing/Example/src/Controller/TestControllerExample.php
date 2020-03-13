<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestControllerExample
 * @package App\Controller
*/
class TestControllerExample extends AbstractController
{
    /**
     * @Route("/test", name="test")
    */
    public function index()
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
