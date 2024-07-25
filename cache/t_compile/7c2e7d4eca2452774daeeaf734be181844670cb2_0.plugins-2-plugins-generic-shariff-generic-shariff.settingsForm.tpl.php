<?php
/* Smarty version 4.3.1, created on 2024-07-25 10:53:57
  from 'plugins-2-plugins-generic-shariff-generic-shariff:settingsForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a22ec56cdf82_57184901',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7c2e7d4eca2452774daeeaf734be181844670cb2' => 
    array (
      0 => 'plugins-2-plugins-generic-shariff-generic-shariff:settingsForm.tpl',
      1 => 1721897186,
      2 => 'plugins-2-plugins-generic-shariff-generic-shariff',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a22ec56cdf82_57184901 (Smarty_Internal_Template $_smarty_tpl) {
?>
 <tab id="shariffPlugin" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"plugins.generic.shariff.displayName"),$_smarty_tpl ) );?>
">
	<pkp-form
		v-bind="components.<?php echo (defined('FORM_SHARIFF_SETTINGS') ? constant('FORM_SHARIFF_SETTINGS') : null);?>
"
		@set="set"
	/>
</tab><?php }
}
