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

  public static function savingMemberContactRelationship($objectName, $objectRef) {
    if ($objectName == 'Relationship' && self::isMemberContactRelationshipType($objectRef->relationship_type_id)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  public static function savingIndividual($op, $objectName) {
    if ($objectName == 'Individual' && ($op == 'create' || $op == 'edit')) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  public static function savingIndividualDetails($op, $groupID) {
    if ($groupID == 19 && ($op == 'create' || $op == 'edit')) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  private static function isMemberContactRelationshipType($relationshipTypeId) {
    // (Primary) Member Contact of
    if ($relationshipTypeId == 14 || $relationshipTypeId == 15) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
}
