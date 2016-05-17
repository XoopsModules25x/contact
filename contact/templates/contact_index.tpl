<{if $recaptcha}>
<script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>
<{/if}>
<!--
<ol class="breadcrumb breadcrumb-arrow">
	<{$breadcrumb}>
</ol> -->

<ol class="breadcrumb breadcrumb-arrow">
	<li><a href='<{xoAppUrl index.php}>' title='home'><i class="glyphicon glyphicon-home"></i></a></li>
	<{foreach item=itm from=$xoBreadcrumbs name=bcloop}>
		<{if $itm.link}>
			<li><a href='<{$itm.link}>' title='<{$itm.title}>'><{$itm.title}></a></li>
		<{else}>
			<li class="active"><span><{$itm.title}></span></li>
		<{/if}>
	<{/foreach}>
</ol>

<{if $info}>
<div id="about" class="centered" style="padding-bottom: 20px; padding-top: 5px;">
	<{$info}>
</div>
<{/if}>

<{if $map}>
	<div class="col-md-6 col-sm-12">
<{elseif !$map}>
	<div class="col-sm-12">
<{/if}>
	<form name="save" id="save" action="<{xoAppUrl}>modules/contact/send.php" onsubmit="return xoopsFormValidate_save();" method="post" enctype="multipart/form-data">
		<div class="form-group">
	    	<label for="contact_name"><{$lng_username}></label>
	    	<input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="<{$lng_username_info}>">
	  	</div>
	  	<div class="form-group">
	    	<label for="contact_mail"><{$lng_email}></label>
	    	<input type="text" class="form-control" id="contact_mail" name="contact_mail" placeholder="<{$lng_email_info}>">
	  	</div>
	  	<{if $url}>
	  	<div class="form-group">
	    	<label for="contact_url"><{$lng_url}></label>
	    	<input type="text" class="form-control" id="contact_url" name="contact_url" placeholder="<{$lng_url_info}>">
	  	</div>
	  	<{/if}>
	  	<{if $company}>
	  	<div class="form-group">
	    	<label for="contact_company"><{$lng_company}></label>
	    	<input type="text" class="form-control" id="contact_company" name="contact_company" placeholder="<{$lng_company_info}>">
	  	</div>
	  	<{/if}>
	  	<{if $address}>
	  	<div class="form-group">
	    	<label for="contact_address"><{$lng_address}></label>
	    	<input type="text" class="form-control" id="contact_address" name="contact_address" placeholder="<{$lng_address_info}>">
	  	</div>
	  	<{/if}>
	  	<{if $location}>
	  	<div class="form-group">
	    	<label for="contact_location"><{$lng_location}></label>
	    	<input type="text" class="form-control" id="contact_location" name="contact_location" placeholder="<{$lng_location_info}>">
	  	</div>
	  	<{/if}>
	  	<{if $phone}>
	  	<div class="form-group">
	    	<label for="contact_phone"><{$lng_phone}></label>
	    	<input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="<{$lng_phone_info}>">
	  	</div>
	  	<{/if}>
        <{if $icq}>
	  	<div class="form-group">
	    	<label for="contact_url"><{$lng_icq}></label>
	    	<input type="text" class="form-control" id="contact_icq" name="contact_icq" placeholder="<{$lng_icq_info}>">
	  	</div>
	  	<{/if}>
	  	<{if $skype}>
	  	<div class="form-group">
	    	<label for="contact_icq"><{$lng_skypename}></label>
	    	<input type="text" class="form-control" id="contact_icq" name="contact_icq" placeholder="<{$lng_skypename_info}>">
	  	</div>
	  	<{/if}>
	  	<{if $depart}>
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
	    	<label for="contact_subject"><{$lng_subject}></label>
	    	<input type="text" class="form-control" id="contact_subject" name="contact_subject" placeholder="<{$lng_subject_info}>">
	  	</div>
	  	<div class="form-group">
	    	<label for="contact_subject"><{$lng_message}></label>
	  		<textarea name="contact_message" id="contact_message" class="form-control" rows="5" placeholder="<{$lng_message_info}>"></textarea>
	  	</div>
	  	
		  <input type="hidden" name="op" id="op" value="save">
	  	<input type="hidden" name="contact_id" id="contact_id" value="">
	  	<input type="hidden" name="contact_uid" id="contact_uid" value="0">

	  	<{if $recaptcha}>
	  	<div class="g-recaptcha" data-sitekey="<{$recaptchakey}>"></div>
	  	<{/if}>
	  	<input type="submit" class="btn btn-primary" name="submit" id="submit" value="<{$lng_submit}>" title="<{$lng_submit}>" style="margin: 10px 0" />
	</form>
</div>
<{if $map}>
	<div class="col-md-6 col-sm-12">
		<{$map}>
	</div>
<{/if}>
<{if $xoops_isadmin}>
   <br /><div class="text-center bold"><a href="<{$admin}>"><{$smarty.const._MD_CONTACT_ADMIN}></a></div><br />
<{/if}>
<!-- Start Form Validation JavaScript //-->
<script type='text/javascript'>
<!--//
function xoopsFormValidate_save() { var myform = window.document.save; 
if (myform.contact_name.value == "") { window.alert("<{$lng_username_info}>"); myform.contact_name.focus(); return false; }
if (myform.contact_mail.value == "") { window.alert("<{$lng_email_info}>"); myform.contact_mail.focus(); return false; }
if (myform.contact_subject.value == "") { window.alert("<{$lng_subject_info}>"); myform.contact_subject.focus(); return false; }
if (myform.contact_message.value == "") { window.alert("<{$lng_message_info}>"); myform.contact_message.focus(); return false; }
return true;
}
//--></script>
