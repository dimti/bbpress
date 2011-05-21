<?php

/**
 * New/Edit Topic
 *
 * @package bbPress
 * @subpackage Theme
 */

// Make sure we're back where we started
wp_reset_postdata();

?>

<?php if ( bbp_current_user_can_access_create_topic_form() ) : ?>

	<?php if ( bbp_current_user_can_create_topic_in_forum() ) : ?>

		<div id="new-topic-<?php bbp_topic_id(); ?>" class="bbp-topic-form">

			<form id="new-post" name="new-post" method="post" action="">
				<fieldset>
					<legend>

						<?php
							if ( bbp_is_topic_edit() )
								printf( __( 'Edit topic "%s"', 'bbpress' ), bbp_get_topic_title() );
							else
								bbp_is_forum() ? printf( __( 'Create new topic in: &ldquo;%s&rdquo;', 'bbpress' ), bbp_get_forum_title() ) : _e( 'Create new topic', 'bbpress' );
						?>

					</legend>

					<?php if ( !bbp_is_topic_edit() && bbp_is_forum_closed() ) : ?>

						<div class="bbp-template-notice">
							<p><?php _e( 'This forum is marked as closed to new topics, however your posting capabilities still allow you to do so.', 'bbpress' ); ?></p>
						</div>

					<?php endif; ?>

					<?php do_action( 'bbp_template_notices' ); ?>

					<div>
						<div class="alignright avatar">

							<?php bbp_is_topic_edit() ? bbp_topic_author_avatar( bbp_get_topic_id(), 120 ) : bbp_current_user_avatar( 120 ); ?>

						</div>

						<?php bbp_get_template_part( 'bbpress/form', 'anonymous' ); ?>

						<p>
							<label for="bbp_topic_title"><?php _e( 'Topic Title:', 'bbpress' ); ?></label><br />
							<input type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_title" />
						</p>

						<p>
							<label for="bbp_topic_content"><?php _e( 'Topic Description:', 'bbpress' ); ?></label><br />
							<textarea id="bbp_topic_content" tabindex="<?php bbp_tab_index(); ?>" name="bbp_topic_content" cols="51" rows="6"><?php bbp_form_topic_content(); ?></textarea>
						</p>

						<p class="form-allowed-tags">
							<label><?php _e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:','bbpress' ); ?></label><br />
							<code><?php bbp_allowed_tags(); ?></code>
						</p>

						<p>
							<label for="bbp_topic_tags"><?php _e( 'Topic Tags:', 'bbpress' ); ?></label><br />
							<input type="text" value="<?php bbp_form_topic_tags(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_tags" id="bbp_topic_tags" />
						</p>

						<?php if ( !bbp_is_forum() ) : ?>

							<p>
								<label for="bbp_forum_id"><?php _e( 'Forum:', 'bbpress' ); ?></label><br />
								<?php bbp_dropdown( array( 'selected' => bbp_get_form_topic_forum() ) ); ?>
							</p>

						<?php endif; ?>

						<?php if ( current_user_can( 'moderate' ) ) : ?>

							<p>

								<label for="bbp_stick_topic"><?php _e( 'Topic Type:', 'bbpress' ); ?></label><br />

								<?php bbp_topic_type_select(); ?>

							</p>

						<?php endif; ?>

						<?php if ( bbp_is_subscriptions_active() && !bbp_is_anonymous() && ( !bbp_is_topic_edit() || ( bbp_is_topic_edit() && !bbp_is_topic_anonymous() ) ) ) : ?>

							<p>
								<input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe" <?php bbp_form_topic_subscribed(); ?> tabindex="<?php bbp_tab_index(); ?>" />

								<?php if ( bbp_is_topic_edit() && ( $post->post_author != bbp_get_current_user_id() ) ) : ?>

									<label for="bbp_topic_subscription"><?php _e( 'Notify the author of follow-up replies via email', 'bbpress' ); ?></label>

								<?php else : ?>

									<label for="bbp_topic_subscription"><?php _e( 'Notify me of follow-up replies via email', 'bbpress' ); ?></label>

								<?php endif; ?>
							</p>

						<?php endif; ?>

						<?php if ( bbp_is_topic_edit() ) : ?>

							<fieldset>
								<legend><?php _e( 'Revision', 'bbpress' ); ?></legend>
								<div>
									<input name="bbp_log_topic_edit" id="bbp_log_topic_edit" type="checkbox" value="1" <?php bbp_form_topic_log_edit(); ?> tabindex="<?php bbp_tab_index(); ?>" />
									<label for="bbp_log_topic_edit"><?php _e( 'Keep a log of this edit:', 'bbpress' ); ?></label><br />
								</div>

								<div>
									<label for="bbp_topic_edit_reason"><?php printf( __( 'Optional reason for editing:', 'bbpress' ), bbp_get_current_user_name() ); ?></label><br />
									<input type="text" value="<?php bbp_form_topic_edit_reason(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_edit_reason" id="bbp_topic_edit_reason" />
								</div>
							</fieldset>

						<?php endif; ?>

						<div class="bbp-submit-wrapper">
							<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_topic_submit" name="bbp_topic_submit"><?php _e( 'Submit', 'bbpress' ); ?></button>
						</div>
					</div>

					<?php bbp_topic_form_fields(); ?>

				</fieldset>
			</form>
		</div>

	<?php elseif ( bbp_is_forum_closed() ) : ?>

		<div id="no-topic-<?php bbp_topic_id(); ?>" class="bbp-no-topic">
			<h2 class="entry-title"><?php _e( 'Sorry!', 'bbpress' ); ?></h2>
			<div class="bbp-template-notice">
				<p><?php _e( 'This forum is closed to new topics.', 'bbpress' ); ?></p>
			</div>
		</div>

	<?php endif; ?>

<?php else : ?>

	<div id="no-topic-<?php bbp_topic_id(); ?>" class="bbp-no-topic">
		<h2 class="entry-title"><?php _e( 'Sorry!', 'bbpress' ); ?></h2>
		<div class="bbp-template-notice">
			<p><?php is_user_logged_in() ? _e( 'You cannot create new topics at this time.', 'bbpress' ) : _e( 'You must be logged in to create new topics.', 'bbpress' ); ?></p>
		</div>
	</div>


<?php endif; ?>