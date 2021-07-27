<i id='contact'></i>
<link rel="stylesheet" href='<{xoAppUrl}>modules/contact/assets/css/contact.css' type="text/css" property=""/>

<{if $block.info}>
<div class="row center bg-contact" style="padding-bottom: 20px; padding-top: 5px;">
	<{$block.info}>
</div>
<{/if}>

<div class="row">
<{if $block.map}>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bg-contact">
<{elseif !$block.map}>
    <div class="contact-form col-xs-12 col-sm-12 col-md-12 col-lg-12 bg-contact">
<{/if}>
        <{if $block.contact_default}>
			<div id="contact-default" class="col-xs-12 contact-default-text bg-contact">
				<{$block.contact_default}>
			</div>
		<{/if}>
	</div>


<{if $block.map}>
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 bg-contact">
		<{$block.map}>
	</div>
<{/if}>
</div>