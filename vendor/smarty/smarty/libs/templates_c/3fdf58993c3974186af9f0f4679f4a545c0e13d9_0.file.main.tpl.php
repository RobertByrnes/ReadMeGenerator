<?php
/* Smarty version 3.1.39, created on 2021-04-20 22:05:13
  from 'C:\wamp64\www\repositories\ReadMeGenerator\templates\main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_607f50196281c6_02263106',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3fdf58993c3974186af9f0f4679f4a545c0e13d9' => 
    array (
      0 => 'C:\\wamp64\\www\\repositories\\ReadMeGenerator\\templates\\main.tpl',
      1 => 1618956308,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_607f50196281c6_02263106 (Smarty_Internal_Template $_smarty_tpl) {
?>
<select class="custom-select">
    <option selected>Select class</option>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['classes']->value, 'attribute', false, 'class');
$_smarty_tpl->tpl_vars['attribute']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['class']->value => $_smarty_tpl->tpl_vars['attribute']->value) {
$_smarty_tpl->tpl_vars['attribute']->do_else = false;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['attribute']->value->class_name;?>
"><?php echo $_smarty_tpl->tpl_vars['attribute']->value->class_name;?>
</option>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select><?php }
}
