<?php
// src/AppBundle/Controller/MagiqueController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class MagiqueController
{
    /**
     * @Route("/numero/magique")
     */
    public function numeroAction1()
    {
        $numero = mt_rand(0, 100);

        return new Response(
            '<html><body>Numero magique : '.$numero.'</body></html>'
        );
    }

    /**
     * @Route("/numero/magique/{count}")
     */
    public function numeroAction($count)
    {
        $numeros = array();
        for ($i = 0; $i < $count; $i++) {
            $numeros[] = rand(0, 100);
        }
        $listeNumeros = implode(', ', $numeros);

        return new Response(
            '<html><body>Numeros magiques: '.$listeNumeros.'</body></html>'
        );
    }
}
?>