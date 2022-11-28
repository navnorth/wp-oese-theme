<?php
/** NALRC Footer **/
?>
<div class="nalrc-footer">
	<div class="nalrc-wrapper">
		<div class="col-md-9 nalrc-nav">
			<?php
				$nalrc_footer_menu = get_option('wp_oese_theme_nalrc_footer');
				if ($nalrc_footer_menu){
					$fnav_items = wp_get_nav_menu_items($nalrc_footer_menu);
					if (!empty($fnav_items)){
						?>
						<nav>
							<ul class="row nalrc-menu">
								<?php
								foreach($fnav_items as $fnav_item){
									?>
									<li class="col-md-2 nav-item">
										<a href="<?php echo esc_url($fnav_item->url); ?>"><?php echo esc_html($fnav_item->title); ?></a>
									</li>
									<?php
								}
								?>
							</ul>
						</nav>
						<?php
					}
				} else {
					_e("Please select header menu for NALRC Page in Theme Settings.",WP_OESE_THEME_SLUG);
				}
			?>
		</div>
		<div class="col-md-3">

		</div>
	</div>
</div>