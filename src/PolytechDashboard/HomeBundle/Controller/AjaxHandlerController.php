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
            ->where(Criteria::expr()->eq("idetudiant", $this->getRequest()->getSession()->get('loginTMP')->getId()))
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
    
    public function setNotificationCategoryAsReadAction(Request $request)
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("idetudiant", $this->getRequest()->getSession()->get('loginTMP')->getId()))
            ->andWhere(Criteria::expr()->eq("categorie", $request->get('categorie')))
            ->andWhere(Criteria::expr()->eq("status", "NONLU"))
            ->orderBy(array("id" => Criteria::ASC))
            ->setFirstResult(0)
            ->setMaxResults(20);

        $Notifications = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Notification')->matching(
            $criteria
        );

        $myArray=array();
        foreach ($Notifications as $Notification) {
            $myArray[]=$Notification;
            $Notification->setStatus("LU");
            $em = $this->getDoctrine()->getManager();
            $em->persist($Notification);
            $em->flush();
        }

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($myArray, 'json');

        return new Response($jsonContent);
    }

    public function tachesListAction()
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("idetudiant", $this->getRequest()->getSession()->get('loginTMP')->getId()))
            ->orderBy(array("id" => Criteria::ASC))
            ->setFirstResult(0)
            ->setMaxResults(20);

        $Taches = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Tache')->matching(
            $criteria
        );

        if (!$Taches) {
            throw $this->createNotFoundException('Aucun Gestionnaire trouvé pour cet id : '.$this->getRequest()->getSession()->get('login')->getId());
        }

        $myArray=array();
        foreach ($Taches as $Tache) {
            $myArray[]=$Tache;
        }

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($myArray, 'json');

        return new Response($jsonContent);
    }

    public function updateEtudiantAction(Request $request)
    {
    
    	$Etudiant = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Etudiant')
    	->findOneBy(array('id' => $this->getRequest()->getSession()->get('loginTMP')->getId()));
    	$Etudiant->setTelephone($request->get('telephone'));
    	$Etudiant->setEmail($request->get('email'));
    	$Etudiant->setPassword(sha1($request->get('password')));
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($Etudiant);
    	$em->flush();
    
    	return new Response();
    }
    
}