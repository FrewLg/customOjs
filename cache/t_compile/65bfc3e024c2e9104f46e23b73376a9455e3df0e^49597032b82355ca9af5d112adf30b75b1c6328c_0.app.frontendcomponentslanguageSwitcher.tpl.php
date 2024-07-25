<?php
/* Smarty version 4.3.1, created on 2024-07-25 09:04:50
  from 'app:frontendcomponentslanguageSwitcher.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a21532ba2d98_77169703',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '49597032b82355ca9af5d112adf30b75b1c6328c' => 
    array (
      0 => 'app:frontendcomponentslanguageSwitcher.tpl',
      1 => 1721890160,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a21532ba2d98_77169703 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/cornerstone/Desktop/projects/Upwork/ojs-3.4.0-6/lib/pkp/lib/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<?php if ($_smarty_tpl->tpl_vars['languageToggleLocales']->value && smarty_modifier_count($_smarty_tpl->tpl_vars['languageToggleLocales']->value) > 1) {?>
	<ul id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id']->value ));?>
" class="dropdown language-toggle nav nav-tabs">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" id="languageToggleMenu<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id']->value ));?>
" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="visually-hidden"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"plugins.themes.classic.language.toggle"),$_smarty_tpl ) );?>
</span>
				<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['languageToggleLocales']->value[$_smarty_tpl->tpl_vars['currentLocale']->value] ));?>

			</a>

			<div class="navigation-dropdown dropdown-menu dropdown-menu-right" aria-labelledby="languageToggleMenu<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id']->value ));?>
">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languageToggleLocales']->value, 'localeName', false, 'localeKey');
$_smarty_tpl->tpl_vars['localeName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['localeKey']->value => $_smarty_tpl->tpl_vars['localeName']->value) {
$_smarty_tpl->tpl_vars['localeName']->do_else = false;
?>
					<?php if ($_smarty_tpl->tpl_vars['localeKey']->value !== $_smarty_tpl->tpl_vars['currentLocale']->value) {?>
						<a class="dropdown-item" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>"user",'op'=>"setLocale",'path'=>$_smarty_tpl->tpl_vars['localeKey']->value,'source'=>$_SERVER['REQUEST_URI']),$_smarty_tpl ) );?>
">
							<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['localeName']->value ));?>

						</a>
					<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</div>
		</li>
	</ul>
<?php }
}
}
