<?php
/* Smarty version 4.3.1, created on 2024-07-25 17:04:55
  from 'core:controllersgridnavigationMenusremoteUrlNMIType.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a285b7072228_86746519',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4c0c501278bc3a624ffd7176a35461b141f68e6' => 
    array (
      0 => 'core:controllersgridnavigationMenusremoteUrlNMIType.tpl',
      1 => 1721429234,
      2 => 'core',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a285b7072228_86746519 (Smarty_Internal_Template $_smarty_tpl) {
$_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['fbvFormSection'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'smartyFBVFormSection'))) {
throw new SmartyException('block tag \'fbvFormSection\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('fbvFormSection', array('id'=>"NMI_TYPE_REMOTE_URL",'class'=>"NMI_TYPE_CUSTOM_EDIT",'title'=>"manager.navigationMenus.form.url",'for'=>"remoteUrl",'list'=>true,'required'=>"true"));
$_block_repeat=true;
echo $_block_plugin9->smartyFBVFormSection(array('id'=>"NMI_TYPE_REMOTE_URL",'class'=>"NMI_TYPE_CUSTOM_EDIT",'title'=>"manager.navigationMenus.form.url",'for'=>"remoteUrl",'list'=>true,'required'=>"true"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['fbvElement'][0], array( array('type'=>"text",'multilingual'=>true,'id'=>"remoteUrl",'value'=>$_smarty_tpl->tpl_vars['remoteUrl']->value,'maxlength'=>"255",'required'=>"true"),$_smarty_tpl ) );?>

<?php $_block_repeat=false;
echo $_block_plugin9->smartyFBVFormSection(array('id'=>"NMI_TYPE_REMOTE_URL",'class'=>"NMI_TYPE_CUSTOM_EDIT",'title'=>"manager.navigationMenus.form.url",'for'=>"remoteUrl",'list'=>true,'required'=>"true"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

<?php }
}
