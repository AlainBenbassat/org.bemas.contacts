<?php

class CRM_Bemascontacts_Helper {
  public static function updatingIndividual($formName, $form) {
    if ($formName == 'CRM_Contact_Form_Contact' && $form->getAction() == CRM_Core_Action::UPDATE && $form->_contactType == 'Individual') {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
}
