<?php
/* Smarty version 4.3.1, created on 2024-07-25 10:52:25
  from 'app:frontendobjectsarticle_summary.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a22e69b4cf91_53530018',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7cf1cd52b8ba8108de77f197078de34b733dd394' => 
    array (
      0 => 'app:frontendobjectsarticle_summary.tpl',
      1 => 1721890160,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/objects/galley_link.tpl' => 1,
  ),
),false)) {
function content_66a22e69b4cf91_53530018 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/cornerstone/Desktop/projects/Upwork/ojs-3.4.0-6/lib/pkp/lib/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<?php $_smarty_tpl->_assignInScope('articlePath', $_smarty_tpl->tpl_vars['article']->value->getBestId());
$_smarty_tpl->_assignInScope('publication', $_smarty_tpl->tpl_vars['article']->value->getCurrentPublication());
if ($_smarty_tpl->tpl_vars['headingLevel']->value) {?>
	<?php $_smarty_tpl->_assignInScope('heading', "h".((string)$_smarty_tpl->tpl_vars['headingLevel']->value));
} else { ?>
	<?php $_smarty_tpl->_assignInScope('heading', "div");
}?>

<?php if ((!$_smarty_tpl->tpl_vars['section']->value['hideAuthor'] && $_smarty_tpl->tpl_vars['publication']->value->getData('hideAuthor') == \APP\submission\Submission::AUTHOR_TOC_DEFAULT) || $_smarty_tpl->tpl_vars['publication']->value->getData('hideAuthor') == \APP\submission\Submission::AUTHOR_TOC_SHOW) {?>
	<?php $_smarty_tpl->_assignInScope('showAuthor', true);
}?>

<article class="article_summary">
	<div class="article_summary_body">
		<<?php echo $_smarty_tpl->tpl_vars['heading']->value;?>
 class="summary_title_wrapper">
			<a class="summary_title" <?php if ($_smarty_tpl->tpl_vars['journal']->value) {?>href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('journal'=>$_smarty_tpl->tpl_vars['journal']->value->getPath(),'page'=>"article",'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['articlePath']->value),$_smarty_tpl ) );?>
"<?php } else { ?>href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"article",'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['articlePath']->value),$_smarty_tpl ) );?>
"<?php }?>>
				<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strip_unsafe_html' ][ 0 ], array( $_smarty_tpl->tpl_vars['publication']->value->getLocalizedFullTitle(null,'html') ));?>

			</a>
		</<?php echo $_smarty_tpl->tpl_vars['heading']->value;?>
>

		<?php $_smarty_tpl->_assignInScope('submissionPages', $_smarty_tpl->tpl_vars['publication']->value->getData('pages'));?>
		<?php $_smarty_tpl->_assignInScope('submissionDatePublished', $_smarty_tpl->tpl_vars['publication']->value->getData('datePublished'));?>
		<?php if ($_smarty_tpl->tpl_vars['showAuthor']->value || $_smarty_tpl->tpl_vars['submissionPages']->value || ($_smarty_tpl->tpl_vars['submissionDatePublished']->value && $_smarty_tpl->tpl_vars['showDatePublished']->value)) {?>
		<div class="summary_meta">
			<?php if ($_smarty_tpl->tpl_vars['showAuthor']->value) {?>
			<div class="authors">
				<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['publication']->value->getAuthorString($_smarty_tpl->tpl_vars['authorUserGroups']->value) ));?>

			</div>
			<?php }?>

						<?php if ($_smarty_tpl->tpl_vars['submissionPages']->value) {?>
				<div class="pages">
					<?php echo $_smarty_tpl->tpl_vars['submissionPages']->value;?>

				</div>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['showDatePublished']->value && $_smarty_tpl->tpl_vars['submissionDatePublished']->value) {?>
				<div class="published">
					<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['submissionDatePublished']->value,$_smarty_tpl->tpl_vars['dateFormatShort']->value);?>

				</div>
			<?php }?>

		</div>
		<?php }?>
	</div>

	<?php if (!$_smarty_tpl->tpl_vars['hideGalleys']->value) {?>
		<div class="galleys_links">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['article']->value->getGalleys(), 'galley');
$_smarty_tpl->tpl_vars['galley']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['galley']->value) {
$_smarty_tpl->tpl_vars['galley']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['primaryGenreIds']->value) {?>
					<?php $_smarty_tpl->_assignInScope('file', $_smarty_tpl->tpl_vars['galley']->value->getFile());?>
					<?php if (!$_smarty_tpl->tpl_vars['galley']->value->getRemoteUrl() && !($_smarty_tpl->tpl_vars['file']->value && in_array($_smarty_tpl->tpl_vars['file']->value->getGenreId(),$_smarty_tpl->tpl_vars['primaryGenreIds']->value))) {?>
						<?php continue 1;?>
					<?php }?>
				<?php }?>
				<?php $_smarty_tpl->_assignInScope('hasArticleAccess', $_smarty_tpl->tpl_vars['hasAccess']->value);?>
				<?php if ($_smarty_tpl->tpl_vars['currentContext']->value->getSetting('publishingMode') == \APP\journal\Journal::PUBLISHING_MODE_OPEN || $_smarty_tpl->tpl_vars['publication']->value->getData('accessStatus') == \APP\submission\Submission::ARTICLE_ACCESS_OPEN) {?>
					<?php $_smarty_tpl->_assignInScope('hasArticleAccess', 1);?>
				<?php }?>
				<?php $_smarty_tpl->_subTemplateRender("app:frontend/objects/galley_link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('parent'=>$_smarty_tpl->tpl_vars['article']->value,'publication'=>$_smarty_tpl->tpl_vars['publication']->value,'hasAccess'=>$_smarty_tpl->tpl_vars['hasArticleAccess']->value,'purchaseFee'=>$_smarty_tpl->tpl_vars['currentJournal']->value->getData('purchaseArticleFee'),'purchaseCurrency'=>$_smarty_tpl->tpl_vars['currentJournal']->value->getData('currency')), 0, true);
?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
	<?php }?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Templates::Issue::Issue::Article"),$_smarty_tpl ) );?>

</article>
<?php }
}