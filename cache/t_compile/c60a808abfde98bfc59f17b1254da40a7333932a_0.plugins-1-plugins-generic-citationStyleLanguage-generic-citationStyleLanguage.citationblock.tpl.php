<?php
/* Smarty version 4.3.1, created on 2024-07-25 10:54:51
  from 'plugins-1-plugins-generic-citationStyleLanguage-generic-citationStyleLanguage:citationblock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a22efb6032c0_96695682',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c60a808abfde98bfc59f17b1254da40a7333932a' => 
    array (
      0 => 'plugins-1-plugins-generic-citationStyleLanguage-generic-citationStyleLanguage:citationblock.tpl',
      1 => 1721890160,
      2 => 'plugins-1-plugins-generic-citationStyleLanguage-generic-citationStyleLanguage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a22efb6032c0_96695682 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['citation']->value) {?>
	<div class="item citation">
		<div class="sub_item citation_display">
			<h3>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.howToCite"),$_smarty_tpl ) );?>

			</h3>
			<div class="citation_format_value">
				<div id="citationOutput" role="region" aria-live="polite">
                    <?php echo $_smarty_tpl->tpl_vars['citation']->value;?>

				</div>
				<div class="citation_formats dropdown">
					<button class="btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
					        aria-expanded="false">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.howToCite.citationFormats"),$_smarty_tpl ) );?>

					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dropdown-cit">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['citationStyles']->value, 'citationStyle');
$_smarty_tpl->tpl_vars['citationStyle']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['citationStyle']->value) {
$_smarty_tpl->tpl_vars['citationStyle']->do_else = false;
?>
							<a
									class="dropdown-cite-link dropdown-item"
									aria-controls="citationOutput"
									href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"citationstylelanguage",'op'=>"get",'path'=>$_smarty_tpl->tpl_vars['citationStyle']->value['id'],'params'=>$_smarty_tpl->tpl_vars['citationArgs']->value),$_smarty_tpl ) );?>
"
									data-load-citation
									data-json-href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"citationstylelanguage",'op'=>"get",'path'=>$_smarty_tpl->tpl_vars['citationStyle']->value['id'],'params'=>$_smarty_tpl->tpl_vars['citationArgsJson']->value),$_smarty_tpl ) );?>
"
							>
                                <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['citationStyle']->value['title'] ));?>

							</a>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php if (count($_smarty_tpl->tpl_vars['citationDownloads']->value)) {?>
							<div class="dropdown-divider"></div>
							<h4 class="download-cite">
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"submission.howToCite.downloadCitation"),$_smarty_tpl ) );?>

							</h4>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['citationDownloads']->value, 'citationDownload');
$_smarty_tpl->tpl_vars['citationDownload']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['citationDownload']->value) {
$_smarty_tpl->tpl_vars['citationDownload']->do_else = false;
?>
								<a class="dropdown-item"
								   href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"citationstylelanguage",'op'=>"download",'path'=>$_smarty_tpl->tpl_vars['citationDownload']->value['id'],'params'=>$_smarty_tpl->tpl_vars['citationArgs']->value),$_smarty_tpl ) );?>
">
									<span class="fa fa-download"></span>
                                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['citationDownload']->value['title'] ));?>

								</a>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }
}
}
