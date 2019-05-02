<?php

require_once 'contacts.civix.php';
use CRM_Contacts_ExtensionUtil as E;


function contacts_civicrm_buildForm($formName, &$form) {
  // check the language when editing a person
  if ($formName == 'CRM_Contact_Form_Contact' && CRM_Core_Action::UPDATE && $form->_contactType == 'Individual') {
    // get the language of the form
    $formLang = $form->_preEditValues['preferred_language'];

    if ($formLang) {
      // get the language of the CMS
      $cmsLang = CRM_Utils_System::getUFLocale();

      // make sure the CMS is in Dutch when editing a Dutch contact, French when French...
      if ($formLang != $cmsLang) {
        // warning!
        if ($cmsLang == 'fr_FR') {
          CRM_Core_Session::setStatus("La langue de la personne est $formLang, mais la langue du site est $cmsLang.<br><br>Changer d'abord la langue du site sinon les salutations seront erronées!", 'Attention', 'warning');
        }
        else {
          CRM_Core_Session::setStatus("De taal van de persoon is $formLang, maar de taal van de website is $cmsLang.<br><br>Verander eerst de taal van de site of de aanspreking e.d. is verkeerd!", 'Opgelet', 'warning');
        }
      }
    }
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
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function contacts_civicrm_xmlMenu(&$files) {
  _contacts_civix_civicrm_xmlMenu($files);
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
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function contacts_civicrm_postInstall() {
  _contacts_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function contacts_civicrm_uninstall() {
  _contacts_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function contacts_civicrm_enable() {
  _contacts_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function contacts_civicrm_disable() {
  _contacts_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function contacts_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _contacts_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function contacts_civicrm_managed(&$entities) {
  _contacts_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function contacts_civicrm_caseTypes(&$caseTypes) {
  _contacts_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function contacts_civicrm_angularModules(&$angularModules) {
  _contacts_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function contacts_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _contacts_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function contacts_civicrm_entityTypes(&$entityTypes) {
  _contacts_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function contacts_civicrm_preProcess($formName, &$form) {

} // */

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
