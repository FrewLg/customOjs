<?php
/* Smarty version 4.3.1, created on 2024-07-25 17:27:23
  from 'app:frontendpagesannouncements.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a28afb3b6c98_27454725',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '940e52f31d2f469df7aa1cf641b18f25e2302700' => 
    array (
      0 => 'app:frontendpagesannouncements.tpl',
      1 => 1721890160,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/header.tpl' => 1,
    'app:frontend/components/headings.tpl' => 1,
    'app:frontend/components/editLink.tpl' => 1,
    'app:frontend/components/announcements.tpl' => 1,
    'app:frontend/components/footer.tpl' => 1,
  ),
),false)) {
function content_66a28afb3b6c98_27454725 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("app:frontend/components/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pageTitle'=>"announcement.announcements"), 0, false);
?>

<main class="page page_announcements">
	<div class="container-fluid container-page container-narrow">
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/headings.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('currentTitleKey'=>"announcement.announcements"), 0, false);
?>
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/editLink.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page'=>"management",'op'=>"settings",'path'=>"announcements",'anchor'=>"announcements",'sectionTitleKey'=>"announcement.announcements"), 0, false);
?>

		<div class="announcements-introduction">
			<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['announcementsIntroduction']->value ));?>

		</div>

		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/announcements.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</div>
</main><!-- .page -->

<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
