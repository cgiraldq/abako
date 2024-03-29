<?php
require_once Mage::getModuleDir('controllers', 'Mage_Contacts') . DS . 'IndexController.php';
class parsonii_Customcontact_IndexController extends Mage_Contacts_IndexController
{
    public function postAction()
    {
        $post = $this->getRequest()->getPost();
        if ( $post ) {
            $translate = Mage::getSingleton('core/translate');
            /* @var $translate Mage_Core_Model_Translate */
            $translate->setTranslateInline(false);
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);
 
                $error = false;
 
                if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
                    $error = true;
                }
 
                if (!Zend_Validate::is(trim($post['comment']) , 'NotEmpty')) {
                    $error = true;
                }
 
                if (!Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                    $error = true;
                }
 
                if (Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
                    $error = true;
                }
 
                /**************************************************************/
                $fileName = '';
                if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '') {
                    try {
                        $fileName       = $_FILES['attachment']['name'];
                        $fileExt        = strtolower(substr(strrchr($fileName, ".") ,1));
                        $fileNamewoe    = rtrim($fileName, $fileExt);
                        $fileName       = preg_replace('/\s+', '', $fileNamewoe) . time() . '.' . $fileExt;
 
                        $uploader       = new Varien_File_Uploader('attachment');
                        $uploader->setAllowedExtensions(array('doc', 'docx','pdf', 'jpg', 'png', 'zip')); //add more file types you want to allow
                        $uploader->setAllowRenameFiles(false);
                        $uploader->setFilesDispersion(false);
                        $path = Mage::getBaseDir('media') . DS . 'contacts';
                        if(!is_dir($path)){
                            mkdir($path, 0777, true);
                        }
                        $uploader->save($path . DS, $fileName );
                      echo "error en archivo";
                      exit();
                    } catch (Exception $e) {
                                Mage::getSingleton('customer/session')->addError($e->getMessage());
                        $error = true;
                    }
                }
                /**************************************************************/
 
                if ($error) {
                    throw new Exception();
                }
                $mailTemplate = Mage::getModel('core/email_template');
                /* @var $mailTemplate Mage_Core_Model_Email_Template */
 
                /**************************************************************/
                //sending file as attachment
                $attachmentFilePath = Mage::getBaseDir('media'). DS . 'contacts' . DS . $fileName;
                if(file_exists($attachmentFilePath)){
                    $fileContents = file_get_contents($attachmentFilePath);
                    $attachment   = $mailTemplate->getMail()->createAttachment($fileContents);
                    $attachment->filename = $fileName;
                }
                /**************************************************************/
 
                $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                    ->setReplyTo($post['email'])
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
 
                Mage::getSingleton('customer/session')->addSuccess(Mage::helper('contacts')->__('Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.'));
                $this->_redirect('*/*/');
 
                return;
            } catch (Exception $e) {
                $translate->setTranslateInline(true);
 
                Mage::getSingleton('customer/session')->addError(Mage::helper('contacts')->__('Unable to submit your request. Please, try again later'));
                $this->_redirect('*/*/');
                return;
            }
 
        } else {
            $this->_redirect('*/*/');
        }
    }
}