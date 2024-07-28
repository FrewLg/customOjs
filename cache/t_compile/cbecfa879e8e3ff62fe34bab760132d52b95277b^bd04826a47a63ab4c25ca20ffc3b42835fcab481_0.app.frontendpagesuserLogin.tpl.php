<?php
/* Smarty version 4.3.1, created on 2024-07-27 14:17:42
  from 'app:frontendpagesuserLogin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a5018619dce4_87614705',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd04826a47a63ab4c25ca20ffc3b42835fcab481' => 
    array (
      0 => 'app:frontendpagesuserLogin.tpl',
      1 => 1721847885,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/header.tpl' => 1,
    'app:frontend/components/local/logo.tpl' => 1,
    'app:frontend/components/breadcrumbs.tpl' => 1,
    'app:frontend/components/footer.tpl' => 1,
  ),
),false)) {
function content_66a5018619dce4_87614705 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("app:frontend/components/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pageTitle'=>"user.login"), 0, false);
?>

<div>
	<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/local/logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('small'=>false), 0, false);
?>
</div>

<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg dark:bg-gray-700 page page_login space-y-2">
	<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/breadcrumbs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('currentTitleKey'=>"user.login"), 0, false);
?>
	<h1 class="text-2xl">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.login"),$_smarty_tpl ) );?>

	</h1>

	<p>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.requiredField"),$_smarty_tpl ) );?>

	</p>
		<?php if ($_smarty_tpl->tpl_vars['loginMessage']->value) {?>
		<p>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['loginMessage']->value),$_smarty_tpl ) );?>

		</p>
	<?php }?>

	<form id="login" method="post" action="<?php echo $_smarty_tpl->tpl_vars['loginUrl']->value;?>
" role="form">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>


		<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
			<div class="pkp_form_error font-medium text-red-600 mb-2">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['error']->value,'reason'=>$_smarty_tpl->tpl_vars['reason']->value),$_smarty_tpl ) );?>

			</div>
		<?php }?>

		<input type="hidden" name="source" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( (($tmp = $_smarty_tpl->tpl_vars['source']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) ));?>
" />

		<fieldset class="space-y-4">
			<div class="username">
				<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['material_label'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['material_label'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'smartyMaterialLabel'))) {
throw new SmartyException('block tag \'material_label\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('material_label', array('for'=>"username"));
$_block_repeat=true;
echo $_block_plugin1->smartyMaterialLabel(array('for'=>"username"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.usernameOrEmail"),$_smarty_tpl ) );?>

					<span class="required" aria-hidden="true">*</span>
				<?php $_block_repeat=false;
echo $_block_plugin1->smartyMaterialLabel(array('for'=>"username"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

				<?php ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( (($tmp = $_smarty_tpl->tpl_vars['username']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) ));
$_prefixVariable1=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['material_input'][0], array( array('type'=>"text",'name'=>"username",'id'=>"username",'value'=>$_prefixVariable1,'maxlength'=>"32",'required'=>"true",'aria-required'=>"true",'autocomplete'=>"username",'class'=>"mt-1 block w-full"),$_smarty_tpl ) );?>

			</div>

			<div class="password">
				<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['material_label'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['material_label'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'smartyMaterialLabel'))) {
throw new SmartyException('block tag \'material_label\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('material_label', array('for'=>"password"));
$_block_repeat=true;
echo $_block_plugin2->smartyMaterialLabel(array('for'=>"password"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.password"),$_smarty_tpl ) );?>

					<span class="required" aria-hidden="true">*</span>
				<?php $_block_repeat=false;
echo $_block_plugin2->smartyMaterialLabel(array('for'=>"password"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

				<?php ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( (($tmp = $_smarty_tpl->tpl_vars['password']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) ));
$_prefixVariable2=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['material_input'][0], array( array('type'=>"password",'name'=>"password",'id'=>"password",'value'=>$_prefixVariable2,'password'=>"true",'maxlength'=>"32",'required'=>"true",'aria-required'=>"true",'autocomplete'=>"current-password",'class'=>"mt-1 block w-full"),$_smarty_tpl ) );?>

			</div>

			<div>
				<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"login",'op'=>"lostPassword"),$_smarty_tpl ) );?>
">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.login.forgotPassword"),$_smarty_tpl ) );?>

				</a>
			</div>

			<div class="remember checkbox">
				<label class="flex items-center">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['material_checkbox'][0], array( array('name'=>"remember",'id'=>"remember",'value'=>"1",'checked'=>((string)$_smarty_tpl->tpl_vars['remember']->value)),$_smarty_tpl ) );?>

					<span class="label ml-2 text-sm text-gray-600">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.login.rememberUsernameAndPassword"),$_smarty_tpl ) );?>

					</span>
				</label>
			</div>

						<?php if ($_smarty_tpl->tpl_vars['recaptchaPublicKey']->value) {?>
				<fieldset class="recaptcha_wrapper">
					<div class="fields">
						<div class="recaptcha">
							<div class="g-recaptcha" data-sitekey="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['recaptchaPublicKey']->value ));?>
">
							</div><label for="g-recaptcha-response" style="display:none;" hidden>Recaptcha response</label>
						</div>
					</div>
				</fieldset>
			<?php }?>

			<div class="buttons space-x-2">
				<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['material_button_primary'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['material_button_primary'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'smartyMaterialButtonPrimary'))) {
throw new SmartyException('block tag \'material_button_primary\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('material_button_primary', array('type'=>"submit"));
$_block_repeat=true;
echo $_block_plugin3->smartyMaterialButtonPrimary(array('type'=>"submit"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.login"),$_smarty_tpl ) );?>

				<?php $_block_repeat=false;
echo $_block_plugin3->smartyMaterialButtonPrimary(array('type'=>"submit"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

				<?php if (!$_smarty_tpl->tpl_vars['disableUserReg']->value) {?>
					<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'registerUrl', null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"user",'op'=>"register",'source'=>$_smarty_tpl->tpl_vars['source']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
					<a href="<?php echo $_smarty_tpl->tpl_vars['registerUrl']->value;?>
" class="register">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.login.registerNewAccount"),$_smarty_tpl ) );?>

					</a>
				<?php }?>
			</div>
		</fieldset>
	</form>
</div><!-- .page -->

<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
