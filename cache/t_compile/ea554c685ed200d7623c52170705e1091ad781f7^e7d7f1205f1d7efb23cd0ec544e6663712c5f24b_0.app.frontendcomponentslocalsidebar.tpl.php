<?php
/* Smarty version 4.3.1, created on 2024-07-25 10:56:06
  from 'app:frontendcomponentslocalsidebar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a22f4621d6e9_58404526',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7d7f1205f1d7efb23cd0ec544e6663712c5f24b' => 
    array (
      0 => 'app:frontendcomponentslocalsidebar.tpl',
      1 => 1721847885,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a22f4621d6e9_58404526 (Smarty_Internal_Template $_smarty_tpl) {
if (empty($_smarty_tpl->tpl_vars['isFullWidth']->value)) {?>
  <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "sidebarCode", null);?>
  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Templates::Common::Sidebar"),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
  <?php if ($_smarty_tpl->tpl_vars['sidebarCode']->value) {?>
    <ol class="space-y-9 text-base lg:text-sm" role="list" aria-label="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.navigation.sidebar"),$_smarty_tpl ) ) ));?>
">
      <?php echo $_smarty_tpl->tpl_vars['sidebarCode']->value;?>

    </ol><!-- pkp_sidebar.left -->
  <?php }
}
}
}
