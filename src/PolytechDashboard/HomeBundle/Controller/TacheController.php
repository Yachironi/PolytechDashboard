<?php

namespace PolytechDashboard\HomeBundle\Controller;

use PolytechDashboard\HomeBundle\Entity\Tache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PolytechDashboard\HomeBundle\Entity\Tacheetudiant;
use PolytechDashboard\HomeBundle\Entity\Tachegestionnaire;


class TacheController extends Controller {
	public static function indexAction($id, $controller) {
		$myTasksReceived = [ ];
		$myTasksSend = [ ];
		$admins = [ ];
		$adminsTaskSend = [ ];
		
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
		return $result;
	}
    public function submitFormAction(Request $request, $idEtudiant) {
        if ($request->getMethod () == 'POST') {
            /* EntityManager pour faire les requ�tes*/
            $em = $this->getDoctrine()->getManager();
            $logger = $this->get('logger');
            $logger->info('LOG');
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