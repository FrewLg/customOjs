<?php
/* Smarty version 4.3.1, created on 2024-07-25 11:08:24
  from 'app:frontendpagesinformation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a232280be362_06961452',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b15cdaea5a4789ea75f45487484ca1ccdeda31a' => 
    array (
      0 => 'app:frontendpagesinformation.tpl',
      1 => 1721890160,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/header.tpl' => 1,
    'app:frontend/components/headings.tpl' => 1,
    'app:frontend/components/editLink.tpl' => 1,
    'app:frontend/components/footer.tpl' => 1,
  ),
),false)) {
function content_66a232280be362_06961452 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['contentOnly']->value) {?>
	<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pageTitle'=>$_smarty_tpl->tpl_vars['pageTitle']->value), 0, false);
}?>

<main class="page page_information">
	<div class="container-fluid container-page container-narrow">
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/headings.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('currentTitleKey'=>$_smarty_tpl->tpl_vars['pageTitle']->value), 0, false);
?>
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/editLink.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page'=>"management",'op'=>"settings",'path'=>"website",'anchor'=>"setup/information",'sectionTitleKey'=>"manager.website.information"), 0, false);
?>

		<div class="info-description">
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		</div>
	</div>
</main>

<?php if (!$_smarty_tpl->tpl_vars['contentOnly']->value) {?>
	<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
}
