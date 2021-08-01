<link rel="stylesheet" href='<{xoAppUrl}>modules/contact/assets/css/contact.css' type="text/css" >

<{if $recaptcha|default:false}>
<script src='https://www.google.com/recaptcha/api.js'></script>
<{/if}>

<{if $show_breadcrumbs|default:false}>
    <ol class="breadcrumb">
        <{$breadcrumb}>
    </ol>
<{/if}>

<{if $info|default:false}>
<div id="about" class="center bg-contact" style="padding-bottom: 20px; padding-top: 5px;">
    <{$info}>
</div>
<{/if}>

<{if $map|default:false}>
<div class="col-md-6 col-sm-12 bg-contact">
<{elseif !$map|default:false}>
<div class="col-sm-12 bg-contact">
<{/if}>
    <{if $contact_default|default:''}>
        <div id="contact-default" class="col-xs-12 col-sm-12 col-md-3 col-lg-3 contact-default-text">
            <{$contact_default}>
        </div>
        <div id="contact-form" class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
    <{else}>
        <div id="contact-form" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <{/if}>

    <form name="save" id="save" action="<{xoAppUrl}>modules/contact/send.php" onsubmit="return xoopsFormValidate_save();" method="post" enctype="multipart/form-data">
        <{securityToken}><{*//mb*}>
        <div class="form-group">
            <label for="contact_name"><{$lng_username|default:''}></label>
            <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="<{$lng_username_info|default:''}>">
          </div>
          <div class="form-group">
            <label for="contact_mail"><{$lng_email|default:''}></label>
            <input type="text" class="form-control" id="contact_mail" name="contact_mail" placeholder="<{$lng_email_info|default:''}>">
          </div>
          <{if $url|default:false}>
          <div class="form-group">
            <label for="contact_url"><{$lng_url|default:''}></label>
            <input type="text" class="form-control" id="contact_url" name="contact_url" placeholder="<{$lng_url_info|default:''}>">
          </div>
          <{/if}>
          <{if $company|default:false}>
          <div class="form-group">
            <label for="contact_company"><{$lng_company|default:''}></label>
            <input type="text" class="form-control" id="contact_company" name="contact_company" placeholder="<{$lng_company_info|default:''}>">
          </div>
          <{/if}>
          <{if $address|default:false}>
          <div class="form-group">
            <label for="contact_address"><{$lng_address|default:''}></label>
            <input type="text" class="form-control" id="contact_address" name="contact_address" placeholder="<{$lng_address_info|default:''}>">
          </div>
          <{/if}>
          <{if $location|default:false}>
          <div class="form-group">
            <label for="contact_location"><{$lng_location|default:''}></label>
            <input type="text" class="form-control" id="contact_location" name="contact_location" placeholder="<{$lng_location_info|default:''}>">
          </div>
          <{/if}>
          <{if $phone|default:false}>
          <div class="form-group">
            <label for="contact_phone"><{$lng_phone|default:''}></label>
            <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="<{$lng_phone_info|default:''}>">
          </div>
          <{/if}>
        <{if $icq|default:false}>
          <div class="form-group">
            <label for="contact_icq"><{$lng_icq|default:''}></label>
            <input type="text" class="form-control" id="contact_icq" name="contact_icq" placeholder="<{$lng_icq_info|default:''}>">
          </div>
          <{/if}>
          <{if $skype|default:false}>
          <div class="form-group">
            <label for="contact_skype"><{$lng_skypename|default:''}></label>
            <input type="text" class="form-control" id="contact_skype" name="contact_skype" placeholder="<{$lng_skypename_info|default:''}>">
          </div>
          <{/if}>
          <{if $depart|default:false}>
          <div class="form-group">
          <label for="contact_department"><{$lng_department}></label>
          <select type="text" class="form-control" name="contact_department">
              <{foreach from=$departments item=department}>
                  <{html_options values=$department output=$department selected=$department}>
            <{/foreach}>
        </select>
        </div>
          <{/if}>
          <div class="form-group">
            <label for="contact_subject"><{$lng_subject|default:''}></label>
            <input type="text" class="form-control" id="contact_subject" name="contact_subject" placeholder="<{$lng_subject_info|default:''}>">
          </div>
          <div class="form-group">
            <label for="contact_message"><{$lng_message|default:''}></label>
              <textarea name="contact_message" id="contact_message" class="form-control" rows="3" placeholder="<{$lng_message_info|default:''}>"></textarea>
          </div>

        <input type="hidden" name="op" id="op" value="save">
          <input type="hidden" name="contact_id" id="contact_id" value="">
          <input type="hidden" name="contact_uid" id="contact_uid" value="<{$contact_uid|default:''}>">

          <{if $recaptcha|default:false}>
          <div class="g-recaptcha" data-sitekey="<{$recaptchakey}>"></div>
          <{/if}>
          <div class="center">
            <input type="submit" class="btn btn-primary center" name="submit" id="submit" value="<{$lng_submit|default:''}>" title="<{$lng_submit|default:''}>" style="margin: 10px 0;" >
        </div>
    </form>

    </div>
</div>
<{if $map|default:false}>
    <div class="col-md-6 col-sm-12 bg-contact">
        <{$map|default:''}>
    </div>
<{/if}>

<!-- Start Form Validation JavaScript //-->
<script type='text/javascript'>

<!--//
function xoopsFormValidate_save() { var myform = window.document.save; 
if (myform.contact_name.value == "") { window.alert("<{$lng_username_info|default:''}>"); myform.contact_name.focus(); return false; }

if (myform.contact_mail.value == "") { window.alert("<{$lng_email_info|default:''}>"); myform.contact_mail.focus(); return false; }

if (myform.contact_subject.value == "") { window.alert("<{$lng_subject_info|default:''}>"); myform.contact_subject.focus(); return false; }

if (myform.contact_message.value == "") { window.alert("<{$lng_message_info|default:''}>"); myform.contact_message.focus(); return false; }
return true;
}
//-->
</script>
