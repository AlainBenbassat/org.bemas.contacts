<?php

class CRM_Bemascontacts_Language {
  public static function showWarningOrSetDefaultLanguage($form) {
    $tsLang = self::getCurrentLocale();
    $formLang = self::getPreferredLanguage($form);

    if (empty($formLang)) {
      self::setDefaultLanguage($form, $tsLang);
    }
    else {
      self::showWarningIfDifferentLanguages($formLang, $tsLang);
    }
  }

  private static function getPreferredLanguage($form) {
    return $form->_preEditValues['preferred_language'];
  }

  private static function getCurrentLocale() {
    return CRM_Core_I18n::getLocale();
  }

  private static function setDefaultLanguage($form, $tsLang) {
    $defaults['preferred_language'] = $tsLang;
    $form->setDefaults($defaults);
  }

  private static function showWarningIfDifferentLanguages($formLang, $tsLang) {
    if ($formLang != $tsLang) {
      if ($tsLang == 'fr_FR') {
        CRM_Core_Session::setStatus("La langue de la personne est $formLang, mais la langue du site est $tsLang.<br><br>Changez d'abord la langue du site sinon la civilité et les salutations seront erronées !", 'Attention', 'warning', ['expires' => 0]);
      }
      else {
        CRM_Core_Session::setStatus("De taal van de persoon is $formLang, maar de taal van de website is $tsLang.<br><br>Verander eerst de taal van de site of het voorvoegsel en de aanspreking zijn verkeerd!", 'Opgelet', 'warning', ['expires' => 0]);
      }
    }
  }
}
