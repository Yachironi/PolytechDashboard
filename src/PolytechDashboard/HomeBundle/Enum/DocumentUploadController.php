<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
// ...
class DocumentUploadController extends Controller {
	/**
	 * @Template()
	 */
	public function uploadAction() {
		$document = new Document ();
		$form = $this->createFormBuilder ( $document )->add ( 'name' )->add ( 'file' )->getForm ();
		
		if ($this->getRequest ()->isMethod ( 'POST' )) {
			$form->handleRequest ( $this->getRequest () );
			if ($form->isValid ()) {
				$em = $this->getDoctrine ()->getManager ();
				$document->upload();
				$em->persist ( $document );
				$em->flush ();

			$this->redirect($this->generateUrl(""));
			}
		}
		
		return array (
				'form' => $form->createView () 
		);
	}
}