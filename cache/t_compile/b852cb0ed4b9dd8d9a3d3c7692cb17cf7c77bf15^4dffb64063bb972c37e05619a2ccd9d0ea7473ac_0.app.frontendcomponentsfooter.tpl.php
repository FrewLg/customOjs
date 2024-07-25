<?php
/* Smarty version 4.3.1, created on 2024-07-25 17:35:12
  from 'app:frontendcomponentsfooter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a28cd0f35758_51464730',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4dffb64063bb972c37e05619a2ccd9d0ea7473ac' => 
    array (
      0 => 'app:frontendcomponentsfooter.tpl',
      1 => 1721928367,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a28cd0f35758_51464730 (Smarty_Internal_Template $_smarty_tpl) {
?>

<footer class="site-footer" style="background-color: rgb(#041b25, green, blue);">
	<div class="container-fluid container-footer" style="background-color: rgb(#041b25, green, blue);">
		<?php if ($_smarty_tpl->tpl_vars['hasSidebar']->value) {?>
		<div class="sidebar_wrapper" role="complementary">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Templates::Common::Sidebar"),$_smarty_tpl ) );?>

		</div>
		<?php }?>
		<!-- <div class="additional-footer-info">
			<?php if ($_smarty_tpl->tpl_vars['pageFooter']->value) {?>
				<div class="user-page-footer">
					<?php echo $_smarty_tpl->tpl_vars['pageFooter']->value;?>

				</div>
			<?php }?>
		</div>  -->
	</div>
</footer>

<footer class="text-center text-lg-start text-white" style="background-color: #041b25;">
	<div class="container p-4 pb-0">
		<section class="">
			<div class="row">
				<div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold">About Scholars In</h6>
					<p>
					Welcome to Scholars In, where we are dedicated to advancing scientific knowledge and fostering innovation through high-quality publications and collaborations.
					
				</p>
				</div>
				<hr class="w-100 clearfix d-md-none" />
				<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold">Main contents</h6>
					<p><a href="https://scholarsin.com/index.php/index/obligations-for-authors">Obligatory for Authors</a></p>
					<p><a href="https://scholarsin.com/index.php/index/Double-blind-Peer-Review-Process">Review Process</a></p>
					<p><a href="https://scholarsin.com/index.php/index/ScholarsIn-press">ScholarsIn-Press</a></p>
					<p><a href="https://scholarsin.com/index.php/index/index">All ScholarsIn-Journals</a></p>
				</div>
				<hr class="w-100 clearfix d-md-none" />
				<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
					<p><a href="https://scholarsin.com/index.php/index/Ethical-Principles">Ethical Principle</a></p>
					<p><a href="https://scholarsin.com/index.php/index/login">Become an Member</a></p>
					<p><a href="https://ScholarsIn.com">Official Website</a></p>
					<p><a href="https://scholarsin.com/index.php/index/publication-policy">Publication Policy</a></p>
				</div>
				<hr class="w-100 clearfix d-md-none" />
				<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
					<p>Addis Ababa, Ethiopia</p>
					<p><a href="mailto:ScholarsIn@ScholarsIn.com">editorials@ScholarsIn.com</a></p>
					<p><a href="tel://+251911349211">+2511127653333</a></p>
				</div>
			</div>
		</section>
		<hr class="my-2" />
		<section class="p-2 pt-2 mt-2">
			<div class="row d-flex align-items-center">
				<div class="col-md-12 col-sm-12 col-lg-12 text-center  my-8">
					<div class="p-8 m-2">Copyright ©2024 
						<strong> <a href="http://scholarsin.com/index.php/">ScholarsIn</a>,</strong>
						All rights reserved.
					</div>
				</div>
			</div>
		</section>
	</div>
</footer>
<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['load_script'][0], array( array('context'=>"frontend"),$_smarty_tpl ) );?>


<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['call_hook'][0], array( array('name'=>"Templates::Common::Footer::PageFooter"),$_smarty_tpl ) );?>


</body>

</html><?php }
}
