<?php
/* Smarty version 3.1.39, created on 2021-04-15 19:54:04
  from 'C:\wamp64\www\repositories\ReadMeGenerator\templates\classpanel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_607899dc84ed34_02706668',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0d76ed9461d297bcda8653ff4d395f5a178f0294' => 
    array (
      0 => 'C:\\wamp64\\www\\repositories\\ReadMeGenerator\\templates\\classpanel.tpl',
      1 => 1618341569,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_607899dc84ed34_02706668 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">

    <div class="alert" role="alert">
        <div class="card">

            <div class="card-header bg-dark text-white">
                Class Name: <b><?php echo $_smarty_tpl->tpl_vars['className']->value;?>
</b>
            </div>

            <div class="card-body">

                <div class="alert alert-info col-md-12">
                    <strong>Class Comment:</strong>
                    <span><?php echo $_smarty_tpl->tpl_vars['classComment']->value['comments'][0];?>
</span>
                </div><!-- .col-md-12 -->

                <div class="clearfix"></div>

                <div class="alert alert-success col-md-12">
                    <strong>Class Properties: </strong>
                    <div class="mt-1 mb-1"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Property Name</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['properties']->value, 'info', false, 'property');
$_smarty_tpl->tpl_vars['info']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['property']->value => $_smarty_tpl->tpl_vars['info']->value) {
$_smarty_tpl->tpl_vars['info']->do_else = false;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['info']->value['methodName'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['info']->value['comments'][0];?>
 </td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>         
                </div><!-- .col-md-12 -->

                <div class="clearfix"></div>

                <div class="alert alert-success col-md-12">
                    <strong>Class Methods: </strong>
                    <div class="mt-1 mb-1"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Method Name</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Params</th>
                                <th scope="col">Returns</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['docComments']->value, 'method', false, 'item');
$_smarty_tpl->tpl_vars['method']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value => $_smarty_tpl->tpl_vars['method']->value) {
$_smarty_tpl->tpl_vars['method']->do_else = false;
?>
                                <tr>
                                    <th scope="col"><?php echo $_smarty_tpl->tpl_vars['method']->value['methodName'];?>
</th>
                                    <td>
                                        <?php if ((isset($_smarty_tpl->tpl_vars['method']->value['comments'])) && !is_array($_smarty_tpl->tpl_vars['method']->value['comments'])) {
echo $_smarty_tpl->tpl_vars['method']->value['comments'];?>

                                        <?php } elseif ((isset($_smarty_tpl->tpl_vars['method']->value['comments'])) && is_array($_smarty_tpl->tpl_vars['method']->value['comments'])) {?>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['method']->value['comments'], 'item', false, 'comment');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['comment']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                                                <p><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</p>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        <?php } else { ?> Undocumented <?php }?>
                                    </td>
                                    <td>
                                        <?php if ((isset($_smarty_tpl->tpl_vars['method']->value['params'])) && !is_array($_smarty_tpl->tpl_vars['method']->value['params'])) {
echo $_smarty_tpl->tpl_vars['method']->value['params'];?>

                                        <?php } elseif ((isset($_smarty_tpl->tpl_vars['method']->value['params'])) && is_array($_smarty_tpl->tpl_vars['method']->value['params'])) {?>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['method']->value['params'], 'item', false, 'param');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['param']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                                                <p><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</p>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        <?php } else { ?> Undocumented <?php }?>
                                    </td>
                                    <td>
                                        <?php if ((isset($_smarty_tpl->tpl_vars['method']->value['return'])) && !is_array($_smarty_tpl->tpl_vars['method']->value['return'])) {
echo $_smarty_tpl->tpl_vars['method']->value['return'];?>

                                        <?php } elseif ((isset($_smarty_tpl->tpl_vars['method']->value['return'])) && is_array($_smarty_tpl->tpl_vars['method']->value['return'])) {?>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['method']->value['return'], 'item', false, 'return');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['return']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                                                <p><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</p>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        <?php } else { ?> Undocumented <?php }?>
                                    </td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>         
                </div><!-- .col-md-12 -->

                <div class="alert alert-info col-md-12">
                    <b>Class Parent: </b><?php echo $_smarty_tpl->tpl_vars['parent']->value;?>

                </div><!-- .col-md-12 -->

                <div class="clearfix"></div>
            </div><!-- .card-body -->
        </div><!-- .card -->
    </div><!-- .alert -->
</div><!-- .container --><?php }
}
