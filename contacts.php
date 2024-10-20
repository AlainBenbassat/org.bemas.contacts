<?php

require_once 'contacts.civix.php';
use CRM_Contacts_ExtensionUtil as E;


function contacts_civicrm_buildForm($formName, &$form) {
  if (CRM_Bemascontacts_Helper::updatingIndividual($formName, $form)) {
    CRM_Bemascontacts_Language::showWarningOrSetDefaultLanguage($form);
  }
}

function contacts_civicrm_postCommit($op, $objectName, $objectId, &$objectRef) {
  if (CRM_Bemascontacts_Helper::savingMemberContactRelationship($objectName, $objectRef)) {
    CRM_Bemascontacts_Relationship::writeBemasFunctionIntoMainAddress($objectRef->contact_id_a);
  }
  elseif (CRM_Bemascontacts_Helper::savingIndividual($op, $objectName)) {
    CRM_Bemascontacts_Relationship::writeBemasFunctionIntoMainAddress($objectId);
  }
}

function contacts_civicrm_custom($op, $groupID, $entityID, &$params) {
  if (CRM_Bemascontacts_Helper::savingIndividualDetails($op, $groupID)) {
    CRM_Bemascontacts_Relationship::writeBemasFunctionIntoMainAddress($entityID);
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function contacts_civicrm_config(&$config) {
  _contacts_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function contacts_civicrm_install() {
  _contacts_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function contacts_civicrm_enable() {
  _contacts_civix_civicrm_enable();
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *

 // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function contacts_civicrm_navigationMenu(&$menu) {
  _contacts_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _contacts_civix_navigationMenu($menu);
} // */
