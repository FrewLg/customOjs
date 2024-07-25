<?php
/* Smarty version 4.3.1, created on 2024-07-25 09:04:42
  from 'app:frontendcomponentspagination.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a2152a320ee1_56668689',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9682151be098398fb7a96b2156c8f1b007d7bfe0' => 
    array (
      0 => 'app:frontendcomponentspagination.tpl',
      1 => 1721890160,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a2152a320ee1_56668689 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['prevUrl']->value || $_smarty_tpl->tpl_vars['nextUrl']->value) {?>
	<nav class="pagination_navigation" aria-label="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.pagination.label"),$_smarty_tpl ) ) ));?>
">
		<h2 class="visually-hidden"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"issue.pagination"),$_smarty_tpl ) );?>
</h2>
		<ul class="pagination justify-content-center">
			<li class="page-item<?php if (!$_smarty_tpl->tpl_vars['prevUrl']->value) {?> disabled<?php }?>">
				<a class="page-link" href="<?php echo $_smarty_tpl->tpl_vars['prevUrl']->value;?>
">
					<i class="fas fa-arrow-left"></i>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"help.previous"),$_smarty_tpl ) );?>

				</a>
			</li>
			<li class="page-item active">
				<span class="page-link">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.pagination",'start'=>$_smarty_tpl->tpl_vars['showingStart']->value,'end'=>$_smarty_tpl->tpl_vars['showingEnd']->value,'total'=>$_smarty_tpl->tpl_vars['total']->value),$_smarty_tpl ) );?>

				</span>
			</li>
			<li class="page-item<?php if (!$_smarty_tpl->tpl_vars['nextUrl']->value) {?> disabled<?php }?>">
				<a class="page-link" href="<?php echo $_smarty_tpl->tpl_vars['nextUrl']->value;?>
">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"help.next"),$_smarty_tpl ) );?>

					<i class="fas fa-arrow-right"></i>
				</a>
			</li>
		</ul>
	</nav>
<?php }
}
}
