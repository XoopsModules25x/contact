<?php
// Module Info
// The name of this module
define('_MI_CONTACT_NAME', 'Kontakt');
define('_MI_CONTACT_DESC', 'Modul für Kontaktformular (mit Speicherung in Datenbank)');
// Admin menu
define('_MI_CONTACT_MENU_HOME', 'Übersicht');
define('_MI_CONTACT_MENU_HOME_DESC', 'Gehe zur Übersicht');
define('_MI_CONTACT_MENU_CONTACT', 'Kontakt');
define('_MI_CONTACT_MENU_CONTACT_DESC', 'Liste der Anfragen');
define('_MI_CONTACT_MENU_TOOLS', 'Werkzeuge');
define('_MI_CONTACT_MENU_TOOLS_DESC', 'Modul-Werkzeuge');
define('_MI_CONTACT_MENU_LOGS', 'Logs');
define('_MI_CONTACT_MENU_LOGS_DESC', 'Logs anzeigen');
define('_MI_CONTACT_MENU_ABOUT', 'Über');
define('_MI_CONTACT_MENU_ABOUT_DESC', 'Über dieses Modul');
define('_MI_CONTACT_MENU_HELP', 'Hilfe');
define('_MI_CONTACT_MENU_HELP_DESC', 'Hilfe zum Modul');
// Module Settings
define('_MI_CONTACT_FORM_URL', 'URL abfragen');
define('_MI_CONTACT_FORM_URL_DESC', '');
define('_MI_CONTACT_FORM_ICQ', 'ICQ abfragen');
define('_MI_CONTACT_FORM_ICQ_DESC', '');
define('_MI_CONTACT_FORM_COMPANY', 'Firma abfragen');
define('_MI_CONTACT_FORM_COMPANY_DESC', '');
define('_MI_CONTACT_FORM_LOCATION', 'Ort abfragen');
define('_MI_CONTACT_FORM_LOCATION_DESC', '');
define('_MI_CONTACT_FORM_PHONE', 'Telefon abfragen');
define('_MI_CONTACT_FORM_PHONE_DESC', '');
define('_MI_CONTACT_FORM_ADDRESS', 'Adresse abfragen');
define('_MI_CONTACT_FORM_ADDRESS_DESC', '');
define('_MI_CONTACT_FORM_DEPT', 'Auswahl für Abteilungen anzeigen');
define('_MI_CONTACT_FORM_DEPT_DESC', '');
define('_MI_CONTACT_DEPT', 'Abteilungen/Empfänger');
define('_MI_CONTACT_DEPT_DESC', 'Diese Option erlaubt die Angabe/Kombination von verschiedenen Abteilungen/Empfängern.<br>'
                                . 'Je nach Benutzerauswahl erhält die entsprechende Abteilung die jeweilige Kontaktinformation an die dafür definierte E-Mail-Adresse.<br><br>'
                                . 'Definiere jede Abteilung/E-Mail wie folgt:<br><br>'
                                . "abteilung1,email1|abteilung2,email2|abteilung3,email3 etc. - jede Abteilung muss von der E-Mail mit einem Beistrich ',' getrennt sein,<br>"
                                . "und jede Kombination Abteilung/E-Mail muss durch einen Strich '|' getrennt sein.<br><br>"
                                . 'Wenn keine Abteilung/kein Empfänger angegeben wird, wird die Mailnachricht an die Standard-E-Mail-Adresse versendet.');
define('_MI_CONTACT_PERPAGE', 'Anfragen pro Seite');
define('_MI_CONTACT_PERPAGE_DESC', '');
define('_MI_CONTACT_TOPINFO', 'Überschrift des Kontaktformulars');
define('_MI_CONTACT_TOPINFO_DESC', 'Kann HTML Code beinhalten');
define('_MI_CONTACT_HEAD_OPTIONS', 'Formularoptionen');
define('_MI_CONTACT_HEAD_ADMIN', 'Administration');
define('_MI_CONTACT_HEAD_INFO', 'Information');
//1.81
define('_MI_CONTACT_MAP', 'Google Maps einbetten');
define('_MI_CONTACT_MAP_DESC', "Google Maps iframe einbetten<br> ändert iframe in '100%'");
//2.1
define('_MI_CONTACT_FORM_SKYPE', 'Skypename abfragen');
define('_MI_CONTACT_FORM_SKYPE_DESC', '');

define('_MI_CONTACT_SUBJECT_PREFIX', 'Abteilung als Präfix verwenden?');
define('_MI_CONTACT_SUBJECT_PREFIX_DESC', 'Wenn ja, dann wird der Name der Abteilung als Präfix im E-Mail-Betreff verwendet');
define('_MI_CONTACT_PREFIX_TEXT', 'Zusatz Präfix Email-Betreff');
define('_MI_CONTACT_PREFIX_TEXT_DESC', 'Dieser Text wird vor dem Präfix Abteilung im E-Mail-Betreff verwendet');
define('_MI_CONTACT_PREFIX_TEXT_DEFAULT', 'Kontakt');
//2.21
define('_MI_CONTACT_HEAD_CAPTCHA', 'Optionen für Captcha');
define('_MI_CONTACT_FORM_RECAPTCHA_USE', 'Google reCaptcha verwenden?');
define('_MI_CONTACT_FORM_RECAPTCHA_USE_DESC', 'Wähle <em>Ja</em>, um reCaptcha im Eingabeformular zu verwenden.<br>Standard: <em>Nein</em>');
define('_MI_CONTACT_FORM_RECAPTCHA_KEY', 'Ihr reCaptcha-Sicherheitsschlüssel');
define('_MI_CONTACT_FORM_RECAPTCHA_KEY_DESC', "Mehr über Google reCaptcha unter https://www.google.com/recaptcha <br>und unter 'Hilfe'.");
define('_MI_CONTACT_HEAD_DEPT', 'Optionen für die Verwendung von Abteilungen');
define('_MI_CONTACT_HEAD_MISC', 'Sonstige Optionen');
define('_MI_CONTACT_MAIL_CONFIRM', 'Bestätigungsmail senden?');
define('_MI_CONTACT_MAIL_CONFIRM_DESC', 'Wenn ja, wird an die angegebene E-Mail-Adresse eine kurze Bestätigungsmail mit den wichtigsten Informationen gesendet');
define('_MI_CONTACT_RECIPIENT_STD', 'Standardempfänger');
define('_MI_CONTACT_RECIPIENT_STD_DESC', 'An diese E-Mail-Adresse wird jede Kontaktanfrage per Mail gesendet');

//2.23
define('_MI_B_CONTACT_FORM', 'Kontaktformular');
define('_MI_B_CONTACT_FORM_DESC', 'Ein Kontaktformular als Block anzeigen');
define('_MI_B_CONTACT_MAP', 'Standort');
define('_MI_B_CONTACT_MAP_DESC', 'Den definierten Standort in Google Maps als Block anzeigen');
define('_MI_B_CONTACT_FORM_MAP', 'Kontaktformular und Standort');
define('_MI_B_CONTACT_FORM_MAP_DESC', 'Ein Kontaktformular zusammen mit dem Standort in Google Maps als Block anzeigen');

define('_MI_CONTACT_DEFAULT', 'Standard-Kontaktdaten');
define('_MI_CONTACT_DEFAULT_DESC', 'Hier können die Kontaktdaten angegeben werden, die zusätzlich zum Formular angezeigt werden sollen (z.B. Name, Adresse , Telefonnummer,...');
