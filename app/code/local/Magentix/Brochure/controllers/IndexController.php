<?php
 
class Magentix_Brochure_IndexController extends Mage_Core_Controller_Front_Action {
 
    const XML_PATH_EMAIL_RECIPIENT  = 'brochure/email/recipient_email';
    const XML_PATH_EMAIL_SENDER     = 'brochure/email/sender_email_identity';
    const XML_PATH_EMAIL_TEMPLATE   = 'brochure/email/email_template';
    const XML_PATH_ENABLED          = 'brochure/brochure/enabled';
 
    public function preDispatch() {
        parent::preDispatch();
 
        if( !Mage::getStoreConfigFlag(self::XML_PATH_ENABLED) ) {
            $this->norouteAction();
        }
    }
 
    public function indexAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('brochureForm')->setFormAction( Mage::getUrl('*/*/post') );
 
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('catalog/session');
        $this->renderLayout();
    }
 
    public function postAction() {
        $post = $this->getRequest()->getPost();
        if ($post) {
            $translate = Mage::getSingleton('core/translate');
            /* @var $translate Mage_Core_Model_Translate */
            $translate->setTranslateInline(false);
 
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);
 
                $error = false;
 
                if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) $error = true;
                if (!Zend_Validate::is(trim($post['address']) , 'NotEmpty')) $error = true;
 
                if ($error) throw new Exception();
 
                $mailTemplate = Mage::getModel('core/email_template');
                /* @var $mailTemplate Mage_Core_Model_Email_Template */
                $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                    /* L'adresse de réponse est ici l'adresse de l'expéditeur définie dans l'administration */
                    ->setReplyTo(Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER))
                    ->sendTransactional(
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT),
                        null,
                        array('data' => $postObject)
                    );
 
                if (!$mailTemplate->getSentSuccess()) {
                    throw new Exception();
                }
 
                $translate->setTranslateInline(true);
 
                Mage::getSingleton('customer/session')->addSuccess(Mage::helper('brochure')->__('Your inquiry was submitted'));
 
                $this->_redirect('*/*/');
 
                return;
            } catch (Exception $e) {
                $translate->setTranslateInline(true);
 
                Mage::getSingleton('customer/session')->addError(Mage::helper('brochure')->__('Unable to submit your request. Please, try again later'));
                $this->_redirect('*/*/');
                return;
            }
 
        } else {
            $this->_redirect('*/*/');
        }
    }
}