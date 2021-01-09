<?php


namespace App\Controller;

use App\Entity\Ordem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Snappy\Pdf as Snappy;

class OrdemController extends AbstractController
{
    /**
     * @Route("/ordens/{hash}", name="ordem_pdf")
     */
    public function pdf(Ordem $ordem, Snappy $snappy) {
        $html = $this->renderView('ordem/pdf.html.twig', array(
            'ordem' => $ordem
        ));

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="ordem.pdf'
            ]
        );
    }
}