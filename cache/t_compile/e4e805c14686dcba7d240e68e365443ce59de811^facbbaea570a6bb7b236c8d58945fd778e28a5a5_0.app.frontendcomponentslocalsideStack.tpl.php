<?php
/* Smarty version 4.3.1, created on 2024-07-25 10:51:47
  from 'app:frontendcomponentslocalsideStack.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a22e436dc815_37680996',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'facbbaea570a6bb7b236c8d58945fd778e28a5a5' => 
    array (
      0 => 'app:frontendcomponentslocalsideStack.tpl',
      1 => 1721847885,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/local/sidebar.tpl' => 1,
  ),
),false)) {
function content_66a22e436dc815_37680996 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="mr-6 flex xl:hidden" x-data="{ open: false }">
	<button type="button"
		class="relative"
		aria-label="Open navigation"
		x-on:click="open = !open" x-show="!open">
		<svg aria-hidden="true"
			viewBox="0 0 24 24"
			fill="none"
			stroke-width="2"
			stroke-linecap="round"
			class="h-6 w-6 stroke-slate-500" x-show="!open">
			<path d="M4 7h16M4 12h16M4 17h16"></path>
		</svg>
	</button>

	<div class="h-screen fixed inset-0 z-50 flex items-start overflow-y-auto bg-slate-900/50 pr-10 backdrop-blur xl:hidden"
		aria-label="Navigation"
		id="headlessui-dialog-:R35la:"
		role="dialog"
		aria-modal="true"
		data-headlessui-state="open"
		x-show="open">
		<div class="min-h-full w-full max-w-xs bg-white px-4 pb-12 pt-5 sm:px-6 dark:bg-slate-900"
			id="headlessui-dialog-panel-:r3:"
			data-headlessui-state="open">
			<div class="flex items-center">
				<button type="button"
					class="relative"
					aria-label="Open navigation"
					x-on:click="open = !open" x-show="open">
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
			<div>
				<div class="mt-5 lg:hidden">
					<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "primaryMenu", null);?>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_menu'][0], array( array('name'=>"primary",'id'=>"navigationPrimary",'ulClass'=>"pkp_navigation_primary"),$_smarty_tpl ) );?>

					<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
					<?php echo $_smarty_tpl->tpl_vars['primaryMenu']->value;?>

				</div>
				<div class="mt-5">
					<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/local/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				</div>
			</div>
		</div>
	</div>
	<div style="position:fixed;top:1px;left:1px;width:1px;height:0;padding:0;margin:-1px;overflow:hidden;clip:rect(0, 0, 0, 0);white-space:nowrap;border-width:0;display:none">				
	</div>
</div>
<?php }
}
