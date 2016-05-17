<!-- Header -->
<{includeq file='db:contact_admin_header.tpl'}>
<div class="contact">
    <{if $form}><{$form}><{/if}>
    <{if $logs}>
    <div class="pad2">
        <ul>
            <{foreach item=log from=$logs}>
            <li><{$log}></li>
            <{/foreach}>
        </ul>
    </div>
    <{/if}>
</div>
<!-- Footer -->
<{includeq file='db:contact_admin_footer.tpl'}>