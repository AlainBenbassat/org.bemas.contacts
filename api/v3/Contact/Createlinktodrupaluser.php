<?php
use CRM_Contacts_ExtensionUtil as E;

/**
 * Contact.Createlinktodrupaluser API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_contact_Createlinktodrupaluser_spec(&$spec) {
}

/**
 * Contact.Createlinktodrupaluser API
 *
 * @param array $params
 *
 * @return array
 *   API result descriptor
 *
 * @see civicrm_api3_create_success
 *
 * @throws API_Exception
 */
function civicrm_api3_contact_Createlinktodrupaluser($params) {
  $dao = getDaoContactsWithoutLink();
  while ($dao->fetch()) {
    createLinkToDrupalUser($dao->contact_id, $dao->history_id);
  }
  return civicrm_api3_create_success($returnValues, $params, 'Contact', 'Createlinktodrupaluser');

}

function getDaoContactsWithoutLink() {
  $sql = "
    select
      c.id contact_id,
      max(idh.id) history_id
    FROM
      civicrm_contact c
    inner join
      civicrm_value_contact_id_history idh on c.id = idh.entity_id
    where
      identifier_type = '1'
    and not exists
      (select * from civicrm_website w where w.website_type_id = 15 and w.contact_id = c.id)
    group by
      idh.entity_id
  ";
  return CRM_Core_DAO::executeQuery($sql);
}

function createLinkToDrupalUser($contact_id, $history_id) {
  $drupalId = CRM_Core_DAO::singleValueQuery("select identifier from civicrm_value_contact_id_history where id = $history_id");
  $params = [
    'contact_id' => $contact_id,
    'website_type_id' => 15,
    'url' => "https://www.bemas.org/user/$drupalId",
  ];
  civicrm_api3('Website', 'create', $params);
}
