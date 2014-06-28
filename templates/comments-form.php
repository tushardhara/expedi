<?php if ('open' == $post->comment_status) : ?>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>Du måste vara <a href="<?php echo wp_login_url( get_permalink() ); ?>">inloggad</a> för att kommentera.</p><br/>
	<?php else : ?>

					<!-- Start of form --> 
					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment_form"> 
					<fieldset> 

			
			
						<h5 class="cufon"><?php _e( 'Kommentera', THEMEDOMAIN ); ?></h5>
						
						<?php if ( is_user_logged_in() ) : ?>

					Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a><br/><br/>

			<?php else : ?>
						<br/>
						<p> 
							<input class="round m input" title="<?php _e( 'Namn', THEMEDOMAIN ); ?>*" name="author" type="text" id="author" value="" tabindex="1" style="width:50%" /> 
						</p> 
						<br/>
						<p> 
							<input class="round m input" title="<?php _e( 'E-post', THEMEDOMAIN ); ?>*" name="email" type="text" id="email" value="" tabindex="2" style="width:50%" /> 
						</p> 
						<br/>
						<p> 
							<input class="round m input" title="<?php _e( 'Hemsida', THEMEDOMAIN ); ?>" name="url" type="text" id="url" value="" tabindex="3" style="width:50%" /> 
						</p> 
						<br/>

			<?php endif; ?>
						
						<p>  
							<textarea name="comment" title="<?php _e( 'Meddelande', THEMEDOMAIN ); ?>*" cols="40" rows="3" id="comment" tabindex="4" style="width:96%"></textarea> 
						</p> 
						<br /> 
						<p> 
							<input name="submit" type="submit" id="submit" value="<?php _e( 'Submit', THEMEDOMAIN ); ?>" tabindex="5" />&nbsp;
							<?php cancel_comment_reply_link("Avbryt"); ?> 
						</p> 
						<?php comment_id_fields(); ?> 
						<?php do_action('comment_form', $post->ID); ?>

					</fieldset> 
					</form> 
					<!-- End of form --> 
			

	<?php endif; // If registration required and not logged in ?>

<?php endif; // if comment is open ?>
