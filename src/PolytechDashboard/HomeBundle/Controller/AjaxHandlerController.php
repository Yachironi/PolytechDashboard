<?php
namespace PolytechDashboard\HomeBundle\Controller;

use Doctrine\Common\Collections\Criteria;
use PolytechDashboard\HomeBundle\Entity\Gestionnaire;
use PolytechDashboard\HomeBundle\Entity\Tache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use PolytechDashboard\HomeBundle\Entity\Tachegestionnaire;
use PolytechDashboard\HomeBundle\Entity\Tacheetudiant;
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

    public function insertTaskAction(Request $request) {
        $idEtudiant = $this->getRequest()->getSession()->get('loginTMP')->getId();

        if ($request->getMethod () == 'POST') {
            /* EntityManager pour faire les requ�tes*/
            $em = $this->getDoctrine()->getManager();

            $tache = new Tache();

            $typeForm = substr ( $request->get ( 'list_form' ), - 1 );

            $destinataire = explode(',',$request->get ( 'destinataire_form' . $typeForm ));
            $objet = $request->get ( 'objet_form' . $typeForm );

            /* TODO Importance */
            // $importance =

            switch ($typeForm) {
                case 2 :
                    /* dur�e */
                    $duree = $request->get ( 'duree_absence' );

                    /* motif */
                    $motif = $request->get ( 'motif_justification_absence' );

                    /* fichier */
                    $file = $request->get ( 'absence_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form2' ) == true) {
                        $echeance = $request->get ( 'echeance_form2' );
                    }

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        $tache->setNom($motif);
                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $file;
                        $tmp ['0'] = $duree;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 3 :
                    /* date et heure du RDV */
                    $duree = $request->get ( 'date_rdv' );

                    /* motif */
                    $motif = $request->get ( 'motif_rdv' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form3' ) == true) {
                        $echeance = $request->get ( 'echeance_form3' );
                    }

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        $tache->setNom($motif);
                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $duree;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 4:
                    /* type du devoir rendu */
                    $type = $request->get ( 'list_devoirs' );

                    /* nom du devoir */
                    $nom = $request->get ( 'objet_form4' );

                    /* fichier */
                    $file = $request->get ( 'renduDevoir_InputFile' );

                    /* commentaire */
                    $commentaire = $request->get ( 'commentaire_rendu_devoir' );

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        $tache->setNom($type);
                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $file;
                        $tmp ['1'] = $nom;
                        $tmp ['2'] = $commentaire;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 5:
                    /* type d'inscritpion*/
                    $typeForm = $request->get ( 'list_inscription' );

                    /* motif */
                    $duree = $request->get ( 'motif_inscription' );

                    /* fichier */
                    $file = $request->get ( 'inscription_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form5' ) == true) {
                        $echeance = $request->get ( 'echeance_form5' );
                    }

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        $tache->setNom($typeForm);

                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $file;
                        $tmp ['1'] = $duree;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 6:
                    /* dates de stage */
                    $dates_stage = $request->get ( 'dates_stage' );

                    /* d�tail */
                    $detail = $request->get ( 'detail_stage' );

                    /* fichier */
                    $file = $request->get ( 'validStage_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form6' ) == true) {
                        $echeance = $request->get ( 'echeance_form6' );
                    }

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        $tache->setNom($detail);
                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $file;
                        $tmp ['2'] = $dates_stage;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 7:
                    /* remarque*/
                    $remarque_stage = $request->get ( 'remarque_stage' );

                    /* fichier */
                    $file = $request->get ( 'pdf_convention_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form7' ) == true) {
                        $echeance = $request->get ( 'echeance_form7' );
                    }

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $file;
                        $tmp ['1'] = $remarque_stage;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 8 :
                    /* text */
                    $text = $request->get ( 'texte_form8' );

                    /* fichier */
                    $file = $request->get ( 'taskPerso_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_for8' ) == true) {
                        $echeance = $request->get ( 'echeance_form8' );
                    }


                    $tache->setIdetudiant($idEtudiant);
                    $tache->setNom($text);
                    $tache->setDatecreation(date("Y-m-d"));
                    $tache->setDatefin($echeance);
                    $tache->setType($objet);
                    /* contenu de la tache */
                    $tmp = [];
                    $tmp['0'] = $file;
                    $tache->setStructure($tmp);

                    /* pour persister la tache en BDD*/
                    $em->persist($tache);


                    $tacheEtudiant = new Tacheetudiant();
                    $tacheEtudiant->setType("NONLU");
                    $tacheEtudiant->setIdetudiant($idEtudiant);
                    $tacheEtudiant->setIdtache($tache->getId());

                    /* pour persister la tacheEtudiant en BDD*/
                    $em->persist($tacheEtudiant);

                    break;
                case 9 :
                    /* text */
                    $text = $request->get ( 'text_autre_demande' );

                    /* fichier */
                    $file = $request->get ( 'demandeNonRepertoriee_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form6' ) == true) {
                        $echeance = $request->get ( 'echeance_form6' );
                    }

                    foreach ($destinataire as $dest){
                        $tache->setIdetudiant($idEtudiant);
                        $tache->setIdgestionnaire($dest);
                        $tache->setNom($text);
                        $tache->setDatecreation(date("Y-m-d"));
                        $tache->setDatefin($echeance);
                        $tache->setType($objet);
                        /* contenu de la tache */
                        $tmp = [];
                        $tmp['0'] = $file;
                        $tache->setStructure($tmp);

                        /* pour persister la tache en BDD*/
                        $em->persist($tache);


                        $tacheGestionnaire = new Tachegestionnaire();
                        $tacheGestionnaire->setIdetudiant($idEtudiant);
                        $tacheGestionnaire->setIdtache($tache->getId());
                        $tacheGestionnaire->setStatus("NONLU");

                        /* pour persister la tacheEtudiant en BDD*/
                        $em->persist($tacheEtudiant);
                    }


                    break;
            }

            /* pour valider les persist effectu�es */
            $em->flush();

        }
        $myArray=array();
        $myArray['test']="test";
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize( "success", 'json');

        return new Response($jsonContent);
    }


    public function insertTaskAction2(Request $request) {
        $idEtudiant = $this->getRequest()->getSession()->get('loginTMP')->getId();

        if ($request->getMethod () == 'POST') {
            /* EntityManager pour faire les requ�tes*/
            $em = $this->getDoctrine()->getManager();

            $tache = new Tache();

            $typeForm = substr ( $request->get ( 'list_form' ), - 1 );

            $destinataire = $request->get ( 'destinataire_form' . $typeForm );
            $objet = $request->get ( 'objet_form' . $typeForm );

            /* TODO Importance */
            // $importance =

            switch ($typeForm) {
                case 2 :
                    /* dur�e */
                    $duree = $request->get ( 'duree_absence' );

                    /* motif */
                    $motif = $request->get ( 'motif_justification_absence' );

                    /* fichier */
                    $file = $request->get ( 'absence_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form2' ) == true) {
                        $echeance = $request->get ( 'echeance_form2' );
                    }

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        $tache->setNom($motif);
                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $file;
                        $tmp ['0'] = $duree;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 3 :
                    /* date et heure du RDV */
                    $duree = $request->get ( 'date_rdv' );

                    /* motif */
                    $motif = $request->get ( 'motif_rdv' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form3' ) == true) {
                        $echeance = $request->get ( 'echeance_form3' );
                    }

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        $tache->setNom($motif);
                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $duree;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 4:
                    /* type du devoir rendu */
                    $type = $request->get ( 'list_devoirs' );

                    /* nom du devoir */
                    $nom = $request->get ( 'objet_form4' );

                    /* fichier */
                    $file = $request->get ( 'renduDevoir_InputFile' );

                    /* commentaire */
                    $commentaire = $request->get ( 'commentaire_rendu_devoir' );

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        $tache->setNom($type);
                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $file;
                        $tmp ['1'] = $nom;
                        $tmp ['2'] = $commentaire;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 5:
                    /* type d'inscritpion*/
                    $typeForm = $request->get ( 'list_inscription' );

                    /* motif */
                    $duree = $request->get ( 'motif_inscription' );

                    /* fichier */
                    $file = $request->get ( 'inscription_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form5' ) == true) {
                        $echeance = $request->get ( 'echeance_form5' );
                    }

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        $tache->setNom($typeForm);

                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $file;
                        $tmp ['1'] = $duree;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 6:
                    /* dates de stage */
                    $dates_stage = $request->get ( 'dates_stage' );

                    /* d�tail */
                    $detail = $request->get ( 'detail_stage' );

                    /* fichier */
                    $file = $request->get ( 'validStage_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form6' ) == true) {
                        $echeance = $request->get ( 'echeance_form6' );
                    }

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        $tache->setNom($detail);
                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $file;
                        $tmp ['2'] = $dates_stage;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 7:
                    /* remarque*/
                    $remarque_stage = $request->get ( 'remarque_stage' );

                    /* fichier */
                    $file = $request->get ( 'pdf_convention_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form7' ) == true) {
                        $echeance = $request->get ( 'echeance_form7' );
                    }

                    foreach ( $destinataire as $dest ) {
                        $tache->setIdetudiant ( $idEtudiant );
                        $tache->setIdgestionnaire ( $dest );
                        $tache->setDatecreation ( date ( "Y-m-d" ) );
                        $tache->setDatefin ( $echeance );
                        $tache->setType ( $objet );
                        /* contenu de la tache */
                        $tmp = [ ];
                        $tmp ['0'] = $file;
                        $tmp ['1'] = $remarque_stage;
                        $tache->setStructure ( $tmp );

                        /* pour persister la tache en BDD */
                        $em->persist ( $tache );

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant ( $idEtudiant );
                        $tacheGestionnaire->setIdtache ( $tache->getId () );
                        $tacheGestionnaire->setStatus ( "NONLU" );

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist ( $tacheGestionnaire );
                    }

                    break;
                case 8 :
                    /* text */
                    $text = $request->get ( 'texte_form8' );

                    /* fichier */
                    $file = $request->get ( 'taskPerso_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_for8' ) == true) {
                        $echeance = $request->get ( 'echeance_form8' );
                    }


                    $tache->setIdetudiant($idEtudiant);
                    $tache->setNom($text);
                    $tache->setDatecreation(date("Y-m-d"));
                    $tache->setDatefin($echeance);
                    $tache->setType($objet);
                    /* contenu de la tache */
                    $tmp = [];
                    $tmp['0'] = $file;
                    $tache->setStructure($tmp);

                    /* pour persister la tache en BDD*/
                    $em->persist($tache);


                    $tacheEtudiant = new Tacheetudiant();
                    $tacheEtudiant->setType("NONLU");
                    $tacheEtudiant->setIdetudiant($idEtudiant);
                    $tacheEtudiant->setIdtache($tache->getId());

                    /* pour persister la tacheEtudiant en BDD*/
                    $em->persist($tacheEtudiant);

                    break;
                case 9 :
                    /* text */
                    $text = $request->get ( 'text_autre_demande' );

                    /* fichier */
                    $file = $request->get ( 'demandeNonRepertoriee_InputFile' );

                    /* �ch�ance */
                    if ($request->get ( 'checkbox_form6' ) == true) {
                        $echeance = $request->get ( 'echeance_form6' );
                    }

                    foreach ($destinataire as $dest){
                        $tache->setIdetudiant($idEtudiant);
                        $tache->setIdgestionnaire($dest);
                        $tache->setNom($text);
                        $tache->setDatecreation(date("Y-m-d"));
                        $tache->setDatefin($echeance);
                        $tache->setType($objet);
                        /* contenu de la tache */
                        $tmp = [];
                        $tmp['0'] = $file;
                        $tache->setStructure($tmp);

                        /* pour persister la tache en BDD*/
                        $em->persist($tache);


                        $tacheGestionnaire = new Tachegestionnaire();
                        $tacheGestionnaire->setIdetudiant($idEtudiant);
                        $tacheGestionnaire->setIdtache($tache->getId());
                        $tacheGestionnaire->setStatus("NONLU");

                        /* pour persister la tacheEtudiant en BDD*/
                        $em->persist($tacheEtudiant);
                    }


                    break;
            }

            /* pour valider les persist effectu�es */
            $em->flush();

        }
    }


}