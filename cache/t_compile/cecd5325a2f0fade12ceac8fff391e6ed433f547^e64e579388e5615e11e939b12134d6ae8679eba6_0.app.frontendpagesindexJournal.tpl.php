<?php
/* Smarty version 4.3.1, created on 2024-07-25 09:04:44
  from 'app:frontendpagesindexJournal.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a2152caa2ba2_26593843',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e64e579388e5615e11e939b12134d6ae8679eba6' => 
    array (
      0 => 'app:frontendpagesindexJournal.tpl',
      1 => 1721890160,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/header.tpl' => 1,
    'app:frontend/objects/issue_toc.tpl' => 1,
    'app:frontend/components/footer.tpl' => 1,
  ),
),false)) {
function content_66a2152caa2ba2_26593843 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/cornerstone/Desktop/projects/Upwork/ojs-3.4.0-6/lib/pkp/lib/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pageTitleTranslated'=>$_smarty_tpl->tpl_vars['currentJournal']->value->getLocalizedName()), 0, false);
?>

<main class="page_index_journal">

		<?php if ($_smarty_tpl->tpl_vars['homepageImage']->value) {?>
		<div
			class="homepage_image"
			style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['publicFilesDir']->value;?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['homepageImage']->value['uploadName'],"url" ));?>
')<?php if ($_smarty_tpl->tpl_vars['showJournalSummary']->value) {?>, linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75))<?php }?>">
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['showJournalSummary']->value && $_smarty_tpl->tpl_vars['currentJournal']->value->getLocalizedDescription()) {?>
		<section class="container journal_summary"<?php if ($_smarty_tpl->tpl_vars['homepageImage']->value) {?>style="color: #FFF"<?php }?>>
			<h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"navigation.about"),$_smarty_tpl ) );?>
</h2>
			<?php echo $_smarty_tpl->tpl_vars['currentJournal']->value->getLocalizedDescription();?>

		</section>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['homepageImage']->value) {?>
		</div>
	<?php }?>

	<div class="container-fluid container-page">

				<?php if ($_smarty_tpl->tpl_vars['announcements']->value) {?>
			<section class="announcements">
				<h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"announcement.announcements"),$_smarty_tpl ) );?>
</h2>
				<div class="row">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['announcements']->value, 'announcement');
$_smarty_tpl->tpl_vars['announcement']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['announcement']->value) {
$_smarty_tpl->tpl_vars['announcement']->do_else = false;
?>
						<article class="col-md-4 announcement">
							<p class="announcement_date"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( smarty_modifier_date_format($_smarty_tpl->tpl_vars['announcement']->value->getDatePosted(),$_smarty_tpl->tpl_vars['dateFormatShort']->value) ));?>
</p>
							<h3 class="announcement_title">
								<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>(defined('ROUTE_PAGE') ? constant('ROUTE_PAGE') : null),'page'=>"announcement",'op'=>"view",'path'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['announcement']->value->getId() ))),$_smarty_tpl ) );?>
">
									<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['announcement']->value->getLocalizedTitle() ));?>

								</a>
							</h3>
						</article>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</div>
			</section>
		<?php }?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Templates::Index::journal"),$_smarty_tpl ) );?>


				<?php if ($_smarty_tpl->tpl_vars['issue']->value) {?>
			<section class="current_issue">
				<header>
					<h2 class="current_issue_title"><span class="current_issue_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"journal.currentIssue"),$_smarty_tpl ) );?>
</span><?php if ($_smarty_tpl->tpl_vars['issueIdentificationString']->value) {?><span class="current_issue_identification"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['issueIdentificationString']->value ));?>
</span><?php }?></h2>

										<?php if ($_smarty_tpl->tpl_vars['issue']->value->getDatePublished()) {?>
						<p class="published">
							<span class="date_label">
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submissions.published"),$_smarty_tpl ) );?>

							</span>
							<span class="date_format">
									<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['issue']->value->getDatePublished(),$_smarty_tpl->tpl_vars['dateFormatLong']->value);?>

							</span>
						</p>
					<?php }?>
				</header>
				<?php $_smarty_tpl->_subTemplateRender("app:frontend/objects/issue_toc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			</section>
		<?php }?>

				<?php if ($_smarty_tpl->tpl_vars['additionalHomeContent']->value) {?>
			<section class="additional_content">
				<?php echo $_smarty_tpl->tpl_vars['additionalHomeContent']->value;?>

			</section>
		<?php }?>
	</div>
</main><!-- .page -->

<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
