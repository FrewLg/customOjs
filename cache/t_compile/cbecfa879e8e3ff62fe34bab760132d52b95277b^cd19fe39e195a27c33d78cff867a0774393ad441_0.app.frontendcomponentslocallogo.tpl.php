<?php
/* Smarty version 4.3.1, created on 2024-07-27 14:17:42
  from 'app:frontendcomponentslocallogo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a501861c07a4_79194125',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd19fe39e195a27c33d78cff867a0774393ad441' => 
    array (
      0 => 'app:frontendcomponentslocallogo.tpl',
      1 => 1721847885,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/ui/material_icon_logo.tpl' => 1,
  ),
),false)) {
function content_66a501861c07a4_79194125 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['displayPageHeaderLogo']->value) {?>
	<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"index",'router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null)),$_smarty_tpl ) );?>
">
		<img
			src="<?php echo $_smarty_tpl->tpl_vars['publicFilesDir']->value;?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['displayPageHeaderLogo']->value['uploadName'],"url" ));?>
"
			width="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['displayPageHeaderLogo']->value['width'] ));?>
"
			height="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['displayPageHeaderLogo']->value['height'] ));?>
"
			<?php if ($_smarty_tpl->tpl_vars['displayPageHeaderLogo']->value['altText'] != '') {?>
				alt="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['displayPageHeaderLogo']->value['altText'] ));?>
"
			<?php }?>
			class="img-fluid"
			style="max-width: 180px;"/>
	</a>
<?php } else { ?>
	<a aria-label="Home page" href="/">
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/ui/material_icon_logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('small'=>$_smarty_tpl->tpl_vars['small']->value), 0, false);
?>
	</a>
<?php }
}
}
