<div class="contact">
<{if $level == reply}>
<{$navigation}>
<{if $replylist}>
<table class="outer">
    <thead>
    <th><{$smarty.const._AM_CONTACT_SUBJECT}></th>
    <th><{$smarty.const._AM_CONTACT_DATE}></th>
    <th><{$smarty.const._AM_CONTACT_SUBMITTER}></th>
    <th><{$smarty.const._AM_CONTACT_ACTION}></th>
    </thead>
    <tbody class="xo-contact">
    <{foreach item=contact from=$replylist}>
    <tr class="odd" id="mod_<{$contact.contact_id}>">
        <td class="txtcenter bold"><a class="tooltip" title="<{$contact.contact_subject}>" href="main.php?op=view&amp;id=<{$contact.contact_id}>"><{$contact.contact_subject}></a>
        </td>
        <td class="txtcenter width10"><{$contact.contact_create}></td>
        <td class="txtcenter width15"><{$contact.contact_name}> ( <{if $contact.contact_uid}><a title="<{$contact.contact_owner}>"
                                                                                                href="<{$xoops_url}>/userinfo.php?uid=<{$contact.contact_uid}>"><{$contact.contact_owner}></a><{else}><{$contact.contact_owner}><{/if}>
            )
        </td>
        <td class="txtcenter width15 xo-actions">
            <img class="tooltip" onclick="display_dialog(<{$contact.contact_id}>, true, true, 'slide', 'slide', 300, 700);"
                 src="<{xoAdminIcons display.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"/>
            <a class="tooltip" title="<{$smarty.const._AM_CONTACT_VIEW}>" href="main.php?op=view&amp;id=<{$contact.contact_id}>"><img
                    src="<{xoAdminIcons view.png}>" alt="<{$smarty.const._AM_CONTACT_VIEW}>"/></a>
            <a class="tooltip" title="<{$smarty.const._DELETE}>" href="main.php?op=delete&amp;id=<{$contact.contact_id}>"><img
                    src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._DELETE}>"/></a>
        </td>
    </tr>
    <{/foreach}>
    </tbody>
</table>
<{foreach item=contact from=$replylist}>
<div id="dialog<{$contact.contact_id}>" title="<{$contact.contact_subject}>" style='display:none;'>
    <div class="marg5 pad5 ui-state-default ui-corner-all">
        <{$smarty.const._AM_CONTACT_SUBJECT}> : <span class="bold"><{$contact.contact_subject}></span>
    </div>
    <div class="marg5 pad5 ui-state-highlight ui-corner-all">
        <div class="pad5">
            <span class="bold"><{$smarty.const._AM_CONTACT_DEPARTMENT}> : </span><{$contact.contact_department}> |
            <span class="bold"><{$smarty.const._AM_CONTACT_SUBMITTER}> : </span><{$contact.contact_name}> ( <{if $contact.contact_uid}><a
                title="<{$contact.contact_owner}>" href="<{$xoops_url}>/userinfo.php?uid=<{$contact.contact_uid}>"><{$contact.contact_owner}></a><{else}><{$contact.contact_owner}><{/if}>
            ) |
            <span class="bold"><{$smarty.const._AM_CONTACT_DATE}> : </span><{$contact.contact_create}> |
            <{if $contact.contact_phone}><span class="bold"><{$smarty.const._AM_CONTACT_PHONE}> : </span><{$contact.contact_phone}> | <{/if}>
            <{if $contact.contact_mail}><span class="bold"><{$smarty.const._AM_CONTACT_EMAIL}> : </span><{$contact.contact_mail}> | <{/if}>
            <{if $contact.contact_icq}><span class="bold"><{$smarty.const._AM_CONTACT_ICQ}> : </span><{$contact.contact_icq}> | <{/if}>
            <{if $contact.contact_company}><span class="bold"><{$smarty.const._AM_CONTACT_COMPANY}> : </span><{$contact.contact_company}> | <{/if}>
            <{if $contact.contact_location}><span class="bold"><{$smarty.const._AM_CONTACT_LOCATION}> : </span><{$contact.contact_location}> | <{/if}>
            <{if $contact.contact_url}><span class="bold"><{$smarty.const._AM_CONTACT_URL}> : </span><a title="<{$smarty.const._AM_CONTACT_VIEWURL}>"
                                                                                                        href="<{$contact.contact_url}>"><{$smarty.const._AM_CONTACT_VIEWURL}></a>
            | <{/if}>
            <{if $contact.contact_address}><span class="bold"><{$smarty.const._AM_CONTACT_ADDRESS}> : </span><{$contact.contact_address}> | <{/if}>
        </div>
        <div class="clear"></div>
    </div>
    <div class="pad5"><span class="bold"><{$smarty.const._AM_CONTACT_MESSAGE}> : </span><{$contact.contact_message}></div>
</div>
<{/foreach}>
<{/if}>

<{$replyform}>
<{elseif $level == doreply}>

<{elseif $level == view}>
<{$navigation}>
<table class="outer">
    <thead>
    <th class="width10"><{$smarty.const._AM_CONTACT_TITLE}></th>
    <th><{$smarty.const._AM_CONTACT_INFO}></th>
    </thead>
    <tbody class="xo-contact">
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_SUBJECT}></td>
        <td><{$contact.contact_subject}> ( <span class="pad2 bold red"><{$contact.contact_platform}></span> )</td>
    </tr>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_SUBMITTER}></td>
        <td><{$contact.contact_name}> ( <{if $contact.contact_uid}><a title="<{$contact.contact_owner}>"
                                                                      href="<{$xoops_url}>/userinfo.php?uid=<{$contact.contact_uid}>"><{$contact.contact_owner}></a><{else}><{$contact.contact_owner}><{/if}>
            )
        </td>
    </tr>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_DEPARTMENT}></td>
        <td><{$contact.contact_department}></td>
    </tr>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_EMAIL}></td>
        <td><{$contact.contact_mail}></td>
    </tr>
    <{if $contact.contact_url}>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_URL}></td>
        <td><span class="pad5 xo-actions"><a title="<{$smarty.const._AM_CONTACT_VIEWURL}>" href="<{$contact.contact_url}>"><img
                src="<{xoAdminIcons url.png}>" alt="<{$smarty.const._AM_CONTACT_VIEWURL}>"/></a></span> <{$contact.contact_url}>
        </td>
    </tr>
    <{/if}>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_DATE}></td>
        <td><{$contact.contact_create}></td>
    </tr>
    <{if $contact.contact_icq}>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_ICQ}></td>
        <td><{$contact.contact_icq}></td>
    </tr>
    <{/if}>
    <{if $contact.contact_company}>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_COMPANY}></td>
        <td><{$contact.contact_company}></td>
    </tr>
    <{/if}>
    <{if $contact.contact_location}>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_LOCATION}></td>
        <td><{$contact.contact_location}></td>
    </tr>
    <{/if}>
    <{if $contact.contact_phone}>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_PHONE}></td>
        <td><{$contact.contact_phone}></td>
    </tr>
    <{/if}>
    <{if $contact.contact_address}>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_ADDRESS}></td>
        <td><{$contact.contact_address}></td>
    </tr>
    <{/if}>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_IP}></td>
        <td><{$contact.contact_ip}></td>
    </tr>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_MESSAGE}></td>
        <td><{$contact.contact_message}></td>
    </tr>
    <{if $contact.contact_cid == 0}>
    <tr class="odd">
        <td class="bold"><{$smarty.const._AM_CONTACT_ACTION}></td>
        <td class="xo-actions">
            <a class="tooltip" title="<{$smarty.const._AM_CONTACT_REPLY}>" href="main.php?op=reply&amp;id=<{$contact.contact_id}>"><img
                    src="<{xoAdminIcons mail_reply.png}>" alt="<{$smarty.const._AM_CONTACT_REPLY}>"/></a>
            <a class="tooltip" title="<{$smarty.const._DELETE}>" href="main.php?op=delete&amp;id=<{$contact.contact_id}>"><img
                    src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._DELETE}>"/></a>
        </td>
    </tr>
    <{/if}>
    </tbody>
</table>

<{if $replylist}>
<table class="outer">
    <thead>
    <th><{$smarty.const._AM_CONTACT_SUBJECT}></th>
    <th><{$smarty.const._AM_CONTACT_DATE}></th>
    <th><{$smarty.const._AM_CONTACT_SUBMITTER}></th>
    <th><{$smarty.const._AM_CONTACT_ACTION}></th>
    </thead>
    <tbody class="xo-contact">
    <{foreach item=contact from=$replylist}>
    <tr class="odd" id="mod_<{$contact.contact_id}>">
        <td class="txtcenter bold"><a class="tooltip" title="<{$contact.contact_subject}>" href="main.php?op=view&amp;id=<{$contact.contact_id}>"><{$contact.contact_subject}></a>
        </td>
        <td class="txtcenter width10"><{$contact.contact_create}></td>
        <td class="txtcenter width15"><{$contact.contact_name}> ( <{if $contact.contact_uid}><a title="<{$contact.contact_owner}>"
                                                                                                href="<{$xoops_url}>/userinfo.php?uid=<{$contact.contact_uid}>"><{$contact.contact_owner}></a><{else}><{$contact.contact_owner}><{/if}>
            )
        </td>
        <td class="txtcenter width15 xo-actions">
            <img class="tooltip" onclick="display_dialog(<{$contact.contact_id}>, true, true, 'slide', 'slide', 300, 700);"
                 src="<{xoAdminIcons display.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"/>
            <a class="tooltip" title="<{$smarty.const._AM_CONTACT_VIEW}>" href="main.php?op=view&amp;id=<{$contact.contact_id}>"><img
                    src="<{xoAdminIcons view.png}>" alt="<{$smarty.const._AM_CONTACT_VIEW}>"/></a>
            <a class="tooltip" title="<{$smarty.const._DELETE}>" href="main.php?op=delete&amp;id=<{$contact.contact_id}>"><img
                    src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._DELETE}>"/></a>
        </td>
    </tr>
    <{/foreach}>
    </tbody>
</table>
<{foreach item=contact from=$replylist}>
<div id="dialog<{$contact.contact_id}>" title="<{$contact.contact_subject}>" style='display:none;'>
    <div class="marg5 pad5 ui-state-default ui-corner-all">
        <{$smarty.const._AM_CONTACT_SUBJECT}> : <span class="bold"><{$contact.contact_subject}></span>
    </div>
    <div class="marg5 pad5 ui-state-highlight ui-corner-all">
        <div class="pad5">
            <span class="bold"><{$smarty.const._AM_CONTACT_DEPARTMENT}> : </span><{$contact.contact_department}> |
            <span class="bold"><{$smarty.const._AM_CONTACT_SUBMITTER}> : </span><{$contact.contact_name}> ( <{if $contact.contact_uid}><a
                title="<{$contact.contact_owner}>" href="<{$xoops_url}>/userinfo.php?uid=<{$contact.contact_uid}>"><{$contact.contact_owner}></a><{else}><{$contact.contact_owner}><{/if}>
            ) |
            <span class="bold"><{$smarty.const._AM_CONTACT_DATE}> : </span><{$contact.contact_create}> |
            <{if $contact.contact_phone}><span class="bold"><{$smarty.const._AM_CONTACT_PHONE}> : </span><{$contact.contact_phone}> | <{/if}>
            <{if $contact.contact_mail}><span class="bold"><{$smarty.const._AM_CONTACT_EMAIL}> : </span><{$contact.contact_mail}> | <{/if}>
            <{if $contact.contact_icq}><span class="bold"><{$smarty.const._AM_CONTACT_ICQ}> : </span><{$contact.contact_icq}> | <{/if}>
            <{if $contact.contact_company}><span class="bold"><{$smarty.const._AM_CONTACT_COMPANY}> : </span><{$contact.contact_company}> | <{/if}>
            <{if $contact.contact_location}><span class="bold"><{$smarty.const._AM_CONTACT_LOCATION}> : </span><{$contact.contact_location}> | <{/if}>
            <{if $contact.contact_url}><span class="bold"><{$smarty.const._AM_CONTACT_URL}> : </span><a title="<{$smarty.const._AM_CONTACT_VIEWURL}>"
                                                                                                        href="<{$contact.contact_url}>"><{$smarty.const._AM_CONTACT_VIEWURL}></a>
            | <{/if}>
            <{if $contact.contact_address}><span class="bold"><{$smarty.const._AM_CONTACT_ADDRESS}> : </span><{$contact.contact_address}> | <{/if}>
        </div>
        <div class="clear"></div>
    </div>
    <div class="pad5"><span class="bold"><{$smarty.const._AM_CONTACT_MESSAGE}> : </span><{$contact.contact_message}></div>
</div>
<{/foreach}>
<{/if}>

<{elseif $level == delete}>

<{else}>
<{$navigation}>
<table class="outer">
    <thead>
    <th><{$smarty.const._AM_CONTACT_SUBJECT}></th>
    <th><{$smarty.const._AM_CONTACT_REPLY}></th>
    <th><{$smarty.const._AM_CONTACT_DATE}></th>
    <th><{$smarty.const._AM_CONTACT_DEPARTMENT}></th>
    <th><{$smarty.const._AM_CONTACT_SUBMITTER}></th>
    <th><{$smarty.const._AM_CONTACT_ACTION}></th>
    </thead>
    <tbody class="xo-contact">
    <{foreach item=contact from=$contacts}>
    <tr class="odd" id="mod_<{$contact.contact_id}>">
        <td class="bold"><a class="tooltip" title="<{$contact.contact_subject}>" href="main.php?op=view&amp;id=<{$contact.contact_id}>"><{$contact.contact_subject}></a>
        </td>
        <td class="txtcenter width10 bold"><{if $contact.contact_reply}><span class="green bold pad2"><{$smarty.const._AM_CONTACT_HAVEREPLY}></span><{else}><span
                class="red bold pad2"><{$smarty.const._AM_CONTACT_HAVENTREPLY}></span><{/if}>
        </td>
        <td class="txtcenter width10"><{$contact.contact_create}></td>
        <td class="txtcenter width15 bold"><{$contact.contact_department}></td>
        <td class="txtcenter width15"><{$contact.contact_name}> ( <{if $contact.contact_uid}><a title="<{$contact.contact_owner}>"
                                                                                                href="<{$xoops_url}>/userinfo.php?uid=<{$contact.contact_uid}>"><{$contact.contact_owner}></a><{else}><{$contact.contact_owner}><{/if}>
            )
        </td>
        <td class="txtcenter width15 xo-actions">
            <img class="tooltip" onclick="display_dialog(<{$contact.contact_id}>, true, true, 'slide', 'slide', 300, 700);"
                 src="<{xoAdminIcons display.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"/>
            <a class="tooltip" title="<{$smarty.const._AM_CONTACT_REPLY}>" href="main.php?op=reply&amp;id=<{$contact.contact_id}>"><img
                    src="<{xoAdminIcons mail_reply.png}>" alt="<{$smarty.const._AM_CONTACT_REPLY}>"/></a>
            <a class="tooltip" title="<{$smarty.const._AM_CONTACT_VIEW}>" href="main.php?op=view&amp;id=<{$contact.contact_id}>"><img
                    src="<{xoAdminIcons view.png}>" alt="<{$smarty.const._AM_CONTACT_VIEW}>"/></a>
            <a class="tooltip" title="<{$smarty.const._DELETE}>" href="main.php?op=delete&amp;id=<{$contact.contact_id}>"><img
                    src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._DELETE}>"/></a>
        </td>
    </tr>
    <{/foreach}>
    </tbody>
</table>

<{foreach item=contact from=$contacts}>
<div id="dialog<{$contact.contact_id}>" title="<{$contact.contact_subject}>" style='display:none;'>
    <div class="marg5 pad5 ui-state-default ui-corner-all">
        <{$smarty.const._AM_CONTACT_SUBJECT}> : <span class="bold"><{$contact.contact_subject}></span>
    </div>
    <div class="marg5 pad5 ui-state-highlight ui-corner-all">
        <div class="pad5">
            <span class="bold"><{$smarty.const._AM_CONTACT_DEPARTMENT}> : </span><{$contact.contact_department}> |
            <span class="bold"><{$smarty.const._AM_CONTACT_SUBMITTER}> : </span><{$contact.contact_name}> ( <{if $contact.contact_uid}><a
                title="<{$contact.contact_owner}>" href="<{$xoops_url}>/userinfo.php?uid=<{$contact.contact_uid}>"><{$contact.contact_owner}></a><{else}><{$contact.contact_owner}><{/if}>
            ) |
            <span class="bold"><{$smarty.const._AM_CONTACT_DATE}> : </span><{$contact.contact_create}> |
            <{if $contact.contact_phone}><span class="bold"><{$smarty.const._AM_CONTACT_PHONE}> : </span><{$contact.contact_phone}> | <{/if}>
            <{if $contact.contact_mail}><span class="bold"><{$smarty.const._AM_CONTACT_EMAIL}> : </span><{$contact.contact_mail}> | <{/if}>
            <{if $contact.contact_icq}><span class="bold"><{$smarty.const._AM_CONTACT_ICQ}> : </span><{$contact.contact_icq}> | <{/if}>
            <{if $contact.contact_company}><span class="bold"><{$smarty.const._AM_CONTACT_COMPANY}> : </span><{$contact.contact_company}> | <{/if}>
            <{if $contact.contact_location}><span class="bold"><{$smarty.const._AM_CONTACT_LOCATION}> : </span><{$contact.contact_location}> | <{/if}>
            <{if $contact.contact_url}><span class="bold"><{$smarty.const._AM_CONTACT_URL}> : </span><a title="<{$smarty.const._AM_CONTACT_VIEWURL}>"
                                                                                                        href="<{$contact.contact_url}>"><{$smarty.const._AM_CONTACT_VIEWURL}></a>
            | <{/if}>
            <{if $contact.contact_address}><span class="bold"><{$smarty.const._AM_CONTACT_ADDRESS}> : </span><{$contact.contact_address}> | <{/if}>
        </div>
        <div class="clear"></div>
    </div>
    <div class="pad5"><span class="bold"><{$smarty.const._AM_CONTACT_MESSAGE}> : </span><{$contact.contact_message}></div>
</div>
<{/foreach}>

<div class="pagenav"><{$contact_pagenav}></div>
<{/if}>
</div>
