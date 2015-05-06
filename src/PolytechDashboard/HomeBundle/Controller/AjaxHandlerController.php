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

/*
 * use Symfony\Component\HttpFoundation\Session\Session;
 *
 */
class AjaxHandlerController extends Controller
{
    public function contactListAction(Request $request)
    {
        $criteria = Criteria::create()->where(Criteria::expr()->contains("nom", $request->get('q')))->orWhere(
            Criteria::expr()->contains("prenom", $request->get('q'))
        )->orderBy(
            array(
                "nom" => Criteria::ASC
            )
        )->setFirstResult(0)->setMaxResults(20);

        $Gestionnaires = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Gestionnaire')->matching(
            $criteria
        );

        if (!$Gestionnaires) {
            throw $this->createNotFoundException('Aucun Gestionnaire trouvé pour cet nom : '.$request->get('q'));
        }

        $myArray = array();
        foreach ($Gestionnaires as $Gestionnaire) {
            $myArray [] = $Gestionnaire;
        }

        $encoders = array(
            new XmlEncoder (),
            new JsonEncoder ()
        );
        $normalizers = array(
            new GetSetMethodNormalizer ()
        );
        $serializer = new Serializer ($normalizers, $encoders);
        $jsonContent = $serializer->serialize($myArray, 'json');

        return new Response ($jsonContent);
    }

    public function notificationListAction()
    {
        $criteria = Criteria::create()->where(
            Criteria::expr()->eq("idetudiant", $this->getRequest()->getSession()->get('loginTMP')->getId())
        )->orderBy(
            array(
                "id" => Criteria::ASC
            )
        )->setFirstResult(0)->setMaxResults(20);

        $Notifications = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Notification')->matching(
            $criteria
        );

        if (!$Notifications) {
            throw $this->createNotFoundException(
                'Aucun Gestionnaire trouvé pour cet id : '.$this->getRequest()->getSession()->get('login')->getId()
            );
        }

        $myArray = array();
        foreach ($Notifications as $Notification) {
            $myArray [] = $Notification;
        }

        $encoders = array(
            new XmlEncoder (),
            new JsonEncoder ()
        );
        $normalizers = array(
            new GetSetMethodNormalizer ()
        );
        $serializer = new Serializer ($normalizers, $encoders);
        $jsonContent = $serializer->serialize($myArray, 'json');

        return new Response ($jsonContent);
    }

    public function setNotificationAsReadAction(Request $request)
    {


        $Notification->setStatus("LU");
        $em = $this->getDoctrine()->getManager();
        $em->persist($Notification);
        $em->flush();

        return new Response ();
    }

    public function setNotificationCategoryAsReadAction(Request $request)
    {
        $criteria = Criteria::create()->where(
            Criteria::expr()->eq("idetudiant", $this->getRequest()->getSession()->get('loginTMP')->getId())
        )->andWhere(Criteria::expr()->eq("categorie", $request->get('categorie')))->andWhere(
            Criteria::expr()->eq("status", "NONLU")
        )->orderBy(
            array(
                "id" => Criteria::ASC
            )
        )->setFirstResult(0)->setMaxResults(20);

        $Notifications = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Notification')->matching(
            $criteria
        );

        $myArray = array();
        foreach ($Notifications as $Notification) {
            $myArray [] = $Notification;
            $Notification->setStatus("LU");
            $em = $this->getDoctrine()->getManager();
            $em->persist($Notification);
            $em->flush();
        }

        $encoders = array(
            new XmlEncoder (),
            new JsonEncoder ()
        );
        $normalizers = array(
            new GetSetMethodNormalizer ()
        );
        $serializer = new Serializer ($normalizers, $encoders);
        $jsonContent = $serializer->serialize($myArray, 'json');

        return new Response ($jsonContent);
    }

    public function tachesListAction()
    {
        $criteria = Criteria::create()->where(
            Criteria::expr()->eq("idetudiant", $this->getRequest()->getSession()->get('loginTMP')->getId())
        )->orderBy(
            array(
                "id" => Criteria::ASC
            )
        )->setFirstResult(0)->setMaxResults(20);

        $Taches = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Tache')->matching($criteria);

        if (!$Taches) {
            throw $this->createNotFoundException(
                'Aucun Gestionnaire trouvé pour cet id : '.$this->getRequest()->getSession()->get('login')->getId()
            );
        }

        $myArray = array();
        foreach ($Taches as $Tache) {
            $myArray [] = $Tache;
        }

        $encoders = array(
            new XmlEncoder (),
            new JsonEncoder ()
        );
        $normalizers = array(
            new GetSetMethodNormalizer ()
        );
        $serializer = new Serializer ($normalizers, $encoders);
        $jsonContent = $serializer->serialize($myArray, 'json');

        return new Response ($jsonContent);
    }

    public function updateEtudiantAction(Request $request)
    {
        $Etudiant = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Etudiant')->findOneBy(
            array(
                'id' => $this->getRequest()->getSession()->get('loginTMP')->getId()
            )
        );
        $Etudiant->setTelephone($request->get('telephone'));
        $Etudiant->setEmail($request->get('email'));
        $Etudiant->setPassword(sha1($request->get('password')));
        $em = $this->getDoctrine()->getManager();
        $em->persist($Etudiant);
        $em->flush();

        return new Response ();
    }

    public function getIdGestionnaire($email)
    {
    	$logger = $this->get('logger');
    	$logger->info('$email : '.$email);
    	 
        $gestionnaire = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Gestionnaire')->findOneByEmail(
            $email
        );

        return $gestionnaire->getId();
    }

    public function getIdTaskNotAttribuate()
    {
        $i = 1;
        while (1) {
            $tache = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Tache')->findOneById($i);
            if ($tache == null) {
                return $i;
            }
            $i++;
        }
    }

    public function insertTaskAction(Request $request)
    {
    	$logger = $this->get('logger');
    	$logger->info('##########INSERT TASK#############');
    	 
        $idEtudiant = $this->getRequest()->getSession()->get('loginTMP')->getId();
        if ($request->getMethod() == 'POST') {
        	$logger->info('Post');
        	 
            /* EntityManager pour faire les requ�tes */
            $em = $this->getDoctrine()->getManager();
            $logger->info('EntityManager');
            
            $tache = new Tache ();
            $typeForm = substr($request->get('list_form'), -1);
            $logger->info('##### listform'.$request->get('list_form').' ######');
            $logger->info('##### typeForm'.$typeForm.' ######');
            
            $destinataire = explode(',', $request->get('destinataire_form'.$typeForm));
            $objet = $request->get('objet_form'.$typeForm);

            /* Importance */
            $importance = $request->get('importance_form'.$typeForm);

            switch ($typeForm) {
                case 2 :
                	 
                    /* dur�e */
                    $duree = $request->get('duree_absence');

                    /* motif */
                    $motif = $request->get('motif_justification_absence');

                    /* fichier */
                    $file = $request->get('absence_InputFile');

                    foreach ($destinataire as $dest) {
                        $tache->setIdetudiant($idEtudiant);
                        $tache->setIdgestionnaire($this->getIdGestionnaire($dest));
                        $tache->setDatecreation(date("Y-m-d"));
                        $tache->setDatefin("");
                        $tache->setImportance($importance);
                        $tache->setNom($objet);                        
                        $tache->setType($typeForm);
                        if ($file != null) {
                        	$tache->setIdresource($file);
                        }                                                
                        /* contenu de la tache */
                        $tmp = [];

                        $tmp ['0'] = $duree;
                        $tmp ['1'] = $motif;

                        $tache->setStructure(json_encode($tmp));

                        /* pour persister la tache en BDD */
                        $em->persist($tache);
                        
                        $em->flush();
                        
                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant($idEtudiant);
                        $tacheGestionnaire->setIdtache($tache->getId());
                        $tacheGestionnaire->setStatus("NONLU");
                        $tacheGestionnaire->setIdgestionnaire($this->getIdGestionnaire($dest));
                        $logger->info('1'.$tacheGestionnaire->getIdetudiant().' ');
                        $logger->info('2'.$tacheGestionnaire->getIdgestionnaire().' ');
                        $logger->info('4'.$tacheGestionnaire->getStatus().' ');

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist($tacheGestionnaire);
                        $logger->info('after persist');
                    }

                    break;
                case 3 :
                    /* date et heure du RDV */
                    $dateRdv = $request->get('date_rdv');

                    /* motif */
                    $motif = $request->get('motif_rdv');

                    /* echeance */
                    $echeance = "";
                    if ($request->get('checkbox_form3') == true) {
                        $echeance = $request->get('echeance_form3');
                    }

                    foreach ($destinataire as $dest) {
                        $tache->setIdetudiant($idEtudiant);
                        $tache->setIdgestionnaire($this->getIdGestionnaire($dest));
                        $tache->setDatecreation(date("Y-m-d"));
                        $tache->setDatefin($echeance);
                        $tache->setNom($objet);
                        $tache->setImportance($importance);
                        $tache->setType($typeForm);
                                            
                        /* contenu de la tache */
                        $tmp = [];
                        $tmp ['0'] = $dateRdv;
                        $tmp ['1'] = $motif;
                        $tache->setStructure(json_encode($tmp));

                        /* pour persister la tache en BDD */
                        $em->persist($tache);
                        $em->flush();

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant($idEtudiant);
                        $tacheGestionnaire->setIdtache($tache->getId());
                        $tacheGestionnaire->setStatus("NONLU");
                        $tacheGestionnaire->setIdgestionnaire($this->getIdGestionnaire($dest));

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist($tacheGestionnaire);
                    }

                    break;
                case 4:
                    /* type du devoir rendu */
                    $type = $request->get('list_devoirs');

                    /* nom du devoir */
                    $nom = $request->get('objet_form4');

                    /* fichier */
                    $file = $request->get('renduDevoir_InputFile');

                    /* commentaire */
                    $commentaire = $request->get('commentaire_rendu_devoir');

                    foreach ($destinataire as $dest) {
                        $tache->setIdetudiant($idEtudiant);
                        $tache->setIdgestionnaire($this->getIdGestionnaire($dest));
                        $tache->setDatecreation(date("Y-m-d"));
                        $tache->setDatefin("");
                        $tache->setType($typeForm);
                        $tache->setNom($objet);
                        if ($file != null) {
                        	$tache->setIdresource($file);
                        }
                        
                        /* contenu de la tache */
                        $tmp = [];
                        $tmp ['0'] = $nom;
                        $tmp ['1'] = $commentaire;
                        $tmp ['2'] = $type;

                        $tache->setStructure(json_encode($tmp));

                        /* pour persister la tache en BDD */
                        $em->persist($tache);
                        $em->flush();
                        

                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant($idEtudiant);
                        $tacheGestionnaire->setIdtache($tache->getId());
                        $tacheGestionnaire->setStatus("NONLU");
                        $tacheGestionnaire->setIdgestionnaire($this->getIdGestionnaire($dest));

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist($tacheGestionnaire);
                    }

                    break;
                case 5:
                    /* type d'inscritpion*/
                    $typeForm = $request->get('list_inscription');

                    /* motif */
                    $duree = $request->get('motif_inscription');

                    /* fichier */
                    $file = $request->get('inscription_InputFile');

                    /* echeance */
                    $echeance = "";
                    if ($request->get('checkbox_form5') == true) {
                        $echeance = $request->get('echeance_form5');
                    }

                    foreach ($destinataire as $dest) {
                        $tache->setIdetudiant($idEtudiant);
                        $tache->setIdgestionnaire($this->getIdGestionnaire($dest));
                        $tache->setDatecreation(date("Y-m-d"));
                        $tache->setDatefin($echeance);
                        $tache->setType($typeForm);
                        $tache->setNom($objet);
                        $tache->setImportance($importance);
                        if ($file != null) {
                        	$tache->setIdresource($file);
                        }
                        
                        /* contenu de la tache */
                        $tmp = [];
                        $tmp ['0'] = $duree;

                        $tache->setStructure(json_encode($tmp));

                        /* pour persister la tache en BDD */
                        $em->persist($tache);
                        $em->flush();
                        
                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant($idEtudiant);
                        $tacheGestionnaire->setIdtache($tache->getId());
                        $tacheGestionnaire->setStatus("NONLU");
                        $tacheGestionnaire->setIdgestionnaire($this->getIdGestionnaire($dest));

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist($tacheGestionnaire);
                    }

                    break;
                case 6:
                    /* dates de stage */
                    $dates_stage = $request->get('dates_stage');

                    /* d�tail */
                    $detail = $request->get('detail_stage');

                    /* fichier */
                    $file = $request->get('validStage_InputFile');

                    /* echeance */
                    $echeance = "";
                    if ($request->get('checkbox_form6') == true) {
                        $echeance = $request->get('echeance_form6');
                    }

                    foreach ($destinataire as $dest) {
                        $tache->setIdetudiant($idEtudiant);
                        $tache->setIdgestionnaire($this->getIdGestionnaire($dest));
                        $tache->setDatecreation(date("Y-m-d"));
                        $tache->setDatefin($echeance);
                        $tache->setType($typeForm);
                        $tache->setNom($objet);
                        $tache->setImportance($importance);
                        if ($file != null) {
                        	$tache->setIdresource($file);
                        }
                        /* contenu de la tache */
                        $tmp = [];
                        $tmp ['0'] = $dates_stage;
                        $tmp ['1'] = $detail;

                        $tache->setStructure(json_encode($tmp));

                        /* pour persister la tache en BDD */
                        $em->persist($tache);
                        $em->flush();
                        
                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant($idEtudiant);
                        $tacheGestionnaire->setIdtache($tache->getId());
                        $tacheGestionnaire->setStatus("NONLU");
                        $tacheGestionnaire->setIdgestionnaire($this->getIdGestionnaire($dest));

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist($tacheGestionnaire);
                    }

                    break;
                case 7:
                    /* remarque*/
                    $remarque_stage = $request->get('remarque_stage');

                    /* fichier */
                    $file = $request->get('pdf_convention_InputFile');


                    foreach ($destinataire as $dest) {
                        $tache->setIdetudiant($idEtudiant);
                        $tache->setIdgestionnaire($this->getIdGestionnaire($dest));
                        $tache->setDatecreation(date("Y-m-d"));
                        $tache->setDatefin("");
                        $tache->setType($typeForm);
                        $tache->setNom($objet);
                        $tache->setImportance($importance);
                        if ($file != null) {
                        	$tache->setIdresource($file);
                        }
                        /* contenu de la tache */
                        $tmp = [];
                        $tmp ['0'] = $remarque_stage;

                        $tache->setStructure(json_encode($tmp));

                        /* pour persister la tache en BDD */
                        $em->persist($tache);
                        $em->flush();
                        
                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant($idEtudiant);
                        $tacheGestionnaire->setIdtache($tache->getId());
                        $tacheGestionnaire->setStatus("NONLU");
                        $tacheGestionnaire->setIdgestionnaire($this->getIdGestionnaire($dest));

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist($tacheGestionnaire);
                    }

                    break;
                case 8 :
                    /* text */
                    $text = $request->get('texte_form8');

                    /* fichier */
                    $file = $request->get('taskPerso_InputFile');

                    /* echeance */
                    $echeance = "";
                    if ($request->get('checkbox_form8') == true) {
                        $echeance = $request->get('echeance_form8');
                    }

                    $tache->setIdetudiant($idEtudiant);
                    $tache->setNom($objet);
                    $tache->setDatecreation(date("Y-m-d"));
                    $tache->setDatefin($echeance);
                    $tache->setType($typeForm);
                    $tache->setImportance($importance);
                    if ($file != null) {
                    	$tache->setIdresource($file);
                    }
                    
                    /* contenu de la tache */
                    $tmp = [];
                    $tmp['0'] = $text;

                    $tache->setStructure(json_encode($tmp));

                    /* pour persister la tache en BDD */
                    $em->persist($tache);
					$logger->info('PERSIST TACHE');

					$em->flush();
					
					$logger->info("idTache : ".$tache->getId());
                    $tacheEtudiant = new Tacheetudiant ();
                    $tacheEtudiant->setStatus("NONLU");
                    $tacheEtudiant->setIdetudiant($idEtudiant);
                    $tacheEtudiant->setIdtache($tache->getId());

                    /* pour persister la tacheEtudiant en BDD */
                    $em->persist($tacheEtudiant);
                    $logger->info('PERSIST TACHEEtudiant');
                    
                    break;
                case 9 :
                    /* text */
                    $text = $request->get('text_autre_demande');

                    /* fichier */
                    $file = $request->get('demandeNonRepertoriee_InputFile');

                    /* echeance */
                    $echeance = "";
                    if ($request->get('checkbox_form9') == true) {
                        $echeance = $request->get('echeance_form9');
                    }

                    foreach ($destinataire as $dest) {
                        $tache->setIdetudiant($idEtudiant);
                        $tache->setIdgestionnaire($this->getIdGestionnaire($dest));
                    	$tache->setNom($objet);
                        $tache->setDatecreation(date("Y-m-d"));
                        $tache->setDatefin($echeance);
                        $tache->setType($typeForm);
                        $tache->setImportance($importance);
                        if ($file != null) {
                        	$tache->setIdresource($file);
                        }
                        
                        /* contenu de la tache */
                        $tmp = [];
                        $tmp['0'] = $text;
                        $tache->setStructure(json_encode($tmp));

                        /* pour persister la tache en BDD */
                        $em->persist($tache);
                        $em->flush();
                        
                        $tacheGestionnaire = new Tachegestionnaire ();
                        $tacheGestionnaire->setIdetudiant($idEtudiant);
                        $tacheGestionnaire->setIdgestionnaire($this->getIdGestionnaire($dest));
                        $tacheGestionnaire->setIdtache($tache->getId());
                        $tacheGestionnaire->setStatus("NONLU");

                        /* pour persister la tacheEtudiant en BDD */
                        $em->persist($tacheGestionnaire);
                    }

                    break;
            }

//             print_r('Before flush');
            /* pour valider les persist effectu�es */
            $em->flush();
//             print_r('after flush');
        }

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize("success", 'json');

        return new Response($jsonContent);
    }

    public function removeTaskAction(Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();
        //echo "id=".$request->get('id')."<br>";

        $idtache = $request->get('id');
        $query = $em->createQuery("DELETE PolytechDashboardHomeBundle:Tacheetudiant t WHERE t.idtache = $idtache");
        $query->execute();
        $query = $em->createQuery("DELETE PolytechDashboardHomeBundle:Tache t WHERE t.id = $idtache");
        $query->execute();
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("idtache", $request->get('id')))
            ->setFirstResult(0)
            ->setMaxResults(20);
        $em->flush();


        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize("success", 'json');

        return new Response($jsonContent);
    }

    public function updateTaskAction(Request $request) {


        $Tache = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Tache')
            ->findOneBy(array('id' => $request->get('TaskForm_idTask_form8')));

        $Tache->setNom($request->get('TaskForm_objet_form8'));
        $Tache->setImportance($request->get('TaskForm_importance_form8'));
        $Tache->setStructure($request->get('TaskForm_texte_form8'));
        $Tache->setDatefin($request->get('TaskForm_echeance_form8'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($Tache);
        $em->flush();


        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($Tache, 'json');

        return new Response($jsonContent);
    }

    public function  getMytasksRendredAction(){

        $id= $this->getRequest()->getSession()->get('loginTMP')->getId();

        $myTasksReceived = [ ];
        $myTasksSend = [ ];
        $admins = [ ];
        $adminsTaskSend = [ ];

        $controller =$this;

        /* liste de taches affect�es a l'etudiant */
        $tabTasks = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tacheetudiant' )->findByIdetudiant ( $id );
        if ($tabTasks) {
            /* nombre de taches de l'etudiant */
            $max = sizeof ( $tabTasks );

            for($i = 0; $i < $max; $i ++) {
                $task = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tache' )->findOneById ( $tabTasks [$i]->getIdtache () );
                $admin = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $task->getIdgestionnaire () );

                if ($admin != null) {
                    /* tache affect�e par un gestionnaire */
                    array_push ( $admins, $admin );
                }
                array_push ( $myTasksReceived, $task );

                /* suppression des variables temporaires */
                unset ( $task );
                unset ( $admin );
            }
            usort ( $myTasksReceived, function ($a, $b) {
                return ($a->getDatefin () < $b->getDatefin ()) ? - 1 : 1;
            } );
        }

        /* liste des taches envoy�es par l'�tudiant */
        $tabTasksSend = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tachegestionnaire' )->findByIdetudiant ( $id );
        if ($tabTasksSend) {
            /* nombre de taches que l'etudiant a envoy� */
            $max = sizeof ( $tabTasksSend );

            for($i = 0; $i < $max; $i ++) {
                $task = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tache' )->findOneById ( $tabTasksSend [$i]->getIdtache () );
                $admin = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $tabTasksSend [$i]->getIdgestionnaire () );

                /* tache affect�e a un gestionnaire */
                array_push ( $adminsTaskSend, $admin );

                array_push ( $myTasksSend, $task );

                /* suppression des variables temporaires */
                unset ( $task );
                unset ( $admin );
            }
        }

        $result = array ();
        $result ['tasksReceived'] = $myTasksReceived;
        $result ['admins'] = $admins;
        $result ['tasksSend'] = $myTasksSend;
        $result ['adminsTaskSend'] = $adminsTaskSend;

        return $this->render('@PolytechDashboardHome/Default/pages/tasks/my_tasks.html.twig',
            array (
                'myTasks' => $result,
            )
            );
    }

    public function removeValidTaskAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("idetudiant", $this->getRequest()->getSession()->get('loginTMP')->getId()))
            ->andWhere( Criteria::expr()->eq("status","VALIDE"));

        $taches = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Tacheetudiant')->matching(
            $criteria
        );

        $idetudiant=$this->getRequest()->getSession()->get('loginTMP')->getId();
        $query = $em->createQuery("DELETE PolytechDashboardHomeBundle:Tacheetudiant t WHERE t.idetudiant = $idetudiant AND t.status = 'VALIDE' ");
        $query->execute();

        $myArray = array();
        foreach ($taches as $tache) {
            $myArray [] = $tache;
            $idtache=$tache->getIdtache();
            $query = $em->createQuery("DELETE PolytechDashboardHomeBundle:Tache t WHERE t.id = $idtache ");
            $query->execute();
        }
        $em->flush();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($myArray, 'json');

        return new Response($jsonContent);
    }

    public function removeSendedValidTaskAction(Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("idetudiant", $this->getRequest()->getSession()->get('loginTMP')->getId()))
            ->andWhere( Criteria::expr()->eq("status","VALIDE"));

        $taches = $this->getDoctrine()->getRepository('PolytechDashboardHomeBundle:Tachegestionnaire')->matching(
            $criteria
        );

        $idetudiant=$this->getRequest()->getSession()->get('loginTMP')->getId();
        $query = $em->createQuery("DELETE PolytechDashboardHomeBundle:Tachegestionnaire t WHERE t.idetudiant = $idetudiant AND t.status = 'VALIDE' ");
        $query->execute();

        $myArray = array();
        foreach ($taches as $tache) {
            $myArray [] = $tache;
            $idtache=$tache->getIdtache();
            $query = $em->createQuery("DELETE PolytechDashboardHomeBundle:Tache t WHERE t.id = $idtache ");
            $query->execute();
        }
        $em->flush();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($myArray, 'json');

        return new Response($jsonContent);
    }

}
