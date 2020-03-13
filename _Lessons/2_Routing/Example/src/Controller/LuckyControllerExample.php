<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class LuckyControllerExample
 * @package App\Controller
*/
class LuckyControllerExample extends AbstractController
{

    /**
     * @Route("/lucky/number/test", name="app_lucky_number_test")
     * @return Response
     * @throws \Exception
    */
     public function number(): Response
     {
         $number = random_int(0, 100);

         return $this->render('lucky/number.html.twig', [
             'number' => $number
         ]);
         /*
         return new Response(
           sprintf('<html><body>Lucky Number : %s</body></html>', $number)
         );
         */
     }
}