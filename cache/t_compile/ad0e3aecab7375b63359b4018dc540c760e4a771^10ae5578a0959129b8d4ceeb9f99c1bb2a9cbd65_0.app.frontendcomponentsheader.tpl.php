<?php
/* Smarty version 4.3.1, created on 2024-07-25 10:51:51
  from 'app:frontendcomponentsheader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a22e47219a58_05388155',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10ae5578a0959129b8d4ceeb9f99c1bb2a9cbd65' => 
    array (
      0 => 'app:frontendcomponentsheader.tpl',
      1 => 1721847885,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/headerHead.tpl' => 1,
    'app:frontend/components/local/sideStack.tpl' => 1,
    'app:frontend/components/local/logo.tpl' => 1,
    'app:frontend/components/ui/searchIcon.tpl' => 1,
    'app:frontend/components/ui/material_theme_selector.tpl' => 1,
    'app:frontend/components/headerSection.tpl' => 1,
  ),
),false)) {
function content_66a22e47219a58_05388155 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/cornerstone/Desktop/projects/Upwork/ojs-3.4.0-6/lib/pkp/lib/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
$_smarty_tpl->_assignInScope('showingLogo', true);
if (!$_smarty_tpl->tpl_vars['displayPageHeaderLogo']->value) {
$_smarty_tpl->_assignInScope('showingLogo', false);
}?>
<!DOCTYPE html>
<html lang="<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['currentLocale']->value,"_","-");?>
"
	xml:lang="<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['currentLocale']->value,"_","-");?>
"
	
  		x-data="{ darkMode: localStorage.getItem('darkMode') || localStorage.setItem('darkMode', 'system') }" 
  		x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" 
  		x-bind:class="{'dark': darkMode === 'dark' || (darkMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)}"
  	>

<?php if (!$_smarty_tpl->tpl_vars['pageTitleTranslated']->value) {?>
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "pageTitleTranslated", null);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['pageTitle']->value),$_smarty_tpl ) );?>

	<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
}
$_smarty_tpl->_subTemplateRender("app:frontend/components/headerHead.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->_assignInScope('materialBaseColour', $_smarty_tpl->tpl_vars['activeTheme']->value->getOption('materialBaseColour'));?>

<body class="bg-white dark:bg-slate-900 pkp_page_<?php echo (($tmp = call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['requestedPage']->value )) ?? null)===null||$tmp==='' ? "index" ?? null : $tmp);?>
 pkp_op_<?php echo (($tmp = call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['requestedOp']->value )) ?? null)===null||$tmp==='' ? "index" ?? null : $tmp);
if ($_smarty_tpl->tpl_vars['showingLogo']->value) {?> has_site_logo<?php }?>" dir="<?php echo (($tmp = call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['currentLocaleLangDir']->value )) ?? null)===null||$tmp==='' ? "ltr" ?? null : $tmp);?>
">

<?php if ($_smarty_tpl->tpl_vars['requestedPage']->value !== 'login' && $_smarty_tpl->tpl_vars['requestedPage']->value !== 'user') {?>

	<!-- ======= Header ======= -->
	<header class="sticky top-0 z-50 flex flex-none flex-wrap items-center justify-between bg-white px-4 py-5 shadow-md shadow-slate-900/5 transition duration-500 sm:px-6 lg:px-8 dark:shadow-none dark:bg-slate-900/95 dark:backdrop-blur dark:[@supports(backdrop-filter:blur(0))]:bg-slate-900/75">
				
		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/local/sideStack.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		<div class="relative flex flex-grow basis-0 items-center">
			<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/local/logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('small'=>true), 0, false);
?>
		</div>
		<div class="flex items-center space-x-2">
						<?php if ($_smarty_tpl->tpl_vars['currentContext']->value && $_smarty_tpl->tpl_vars['requestedPage']->value !== 'search') {?>
				<div class="pkp_navigation_search_wrapper">
					<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"search"),$_smarty_tpl ) );?>
" class="flex h-8 w-8 items-center justify-center rounded-lg shadow-md shadow-black/5 ring-1 ring-black/5 dark:bg-slate-700 dark:ring-inset dark:ring-white/5">
						<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/ui/searchIcon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
					</a>
				</div>
			<?php }?>
						<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/ui/material_theme_selector.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_menu'][0], array( array('name'=>"user",'id'=>"navigationUser",'ulClass'=>"pkp_navigation_user",'liClass'=>"profile"),$_smarty_tpl ) );?>

		</div>
	</header>

	<?php if ($_smarty_tpl->tpl_vars['requestedPage']->value == 'index' || $_smarty_tpl->tpl_vars['requestedPage']->value == '') {?>
		<?php if ($_smarty_tpl->tpl_vars['currentContext']->value) {?>
			<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/headerSection.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php }?>
	<?php }?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "primaryMenu", null);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_menu'][0], array( array('name'=>"primary",'id'=>"navigationPrimary",'ulClass'=>"pkp_navigation_primary"),$_smarty_tpl ) );?>

	<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

	<div class="relative mx-auto flex w-full max-w-8xl flex-auto justify-center sm:px-2 lg:px-8 xl:px-12">
		<div class="hidden lg:relative lg:block lg:flex-none">
			<div class="absolute inset-y-0 right-0 w-[50vw] bg-slate-50 dark:hidden">
			</div>
			<div class="absolute bottom-0 right-0 top-16 hidden h-12 w-px bg-gradient-to-t from-slate-800 dark:block">
			</div>
			<div class="absolute bottom-0 right-0 top-28 hidden w-px bg-slate-800 dark:block">
			</div>
			<div class="sticky top-[4.75rem] -ml-0.5 h-[calc(100vh-4.75rem)] w-64 overflow-y-auto overflow-x-hidden py-16 pl-0.5 pr-8 xl:w-72 xl:pr-16">
				<nav class="text-base lg:text-sm">
										<?php echo $_smarty_tpl->tpl_vars['primaryMenu']->value;?>

				</nav>
			</div>
		</div>

				<?php if ($_smarty_tpl->tpl_vars['isFullWidth']->value) {?>
			<?php $_smarty_tpl->_assignInScope('hasSidebar', 0);?>
		<?php }?>

				<main class="min-w-0 max-w-2xl flex-auto px-4 py-16 lg:max-w-none lg:pl-8 lg:pr-0 xl:px-16 dark:text-white">
			<a id="pkp_content_main"></a>
			<article>
				<!--div class="prose prose-slate max-w-none dark:prose-invert dark:text-slate-400 prose-headings:scroll-mt-28 prose-headings:font-display prose-headings:font-normal lg:prose-headings:scroll-mt-[8.5rem] prose-lead:text-slate-500 dark:prose-lead:text-slate-400 prose-a:font-semibold dark:prose-a:text-sky-400 prose-a:no-underline prose-a:shadow-[inset_0_-2px_0_0_var(--tw-prose-background,#fff),inset_0_calc(-1*(var(--tw-prose-underline-size,4px)+2px))_0_0_var(--tw-prose-underline,theme(colors.sky.300))] hover:prose-a:[--tw-prose-underline-size:6px] dark:[--tw-prose-background:theme(colors.slate.900)] dark:prose-a:shadow-[inset_0_calc(-1*var(--tw-prose-underline-size,2px))_0_0_var(--tw-prose-underline,theme(colors.sky.800))] dark:hover:prose-a:[--tw-prose-underline-size:6px] prose-pre:rounded-xl prose-pre:bg-slate-900 prose-pre:shadow-lg dark:prose-pre:bg-slate-800/60 dark:prose-pre:shadow-none dark:prose-pre:ring-1 dark:prose-pre:ring-slate-300/10 dark:prose-hr:border-slate-800"-->
				<div  class="prose prose-slate max-w-none prose-a:text-<?php echo $_smarty_tpl->tpl_vars['materialBaseColour']->value;?>
-400 dark:prose-a:text-<?php echo $_smarty_tpl->tpl_vars['materialBaseColour']->value;?>
-400 dark:prose-invert dark:text-slate-400 dark:prose-lead:text-slate-400 prose-headings:font-normal">
<?php } else { ?>
	<main class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 dark:text-white" role="main">
		<a id="pkp_content_main"></a>
<?php }
}
}
