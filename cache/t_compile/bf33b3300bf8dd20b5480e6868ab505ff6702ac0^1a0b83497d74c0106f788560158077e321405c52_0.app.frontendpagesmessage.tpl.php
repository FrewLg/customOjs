<?php
/* Smarty version 4.3.1, created on 2024-07-27 11:31:33
  from 'app:frontendpagesmessage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a4da95309e32_18417871',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a0b83497d74c0106f788560158077e321405c52' => 
    array (
      0 => 'app:frontendpagesmessage.tpl',
      1 => 1721890160,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/header.tpl' => 1,
    'app:frontend/components/headings.tpl' => 1,
    'app:frontend/components/footer.tpl' => 1,
  ),
),false)) {
function content_66a4da95309e32_18417871 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("app:frontend/components/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="page page_message">
	<div class="container-fluid container-page container-narrow">
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/headings.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('currentTitleKey'=>$_smarty_tpl->tpl_vars['pageTitle']->value), 0, false);
?>
		<div class="message-description">
			<?php if ($_smarty_tpl->tpl_vars['messageTranslated']->value) {?>
				<?php echo $_smarty_tpl->tpl_vars['messageTranslated']->value;?>

			<?php } else { ?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['message']->value),$_smarty_tpl ) );?>

			<?php }?>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['backLink']->value) {?>
			<div class="cmp_back_link">
				<a href="<?php echo $_smarty_tpl->tpl_vars['backLink']->value;?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['backLinkLabel']->value),$_smarty_tpl ) );?>
</a>
			</div>
		<?php }?>
	</div>
</div>

<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
