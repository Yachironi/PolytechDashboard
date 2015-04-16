<?php
namespace PolytechDashboard\HomeBundle\Controller;

use PolytechDashboard\HomeBundle\Entity\Gestionnaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestAjaxController extends Controller
{
    public function handlerAction(Request $request)
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->contains("nom", $request->get('nom')))
            ->orderBy(array("nom" => Criteria::ASC))
            ->setFirstResult(0)
            ->setMaxResults(20);

        $Gestionnaires = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Gestionnaire')->matching($criteria);

        if (!$Gestionnaires) {
            throw $this->createNotFoundException('Aucun Gestionnaire trouvé pour cet nom : '.$request->get('nom'));
        }
        $response = new Response(
            json_encode(
                array (
                    'cours' => $Gestionnaires
                )
            )
        );
        $response->headers->set('Content-Type', 'application/json');

        return new JsonResponse($this->get('serializer')->normalize($Gestionnaires));

    }
}