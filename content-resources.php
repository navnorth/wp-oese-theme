<?php
//Display Resources
                    $subpages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'asc' ) );
?>
<div class="right_sid_mtr program_toc_box" id="toc">
	<div class="col-md-12 col-sm-6 col-xs-6" style="border: 3px solid #00529f;margin-bottom:10px;">
		<div class="pblctn_box">
			<span class="socl_icns fa-stack"><i class="fa fa-link"></i></span>
		</div>
		<div class="cntnbx_cntnr">
			<span class="program_toc_header">Resources</span>
			<ul class="program_toc">
				<!--<li><a href="http://oii-test.navnorth.com/initiatives-and-projects/innovation/investing-in-innovation-i3/">Main</a></li>
				<li>
					<a href="http://oii-test.navnorth.com/initiatives-and-projects/innovation/investing-in-innovation-i3/applicant-information-and-eligibility/" title="Applicant Information and Eligibility">
						Applicant Information and Eligibility
					</a>
				</li>
				<li>
					<a href="http://oii-test.navnorth.com/initiatives-and-projects/innovation/investing-in-innovation-i3/funding-legislation/" title="Funding &#038; Legislation">
						Funding &#038; Legislation
					</a>
				</li>
				<li>Awards</li>-->
				<?php
					if ($subpages) {
						?>
						<li>Main</li>
						<?php
						foreach($subpages as $spage) {
							?>
							<li>
								<a href="<?php echo get_page_link($spage->ID); ?>"><?php echo $spage->post_title; ?></a>	
							</li>
							<?php 
						}
					}
				?>
			</ul>
			<p>
		</div>
	</div>
</div>