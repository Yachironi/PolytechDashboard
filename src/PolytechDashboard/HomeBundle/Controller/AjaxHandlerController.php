<?php
namespace PolytechDashboard\HomeBundle\Controller;

use Doctrine\Common\Collections\Criteria;
use PolytechDashboard\HomeBundle\Entity\Gestionnaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
/*use Symfony\Component\HttpFoundation\Session\Session;

*/
class AjaxHandlerController extends Controller
{
    public function contactListAction(Request $request)
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->contains("nom", $request->get('q')))->orWhere(Criteria::expr()->contains("prenom", $request->get('q')))
            ->orderBy(array("nom" => Criteria::ASC))
            ->setFirstResult(0)
            ->setMaxResults(20);

        $Gestionnaires = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Gestionnaire')->matching(
            $criteria
        );

        if (!$Gestionnaires) {
            throw $this->createNotFoundException('Aucun Gestionnaire trouvé pour cet nom : '.$request->get('q'));
        }

        $myArray=array();
        foreach ($Gestionnaires as $Gestionnaire) {
            $myArray[]=$Gestionnaire;
        }

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($myArray, 'json');

        return new Response($jsonContent);

    }
    public function notificationListAction()
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("idetudiant", $this->getRequest()->getSession()->get('login')->getId()))
            ->orderBy(array("id" => Criteria::ASC))
            ->setFirstResult(0)
            ->setMaxResults(20);

        $Notifications = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Notification')->matching(
            $criteria
        );

        if (!$Notifications) {
            throw $this->createNotFoundException('Aucun Gestionnaire trouvé pour cet id : '.$this->getRequest()->getSession()->get('login')->getId());
        }

        $myArray=array();
        foreach ($Notifications as $Notification) {
            $myArray[]=$Notification;
        }

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($myArray, 'json');

        return new Response($jsonContent);
    }
    public function setNotificationAsReadAction(Request $request)
    {

        $Notification = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Notification')
            ->findOneBy(array('id' => $request->get("id")));

        $Notification->setStatus("LU");
        $em = $this->getDoctrine()->getManager();
        $em->persist($Notification);
        $em->flush();

        return new Response();
    }
}