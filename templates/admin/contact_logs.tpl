<div class="contact">
    <{$navigation|default:''}>
    <{if $form}><{$form}><{/if}>
    <{if $logs|default:''}>
    <div class="pad2">
        <ul>
            <{foreach item=log from=$logs}>
            <li><{$log}></li>
            <{/foreach}>
        </ul>
    </div>
    <{/if}>
</div>
