<?php
class KontaktController extends Vlasotince_Library_Controller_Action_Abstract
{
	public function indexAction()
	{
		$this->view->kategorija = $this->_request->getParam('kategorija');
		$this->view->podkategorija = $this->_request->getParam('podkategorija');
		$this->view->oglas = $this->_request->getParam('oglas');
		$this->view->page = $this->_request->getParam('page');
		$this->view->headMeta ()->appendName ( "Description", "Оglasi Niš - Svi Niški oglasi na jednom mestu. Kupi, prodaj, objavi, saznaj..." );
		
		$contactForm = new Vlasotince_Form_Contact ();
		$this->view->sendMsg = false;
		if ($this->_request->isPost ()) {
			if ($contactForm->isValid ( $_POST )) {
				$sender = "www.oglasinis.com - " . $contactForm->getValue ( 'name' );
				$email = $contactForm->getValue ( 'email' );
				$subject = $contactForm->getValue ( 'subject' );
				$message = $contactForm->getValue ( 'message' );
				
				$htmlMessage = $this->view->partial ( 'templates/default.phtml', $contactForm->getValues () );
				$mail = new Zend_Mail ();
				$mail->setSubject ( $subject );
				$mail->setFrom ( $email, $sender );
				$mail->addTo ( 'oglasinis@gmail.com', 'webmaster' );
				$mail->setBodyHtml ( $htmlMessage );
				$mail->setBodyText ( $message );
				$result = $mail->send ();
				$this->view->messageProcessed = true;
				$this->view->sendMsg = true;
				if ($result) {
					$this->view->messageProcessed = false;
					$this->view->sendError = true;
				} else {
					$this->view->messageProcessed = true;
				}
			}
		}

		$contactForm->setAction ( '' );
		$contactForm->setMethod ( 'post' );
		$this->view->form = $contactForm;
		$this->view->headTitle ( 'Kontakt' );
		
	}
}
