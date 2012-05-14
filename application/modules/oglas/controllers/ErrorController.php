<?php
/**
 * @name ErrorController
 * @desc The controller to serve 404 and 500 errors and debugging stacktrace on DEV ENV
 * 
 * @author Andrei
 * @filesource application/controllers/ErrorController.php
 * @version 1.0.0
 */

Class Oglas_ErrorController extends Oglas_Library_Controller_Action_Abstract 
{
    private $_notifier;
    private $_error;
    private $_environment;

    public function init()
    {
        parent::init();

        $bootstrap = $this->getInvokeArg('bootstrap');

        $environment = $bootstrap->getEnvironment();
        $error = $this->_getParam('error_handler');
        $mailer = new Zend_Mail();
        $session = new Zend_Session_Namespace();
        $cookies = $_COOKIE;
       
        $this->_notifier = new Custom_Service_Notifier_Error(
            $environment,
            $error,
            $mailer,
            $session,
            $cookies,
            $_SERVER
        );

        $this->_error = $error;
        $this->_environment = $environment;
   }

    public function errorAction()
    {
    	$errors = $this->_getParam('error_handler');
        switch ($this->_error->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Strana nije pronađena';
                $this->_applicationError();
                break;

            default:
                $this->getResponse()->setHttpResponseCode(500);
				$this->view->message = 'Došlo je do greške.';
                $this->_applicationError();
                $exception = $errors->exception;
                $log = new Zend_Log(
                    new Zend_Log_Writer_Stream(
                       APP_PUBLIC .'/temp/oglasException.log'
                  )
                );
                $log->debug($exception->getMessage() . "\n" .
                            $exception->getTraceAsString());
                break;
        }

        //$this->view->headTitle()->prepend(  $this->view->code . ' Error' );
    }

    private function _applicationError()
    {
        $fullMessage = $this->_notifier->getFullErrorMessage();
		$this->view->stack = nl2br($fullMessage);
       	$this->_notifier->notify();
    }
    public function errornoauthAction(){
    	
    }
}
	