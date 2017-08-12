<link rel="stylesheet" href='<{xoAppUrl}>modules/contact/assets/css/contact.css' type="text/css" property=""/>

<{if $block.recaptcha}>
<script src='https://www.google.com/recaptcha/api.js'></script>
<{/if}>

<{if $block.info}>
<div id="about" class="row center bg-contact" style="padding-bottom: 20px; padding-top: 5px;">
	<{$block.info}>
</div>
<{/if}>

<{if $block.contact_default}>
<div id="contact-default" class="row contact-default-text center bg-contact" style="padding-bottom: 20px; padding-top: 5px;">
	<{$block.contact_default}>
</div>
<{/if}>

<div class="row">
<{if $block.map}>
    <div class="contact-map col-xs-12 col-sm-6 col-md-6 col-lg-6 bg-contact">
<{elseif !$block.map}>
    <div class="contact-form col-xs-12 col-sm-12 col-md-12 col-lg-12 bg-contact">
<{/if}>
        <form name="save" id="save" class="form-horizontal" action="<{xoAppUrl}>modules/contact/send.php" onsubmit="return xoopsFormValidate_save();" method="post" enctype="multipart/form-data">
            <{securityToken}><{*//mb*}>
            <div class="form-group">
                <label for="contact_name" class="col-sm-2 control-label"><{$block.lng_username}></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="<{$block.lng_username_info}>">
                </div>
            </div>
            <div class="form-group">
                <label for="contact_mail" class="col-sm-2 control-label"><{$block.lng_email}></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_mail" name="contact_mail" placeholder="<{$block.lng_email_info}>">
                </div>
            </div>
            <{if $block.url}>
            <div class="form-group">
                <label for="contact_url" class="col-sm-2 control-label"><{$block.lng_url}></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_url" name="contact_url" placeholder="<{$block.lng_url_info}>">
                </div>
            </div>
            <{/if}>
            <{if $block.company}>
            <div class="form-group">
                <label for="contact_company" class="col-sm-2 control-label"><{$block.lng_company}></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_company" name="contact_company" placeholder="<{$block.lng_company_info}>">
                </div>
            </div>
            <{/if}>
            <{if $block.address}>
            <div class="form-group">
                <label for="contact_address" class="col-sm-2 control-label"><{$block.lng_address}></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_address" name="contact_address" placeholder="<{$block.lng_address_info}>">
                </div>
            </div>
            <{/if}>
            <{if $block.location}>
            <div class="form-group">
                <label for="contact_location" class="col-sm-2 control-label"><{$block.lng_location}></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_location" name="contact_location" placeholder="<{$block.lng_location_info}>">
                </div>
            </div>
            <{/if}>
            <{if $block.phone}>
            <div class="form-group">
                <label for="contact_phone" class="col-sm-2 control-label"><{$block.lng_phone}></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="<{$block.lng_phone_info}>">
                </div>
            </div>
            <{/if}>
            <{if $block.icq}>
            <div class="form-group">
                <label for="contact_icq" class="col-sm-2 control-label"><{$block.lng_icq}></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_icq" name="contact_icq" placeholder="<{$block.lng_icq_info}>">
                </div>
            </div>
            <{/if}>
            <{if $block.skype}>
            <div class="form-group">
                <label for="contact_skype" class="col-sm-2 control-label"><{$block.lng_skypename}></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_skype" name="contact_skype" placeholder="<{$block.lng_skypename_info}>">
                </div>
            </div>
            <{/if}>
            <{if $block.depart}>
            <div class="form-group">
                <label for="contact_department" class="col-sm-2 control-label"><{$block.lng_department}></label>
                <div class="col-sm-10">
                    <select type="text" class="form-control" name="contact_department">
                        <{foreach from=$block.departments item=department}>
                            <{html_options values=$department output=$department selected=$department}>
                        <{/foreach}>
                    </select>
                </div>
            </div>
            <{/if}>
            <div class="form-group">
                <label for="contact_subject" class="col-sm-2 control-label"><{$block.lng_subject}></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_subject" name="contact_subject" placeholder="<{$block.lng_subject_info}>">
                </div>
            </div>
            <div class="form-group">
                <label for="contact_message" class="col-sm-2 control-label"><{$block.lng_message}></label>
                <div class="col-sm-10">
                    <textarea name="contact_message" id="contact_message" class="form-control" rows="3" placeholder="<{$block.lng_message_info}>"></textarea>
                </div>
            </div>
            
            <input type="hidden" name="op" id="op" value="save">
            <input type="hidden" name="contact_id" id="contact_id" value="">
            <input type="hidden" name="contact_uid" id="contact_uid" value="0">

            <{if $block.recaptcha}>
            <div class="g-recaptcha" data-sitekey="<{$block.recaptchakey}>"></div>
            <{/if}>
            <div class="center">
                <input type="submit" class="btn btn-primary center" name="submit" id="submit" value="<{$block.lng_submit}>" title="<{$block.lng_submit}>" style="margin: 10px 0;" />
            </div>
		</form>
	</div>


<{if $block.map}>
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 bg-contact">
		<{$block.map}>
	</div>
<{/if}>
</div>
<!-- Start Form Validation JavaScript //-->
<script type='text/javascript'>

<!--//
function xoopsFormValidate_save() { var myform = window.document.save; 
if (myform.contact_name.value == "") { window.alert("<{$block.lng_username_info}>"); myform.contact_name.focus(); return false; }

if (myform.contact_mail.value == "") { window.alert("<{$block.lng_email_info}>"); myform.contact_mail.focus(); return false; }

if (myform.contact_subject.value == "") { window.alert("<{$block.lng_subject_info}>"); myform.contact_subject.focus(); return false; }

if (myform.contact_message.value == "") { window.alert("<{$block.lng_message_info}>"); myform.contact_message.focus(); return false; }
return true;
}
//--></script>
