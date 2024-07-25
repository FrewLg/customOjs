<?php
/* Smarty version 4.3.1, created on 2024-07-25 10:51:47
  from 'app:frontendcomponentsnavigationMenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a22e4378a520_99557316',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1cc18a7bbca2985eb7be7cdb004989925d5981ed' => 
    array (
      0 => 'app:frontendcomponentsnavigationMenu.tpl',
      1 => 1721847885,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/local/navigationUser.tpl' => 2,
  ),
),false)) {
function content_66a22e4378a520_99557316 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('materialBaseColour', $_smarty_tpl->tpl_vars['activeTheme']->value->getOption('materialBaseColour'));?>

<?php if ($_smarty_tpl->tpl_vars['navigationMenu']->value) {?>
	<?php if ($_smarty_tpl->tpl_vars['id']->value == "navigationPrimary") {?>
		<ul id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id']->value ));?>
" role="list" class="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['ulClass']->value ));?>
 space-y-9">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['navigationMenu']->value->menuTree, 'navigationMenuItemAssignment', false, 'field');
$_smarty_tpl->tpl_vars['navigationMenuItemAssignment']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field']->value => $_smarty_tpl->tpl_vars['navigationMenuItemAssignment']->value) {
$_smarty_tpl->tpl_vars['navigationMenuItemAssignment']->do_else = false;
?>
				<?php if (!$_smarty_tpl->tpl_vars['navigationMenuItemAssignment']->value->navigationMenuItem->getIsDisplayed()) {?>
					<?php continue 1;?>
				<?php }?>
				<li class="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['liClass']->value ));?>
">
					<a href="<?php echo $_smarty_tpl->tpl_vars['navigationMenuItemAssignment']->value->navigationMenuItem->getUrl();?>
" class="font-display font-medium text-slate-900 dark:text-white">
						<?php echo $_smarty_tpl->tpl_vars['navigationMenuItemAssignment']->value->navigationMenuItem->getLocalizedTitle();?>

					</a>
					<?php if ($_smarty_tpl->tpl_vars['navigationMenuItemAssignment']->value->navigationMenuItem->getIsChildVisible()) {?>
						<ul role="list" class="mt-2 space-y-2 border-l-2 border-slate-100 lg:mt-4 lg:space-y-4 lg:border-slate-200 dark:border-slate-800">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['navigationMenuItemAssignment']->value->children, 'childNavigationMenuItemAssignment', false, 'childField');
$_smarty_tpl->tpl_vars['childNavigationMenuItemAssignment']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['childField']->value => $_smarty_tpl->tpl_vars['childNavigationMenuItemAssignment']->value) {
$_smarty_tpl->tpl_vars['childNavigationMenuItemAssignment']->do_else = false;
?>
								<?php if ($_smarty_tpl->tpl_vars['childNavigationMenuItemAssignment']->value->navigationMenuItem->getIsDisplayed()) {?>
									<li class="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['liClass']->value ));?>
 relative">
										<a href="<?php echo $_smarty_tpl->tpl_vars['childNavigationMenuItemAssignment']->value->navigationMenuItem->getUrl();?>
" class="block w-full pl-3.5 before:pointer-events-none before:absolute before:-left-1 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-y-1/2 before:rounded-full font-semibold text-<?php echo $_smarty_tpl->tpl_vars['materialBaseColour']->value;?>
-500 before:bg-<?php echo $_smarty_tpl->tpl_vars['materialBaseColour']->value;?>
-500">
											<?php echo $_smarty_tpl->tpl_vars['childNavigationMenuItemAssignment']->value->navigationMenuItem->getLocalizedTitle();?>

										</a>
									</li>
								<?php }?>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</ul>
					<?php }?>
				</li>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ul>
	<?php } elseif ($_smarty_tpl->tpl_vars['id']->value == "navigationUser") {?>
				<div class="md:flex hidden">
			<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/local/navigationUser.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id'=>$_smarty_tpl->tpl_vars['id']->value,'ulClass'=>$_smarty_tpl->tpl_vars['ulClass']->value,'liClass'=>$_smarty_tpl->tpl_vars['liClass']->value,'navigationMenu'=>$_smarty_tpl->tpl_vars['navigationMenu']->value,'mobile'=>false), 0, false);
?>
		</div>

				<div x-data="{ open: false }">
			<button class="flex h-8 items-center justify-center rounded-lg shadow-md shadow-black/5 ring-1 ring-black/5 dark:bg-slate-700 dark:ring-inset dark:ring-white/5 px-3 text-sm dark:text-slate-400 dark:before:bg-slate-700 dark:hover:text-slate-300 md:hidden" x-on:click="open = true">
				<svg xmlns="http://www.w3.org/2000/svg"
					class="h-4 w-4 text-slate-400"
					viewBox="0 0 24 24"
					fill="none"
					stroke="currentColor"
					stroke-width="2"
					stroke-linecap="round"
					stroke-linejoin="round">
					<path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9"/>
					<path d="M9 22V12h6v10M2 10.6L12 2l10 8.6"/>
				</svg>
			</button>
			<div x-show="open">
				<div class="h-screen fixed inset-0 z-50" id="headlessui-dialog-:Rmdla:" role="dialog" aria-modal="true" data-headlessui-state="open">
					<div class="h-screen fixed inset-0 bg-slate-900/50 backdrop-blur">
					</div>
					<div class="h-screen fixed inset-0 overflow-y-auto px-4 py-4 sm:px-6 sm:py-20 md:py-32 lg:px-8 lg:py-[15vh]">
						<div class="mx-auto transform-gpu overflow-hidden rounded-xl bg-white shadow-xl sm:max-w-xl dark:bg-slate-800 dark:ring-1 dark:ring-slate-700 rounded-lg p-4 text-slate-500">
							<div class="flex justify-end pb-4">
								<button type="button"
									class="relative"
									aria-label="Open navigation"
									x-on:click="open = !open">
									<svg aria-hidden="true"
										viewBox="0 0 24 24"
										fill="none"
										stroke-width="2"
										stroke-linecap="round"
										class="h-6 w-6 stroke-slate-500">
										<path d="M5 5l14 14M19 5l-14 14"></path>
									</svg>
								</button>
							</div>
							<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/local/navigationUser.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('id'=>$_smarty_tpl->tpl_vars['id']->value,'ulClass'=>$_smarty_tpl->tpl_vars['ulClass']->value,'liClass'=>$_smarty_tpl->tpl_vars['liClass']->value,'navigationMenu'=>$_smarty_tpl->tpl_vars['navigationMenu']->value,'mobile'=>true), 0, true);
?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }
}?>

<?php }
}
