{**
* templates/frontend/components/footer.tpl
*
* Copyright (c) 2014-2020 Simon Fraser University
* Copyright (c) 2003-2020 John Willinsky
* Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
*
* @brief Site-wide footer; designed to contain a sidebar hook
*
*}


<footer class="site-footer" style="background-color: rgb(#041b25, green, blue);">
	<div class="container-fluid container-footer" style="background-color: rgb(#041b25, green, blue);">
		{if $hasSidebar}
		<div class="sidebar_wrapper" role="complementary">
			{call_hook name="Templates::Common::Sidebar"}
		</div>
		{/if}
		<!-- <div class="additional-footer-info">
			{if $pageFooter}
				<div class="user-page-footer">
					{$pageFooter}
				</div>
			{/if}
		</div>  -->
	</div>
</footer>

<footer class="text-center text-lg-start text-white" style="background-color: #041b25;">
	<div class="container p-4 pb-0">
		<section class="">
			<div class="row">
				<div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold" style="color: #ffb842;">About Scholars In</h6>
					<p>
					Welcome to Scholars In, where we are dedicated to advancing scientific knowledge and fostering innovation through high-quality publications and collaborations.
					
				</p>
				</div>
				<hr class="w-100 clearfix d-md-none" />
				<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold" style="color: #ffb842;">Main contents</h6>
					<p><a href="https://scholarsin.com/index.php/index/obligations-for-authors">Obligatory for Authors</a></p>
					<p><a href="https://scholarsin.com/index.php/index/Double-blind-Peer-Review-Process">Review Process</a></p>
					<p><a href="https://scholarsin.com/index.php/index/ScholarsIn-press">ScholarsIn-Press</a></p>
					<p><a href="https://scholarsin.com/index.php/index/index">All ScholarsIn-Journals</a></p>
				</div>
				<hr class="w-100 clearfix d-md-none" />
				<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold" style="color: #ffb842;">Useful links</h6>
					<p><a href="https://scholarsin.com/index.php/index/Ethical-Principles">Ethical Principle</a></p>
					<p><a href="https://scholarsin.com/index.php/index/login">Become an Member</a></p>
					<p><a href="https://ScholarsIn.com">Official Website</a></p>
					<p><a href="https://scholarsin.com/index.php/index/publication-policy">Publication Policy</a></p>
				</div>
				<hr class="w-100 clearfix d-md-none" />
				<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold" style="color: #ffb842;">Contact</h6>
				 
					<p>Malaysia Office: Mercu Summer, Jalan Cendana, Kuala Lumpur</p>
					<p>London office: 124 City Road, London, England, EC1V 2NX</p>
					
						<p><a href="mailto:saleem@scholarsin.com">saleem@scholarsin.com</a></p>
				<!--	<p><a href="tel://+251911349211">+2511127653333</a></p> -->
				</div>
			</div>
		</section>
		<hr class="my-2" />
		<section class="p-2 pt-2 mt-2">
			<div class="row d-flex align-items-center">
				<div class="col-md-12 col-sm-12 col-lg-12 text-center  my-8">
					<div class="p-8 m-2">Copyright © <script>
												document.write(new Date().getFullYear())
											</script>
						<strong> <a href="https://scholarsin.com/index.php/" style="color: #ffb842;">ScholarsIn</a>,</strong>
						All rights reserved.
					</div>
				</div>
			</div>
		</section>
	</div>
</footer>
{load_script context="frontend"}

{call_hook name="Templates::Common::Footer::PageFooter"}

</body>

</html>