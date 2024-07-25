<?php
/* Smarty version 4.3.1, created on 2024-07-25 09:04:50
  from 'app:frontendpagesindexSite.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a21532b596e7_94501733',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51cfb9321c891ada9323e7942962579e7e4324d1' => 
    array (
      0 => 'app:frontendpagesindexSite.tpl',
      1 => 1721890160,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/header.tpl' => 1,
    'app:frontend/components/footer.tpl' => 1,
  ),
),false)) {
function content_66a21532b596e7_94501733 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/cornerstone/Desktop/projects/Upwork/ojs-3.4.0-6/lib/pkp/lib/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
$_smarty_tpl->_subTemplateRender("app:frontend/components/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="page_index_site">
	<div class="container-fluid container-page container-narrow">

		<?php if ($_smarty_tpl->tpl_vars['about']->value) {?>
			<div class="about_site">
				<?php echo nl2br((string) $_smarty_tpl->tpl_vars['about']->value, (bool) 1);?>

			</div>
		<?php }?>

		<div class="index-site-journals">
			<h2>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"context.contexts"),$_smarty_tpl ) );?>

			</h2>
			<?php if (!smarty_modifier_count($_smarty_tpl->tpl_vars['journals']->value)) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"site.noJournals"),$_smarty_tpl ) );?>

			<?php } else { ?>
				<div>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['journals']->value, 'journal');
$_smarty_tpl->tpl_vars['journal']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['journal']->value) {
$_smarty_tpl->tpl_vars['journal']->do_else = false;
?>
						<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "url", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('journal'=>$_smarty_tpl->tpl_vars['journal']->value->getPath()),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
						<?php $_smarty_tpl->_assignInScope('thumb', $_smarty_tpl->tpl_vars['journal']->value->getLocalizedSetting('journalThumbnail'));?>
						<?php $_smarty_tpl->_assignInScope('description', $_smarty_tpl->tpl_vars['journal']->value->getLocalizedDescription());?>
						<div class="index-site-journal">
							<div class="index-site-journal-header">
								<h3>
									<a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['url']->value ));?>
" rel="bookmark">
										<?php echo $_smarty_tpl->tpl_vars['journal']->value->getLocalizedName();?>

									</a>
								</h3>
							</div>

							<?php if ($_smarty_tpl->tpl_vars['thumb']->value) {?>
								<div class="index-site-journal-thumb">
									<a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['url']->value ));?>
">
										<img src="<?php echo $_smarty_tpl->tpl_vars['journalFilesPath']->value;
echo $_smarty_tpl->tpl_vars['journal']->value->getId();?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['thumb']->value['uploadName'],"url" ));?>
"<?php if ($_smarty_tpl->tpl_vars['thumb']->value['altText']) {?> alt="<?php echo (($tmp = call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['thumb']->value['altText'] )) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"<?php }?>>
									</a>
								</div>
							<?php }?>

							<?php if ($_smarty_tpl->tpl_vars['description']->value) {?>
								<div class="index-site-journal-description<?php if (!$_smarty_tpl->tpl_vars['thumb']->value) {?> full-width<?php }?>">
									<?php echo nl2br((string) $_smarty_tpl->tpl_vars['description']->value, (bool) 1);?>

								</div>
							<?php }?>

							<div class="index-site-journal-links">
								<a class="btn btn-primary view" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['url']->value ));?>
">
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"site.journalView"),$_smarty_tpl ) );?>

								</a>
								<a class="btn btn-secondary view" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('journal'=>$_smarty_tpl->tpl_vars['journal']->value->getPath(),'page'=>"issue",'op'=>"current"),$_smarty_tpl ) ) ));?>
">
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"site.journalCurrent"),$_smarty_tpl ) );?>

								</a>
							</div>
						</div>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</div>
			<?php }?>
		</div>
	</div>

</div><!-- .page -->

<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
