{* <pre>{$classes|@print_r:1}</pre> *}

<select>
    <option selected>Select class</option>
    {foreach from=$classes item=attribute key=class}
        <option value="{$attribute->class_name}">{$attribute->class_name}</option>
    {/foreach}
</select>
