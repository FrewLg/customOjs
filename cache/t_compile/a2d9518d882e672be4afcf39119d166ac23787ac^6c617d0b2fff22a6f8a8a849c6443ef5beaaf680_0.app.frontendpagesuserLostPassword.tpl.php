<?php
/* Smarty version 4.3.1, created on 2024-07-27 11:31:22
  from 'app:frontendpagesuserLostPassword.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a4da8adf13a5_77262214',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c617d0b2fff22a6f8a8a849c6443ef5beaaf680' => 
    array (
      0 => 'app:frontendpagesuserLostPassword.tpl',
      1 => 1721890160,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/header.tpl' => 1,
    'app:frontend/components/headings.tpl' => 1,
    'app:frontend/components/footer.tpl' => 1,
  ),
),false)) {
function content_66a4da8adf13a5_77262214 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("app:frontend/components/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pageTitle'=>"user.login.resetPassword"), 0, false);
?>

<main class="page page_lost_password">
	<div class="container-fluid container-page">

		<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/headings.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('currentTitleKey'=>"user.login.resetPassword"), 0, false);
?>

		<div class="row">
			<p class="col-md-6 offset-md-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.login.resetPasswordInstructions"),$_smarty_tpl ) );?>
</p>
		</div>

		<form class="cmp_form lost_password" id="lostPasswordForm" action="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"login",'op'=>"requestResetPassword"),$_smarty_tpl ) );?>
" method="post">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['csrf'][0], array( array(),$_smarty_tpl ) );?>

			<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
				<div class="row">
					<div class="pkp_form_error col-md-6 offset-md-3">
						<div class="alert alert-danger" role="alert"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['error']->value),$_smarty_tpl ) );?>
</div>
					</div>
				</div>
			<?php }?>


			<fieldset class="fields">

				<div class="row">
					<div class="form-group col-md-6 offset-md-3">
						<label for="email" class="visually-hidden"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.login.registeredEmail"),$_smarty_tpl ) );?>
</label>
						<input type="email" class="form-control" name="email" id="email" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['email']->value ));?>
" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.login.registeredEmail"),$_smarty_tpl ) );?>
" required>
						<small class="form-text text-muted"><span class="required">*</span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.required"),$_smarty_tpl ) );?>
</small>
					</div>
				</div>

				<div class="row buttons">
					<div class="col-md-6 offset-md-3">
						<button class="submit btn btn-primary" type="submit">
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.login.resetPassword"),$_smarty_tpl ) );?>

						</button>

						<?php if (!$_smarty_tpl->tpl_vars['disableUserReg']->value) {?>
							<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "registerUrl", null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"user",'op'=>"register",'source'=>$_smarty_tpl->tpl_vars['source']->value),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
							<a href="<?php echo $_smarty_tpl->tpl_vars['registerUrl']->value;?>
" class="register btn">
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"user.login.registerNewAccount"),$_smarty_tpl ) );?>

							</a>
						<?php }?>
					</div>
				</div>
			</fieldset>

		</form>

	</div>
</main><!-- .page -->

<?php $_smarty_tpl->_subTemplateRender("app:frontend/components/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
