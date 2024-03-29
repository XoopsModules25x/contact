<div id="help-template" class="outer">
    <{include file=$smarty.const._MI_CONTACT_HELP_HEADER}>

    <h4 class="odd">DESCRIPTION</h4> <br>

    'Contact Us' is a very simple module. It provides a Main Menu link to a
    contact form that visitors can use to email the website Administrator.


    You can set the content of the Contact Us form in 'Preferences'<br><br>

    <h4 class="odd">INSTALL/UNINSTALL</h4><br>

    No special measures necessary, follow the standard installation process –
    extract the /contact folder into the ../modules directory. Install the
    module through Admin -> System Module -> Modules. <br><br>
    Detailed instructions on installing modules are available in the
    <a href="https://goo.gl/adT2i">XOOPS Operations Manual</a><br><br>


    <h4 class="odd">OPERATING INSTRUCTIONS</h4><br>
    There is nothing really to do on the Admin site, except setting preferences.<br><br>

    <h4 class="odd">TUTORIAL - Module preferences</h4>

    <h5 class="even">Options for Captcha</h5>
    <p>
        Here you can define, whether you want use Google reCaptcha or not.<br><br>
        If you want to use reCaptcha, you have to register your website at Google first.
        In order to get the necessary website-key, do following steps:
    <ul>
        <li>If you are not registered at Google, you have to register yourself first</li>
        <li>Goto website https://www.google.com/recaptcha/admin</li>
        <li>Simply enter your corresponding website (label and domain):<br>
            <img src="<{$xoops_url}>/modules/contact/assets/images/help/recaptcha_01_en.jpg" alt="recaptcha01" title="recaptcha01">
        </li>
        <li>After clicking on "Register" you get a new site with the required website-key:<br>
            <img src="<{$xoops_url}>/modules/contact/assets/images/help/recaptcha_02_en.jpg" alt="recaptcha02" title="recaptcha02">
        </li>
        <li>Copy the website-key and paste it to module preferences</li>
        <li>done</li>
    </ul>
    <br><br>
    More about Google reCaptcha under https://www.google.com/recaptcha.<br><br>
    </p>

    <h5 class="odd">Form options</h5>
    <p>
        Here you can define, which additional fields you want provide in your contact form.<br><br></p>

    <h5 class="odd">Options for usage of departments/recipients</h5>
    <p>
        This option allow you to define a department/email combination.<br>
        Users selecting from a defined department will have their contact information sent to the corresponding email address you define.<br><br>
        Define each department/email as follows:<br>
        "dept1,email1|dept2,email2|dept3,email3" etc. - each department and email must be separated by a comma ',', and each department email combination must be separated by a pipe '|'<br><br>
        If no department/recipient is defined, than the mail will be sent to standard email address.<br>
        This option will be only used, if the option "Show select Departments" is set "yes".<br><br>
        With the options "Add Department as Prefix?" and "Additional Email's Subject Prefix" you can define, that the selected department with the additional text will be used before the subject text, given by the contacting person, e.g. "[Contact dept1]: Subject text original". this will also only
        used, if the option "Show select Departments" is set "yes".<br><br>
        If no department is defined or the option "Show select Departments" is set "no", the contact mail will be automatically sent only to standard email address.<br><br></p>

    <h5 class="odd">Options Information</h5>
    <h6 class="odd">Header contact form</h6>
    <p>
        Here you can define a welcome or information text, which will be shown on the top of the contact form. You can use html-code.<br><br></p>

    <h6 class="odd">Embed google maps</h6>
    <p>
        If you want to embed your location with google maps, than you must paste the corresponding code for the iframe here.
        To get the correct iframe-code, do following steps:
    <ul>
        <li>Search the location in google maps</li>
        <li>Click on "Settings":<br>
            <img src="<{$xoops_url}>/modules/contact/assets/images/help/maps_01_en.jpg" alt="maps01" title="maps01">
        </li>
        <li>After click on "Share or embed map" select tab "Embed map":<br>
            <img src="<{$xoops_url}>/modules/contact/assets/images/help/maps_02_en.jpg" alt="maps02" title="maps02">
        </li>
        <li>Copy the iframe-Code and paste it in module preferences</li>
        <li>If necessary, change width of iframe to 100 %.</li>
        <li>done</li>
    </ul>
    <br><br></p>

    <h5 class="odd">Misc options</h5>
    <h6 class="odd">Standard recipient</h6>
    <p>
        Each contact will be sent to this email address. If no email address is defined, the contact mails will be sent to site webmaster (Admin email address in xoops general settings).<br><br></p>

    <h6 class="odd">Send confirmation mail?</h6>
    <p>
        You can define that automatically a confirmation mail is sent to the email, given by the contact form. This confirmation mail contains the given subject and mail content. You can change this text in language file main.php under _MD_CONTACT_MAILCONFIRM_BODY.
        <br><br></p>

</div>
