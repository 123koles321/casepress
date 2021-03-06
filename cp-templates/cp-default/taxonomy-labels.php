<?php
	/**
	 * Шаблон таксономии Ярлыки (labels)
	 */
	get_header();
?>

<?php do_action('cp_content_before'); ?>
<div id="content" class="clearfix row-fluid">
	<?php do_action('cp_sidebar_before'); ?>
	<aside id="sidebar" class="fluid-sidebar sidebar span3" role="complementary">
		<?php do_action('cp_sidebar_inside_before'); ?>
		<div class="well">
			<?php dynamic_sidebar( 'cases' ); ?>
		</div>
		<?php do_action('cp_sidebar_inside_after'); ?>
	</aside><!-- /#sidebar -->
	<?php do_action('cp_sidebar_after'); ?>

	<?php do_action('cp_main_before'); ?>
	<div id="main" class="span9 clearfix" role="main">
		<?php
			// Term description
			$category_description = category_description();
			if ( !empty( $category_description ) )
				echo apply_filters( 'category_archive_meta', '<div class="page-header">' . $category_description . '</div>' );
		?>
		<?php do_action('cp_loop_before'); ?>
		<?php /* Start loop */ ?>
		<?php
			// DataTable
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$ctmeta_datable_params = ( array ) ( function_exists( 'ctmeta_get_formatted_datatable_params' ) && ctmeta_get_formatted_datatable_params( 'ctmeta_datatable_params', 'labels', $term->term_id ) ) ? ctmeta_get_formatted_datatable_params( 'ctmeta_datatable_params', 'labels', $term->term_id ) : array(
				'fields' => 'ID:int, post_title:link, initiator:post, responsible:post, prioritet:int, date_deadline:date, state:tax, functions:tax'
				);
			$ctmeta_datable_params['class'] = 'tax-open';
			$ctmeta_datable_params['tax'] = 'results:NONE, labels:' . $term->term_id;
			if ( function_exists( 'datatable_generator' ) )
				datatable_generator( $ctmeta_datable_params );
		?>
		<?php do_action('cp_loop_after'); ?>
	</div><!-- /#main -->
	<?php do_action('cp_main_after'); ?>
</div><!-- /#content -->
<?php do_action('cp_content_after'); ?>
<?php get_footer(); ?>