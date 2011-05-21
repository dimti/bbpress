<?php

/**
 * Split/merge topic page
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<?php do_action( 'bbp_template_notices' ); ?>

				<?php while ( have_posts() ) the_post(); ?>

					<div id="bbp-edit-page" class="bbp-edit-page">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="entry-content">

							<?php bbp_get_template_part( 'bbpress/nav', 'breadcrumb' ); ?>

							<?php if ( bbp_is_topic_merge() ) : ?>

								<?php bbp_get_template_part( 'bbpress/form', 'merge' ); ?>

							<?php elseif ( bbp_is_topic_split() ) : ?>

								<?php bbp_get_template_part( 'bbpress/form', 'split' ); ?>

							<?php endif; ?>

						</div>
					</div><!-- #bbp-edit-page -->

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>