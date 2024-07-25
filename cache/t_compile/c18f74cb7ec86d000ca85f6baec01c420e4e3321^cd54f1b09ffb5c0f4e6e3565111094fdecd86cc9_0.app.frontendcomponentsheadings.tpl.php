<?php
/* Smarty version 4.3.1, created on 2024-07-25 10:51:59
  from 'app:frontendcomponentsheadings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a22e4fd981f0_40686336',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd54f1b09ffb5c0f4e6e3565111094fdecd86cc9' => 
    array (
      0 => 'app:frontendcomponentsheadings.tpl',
      1 => 1721890160,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a22e4fd981f0_40686336 (Smarty_Internal_Template $_smarty_tpl) {
?>
<header>
	<div class="current_page_title">
		<h1 class="<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['requestedPage']->value )) === 'issue' && call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['requestedOp']->value )) === "view") {?>text-left issue-header<?php } else { ?>text-center<?php }?>">
			<?php if ($_smarty_tpl->tpl_vars['currentTitleKey']->value) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['currentTitleKey']->value),$_smarty_tpl ) );?>

			<?php } else { ?>
				<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['currentTitle']->value ));?>

			<?php }?>
		</h1>
	</div>
</header>
<?php }
}
