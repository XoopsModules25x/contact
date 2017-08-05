<div id="help-template" class="outer">
    <h1 class="head">Hilfe:
        <a class="ui-corner-all tooltip" href="<{$xoops_url}>/modules/contact/admin/index.php"
           title="Zurück zur Verwaltung von Kontakt"> Kontakt
            <img src="<{xoAdminIcons home.png}>"
                 alt="Zurück zur Verwaltung von Kontakt"/>
        </a></h1>

    <h4 class="odd">Beschreibung</h4>
    <p>
    'Kontakt' ist ein sehr einfaches Modul.
    Das Kontaktformular kann über einen Menüeintrag im Hauptmenü aufgerufen werden.<br/>
    Die Inhalte des Kontaktformulars können über die Moduleinstellungen verwaltet werden.<br/><br/></p>
    
    <h4 class="odd">(De-)Installation</h4>
    <p>
    Es sind keine speziellen Maßnahmen erforderlich, führen Sie den Standardinstallationsprozess aus:<br/>
    - Extrahieren Sie den Ordner 'contact' in das Module-Verzeichnis<br/>
    - Installieren Sie das Modul über Administration -> Module.<br/><br/>
    Wenn Sie zusätzliche Informationen benötigen, lesen Sie die Installationshinweise unter
    <a href="http://goo.gl/adT2i">XOOPS Operations Manual</a><br/><br/></p>

    <h4 class="odd">Grundsätzliche Informationen</h4>
    <p>
    Die Inhalte des Kontaktformulars können über die Moduleinstellungen verwaltet werden.<br/><br/>Auf die Anfragen kann direkt geantwortet werden.<br/><br/>Die Inhalte der Anfragen und Antworten werden in Tabellen gespeichert.<br/><br/></p>
    
    <h4 class="odd">Tutorial - Moduleinstellungen</h4>
    
    <h5 class="even">Optionen für Captcha</h5>
    <p>
    Hier können Sie festlegen, ob Sie Google reCaptcha verwenden möchten.<br><br>
    Wenn Sie reCaptcha verwenden möchten, müssen Sie Ihre Webseite zuvor bei Google reCaptcha registrieren.
    Um den erforderlichen Webseitenschlüssel zu erhalten, gehen Sie dazu wie folgt vor:
    <ul>
        <li>Wenn Sie nicht bei Google registriert sind, müssen Sie sich zuerst bei registrieren</li>
        <li>Aufruf der Webseite https://www.google.com/recaptcha/admin</li>
        <li>Einfach die gewünschte Webseite (Bezeichnung und Url) angeben:<br>
        <img src="<{$xoops_url}>/modules/contact/assets/images/help/recaptcha_01_de.jpg" alt="recaptcha01" title="recaptcha01" />
        </li>
        <li>Nach dem Klick auf "Registrieren" erscheint eine neue Seite mit dem erforderlichen Webseitenschlüssel:<br>
        <img src="<{$xoops_url}>/modules/contact/assets/images/help/recaptcha_02_de.jpg" alt="recaptcha02" title="recaptcha02" />
        </li>
        <li>Den Webseitenschlüssel kopieren und in der Moduleinstellung eintragen</li>
        <li>fertig</li>        
    </ul>
    <br><br>
    Mehr über Google reCaptcha unter https://www.google.com/recaptcha.<br><br>
    </p>
    
    <h5 class="odd">Formularoptionen</h5>
    <p>
    Hier können Sie festlegen, ob Sie im Kontaktformular zusätzlich Eingabefelder zur Verfügung stellen möchten.<br><br></p>
    
    <h5 class="odd">Optionen für die Verwendung von Abteilungen</h5>
    <p>
    Diese Option erlaubt die Angabe/Kombination von verschiedenen Abteilungen/Empfängern. Je nach Benutzerauswahl erhält die entsprechende Abteilung die jeweilige Kontaktinformation an die dafür definierte E-Mail-Adresse.<br><br>
    Definiere jede Abteilung/E-Mail wie folgt:<br>
    "abteilung1,email1|abteilung2,email2|abteilung3,email3" etc. - jede Abteilung muss von der E-Mail mit einem Beistrich ',' getrennt sein, und jede Kombination Abteilung/E-Mail muss durch einen Strich '|' getrennt sein.<br><br>
    Diese Option wird jedoch nur angewendet, wenn die Option "Auswahl für Abteilungen anzeigen" mit "Ja" eingestellt wurde.<br><br>
    Mit den Optionen "Abteilung als Präfix verwenden?" und "Zusatz Präfix Email-Betreff" können sie zustäzlich noch festlegen, ob die ausgewählte Abteilung sowie der Zusatztext dem vom Einsender angegebenen Betreff vorangestellt wir, wie z.B. "[Kontakt abteilung1]: Betrefftext Einsender". Dies wird ebenfalls nur angewendet, wenn die Option "Auswahl für Abteilungen anzeigen" mit "Ja" eingestellt wurde.<br><br>
    Wenn keine Abteilung angeben wird oder die Option "Auswahl für Abteilungen anzeigen" mit "Nein" eingestellt wurde, werden die Kontaktanfragen automatisch an den Standard-E-Mail-Empfänger gesendet.<br><br></p>
    
    <h5 class="odd">Optionen Information</h5>
    <h6 class="odd">Überschrift des Kontaktformulars</h6>
    <p>
    Hier können Sie eine Hinweis- oder Begrüßungstext angeben, der oberhalb des Kontaktformulars angezeigt wird. Dabei kann HTML-Code verwendet werden.<br><br></p>
    
    <h6 class="odd">Google Maps einbetten</h6>
    <p>
    Wenn Sie z.B. den Firmenstandort in Google-Maps einbinden wollen, dann bitte hier den ensprechenden iframe-Code angeben.
    Gehen Sie dazu wie folgt vor:
    <ul>
        <li>Den entsprechenden Ort in Google Maps suchen</li>
        <li>Auf "Einstellungen" klicken:<br>
        <img src="<{$xoops_url}>/modules/contact/assets/images/help/maps_01_de.jpg" alt="maps01" title="maps01" />
        </li>
        <li>Nach dem Klick auf "Karte teilen oder einbetten" den Tab "Karte einbetten" wählen:<br>
        <img src="<{$xoops_url}>/modules/contact/assets/images/help/maps_02_de.jpg" alt="maps02" title="maps02" />
        </li>
        <li>Den iframe-Code kopieren und in der Moduleinstellung eintragen</li>
        <li>Falls erforderlich, die Einstellung der Weite des iframes auf 100 % ändern.</li>
        <li>fertig</li>        
    </ul>
    <br><br></p>
 
    <h5 class="odd">Sonstige Optionen</h5>
    <h6 class="odd">Standardempfänger</h6>
    <p>
    An diese E-Mail-Adresse wird jede Kontaktanfrage per Mail gesendet. Wird keine E-Mail-Adresse angegeben, werden die Anfragen an den Webmaster der Seite (Admin E-mail-Adresse aus den Xoops Optionen allgemein) weitergeleitet.<br><br></p>
    
    <h6 class="odd">Bestätigungsmail senden?</h6>
    <p>
    Hier können Sie festlegen, ob an die im Kontaktformular angegebene E-Mail-Adresse automatisch ein Bestätigungsmail versendet wird.<br>
    Das Bestätigungsmail enthält den angegebenen Betreff sowie den Nachrichtentext. Dieser Text kann in der Sprachdatei main.php unter _MD_CONTACT_MAILCONFIRM_BODY geändert werden.<br><br></p>
    
</div>
