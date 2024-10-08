<?php 

if( $limit < $column){
	$limit = $column;
}
if(empty($category)){
	$categorys = '';
}else{
	$categorys = explode(',', $category);
}

if( class_exists("Opalservice_Query") ):
	$query = Opalservice_Query::get_service_by_term_slug( $categorys, $limit );
	$colclass = floor(12/$column);  
	$args_template = array(
		'show_category'		=> $show_category,
		'show_description'	=> $show_description,
		'show_thumbnail'	=> $show_thumbnail,
		'show_readmore'		=> $show_readmore,
		'max_char'			=> $max_char,
		'image_size'		=> $image_size,
		'other_size'		=> $other_size,
		'query'				=> $query,
		'layout'			=> $layout,
		'title'				=> $title,
		'description'		=> $description,
	);
	?>
	<div class="widget widget-service">
		<div class="opalservice-recent-service opalservice-rows service-<?php echo esc_attr( $layout ); ?>">
		<?php if( $query->have_posts() ): ?> 
				<div class="elementor-grid elementor-items-container">
					<?php $cnt=0; while ( $query->have_posts() ) : $query->the_post(); 
						$cls = '';
						if( $cnt++%$column==0 ){
							$cls .= ' first-child';
						}
						$args_template['number'] = $cnt;
						?>
						<div class="column-item <?php echo esc_attr($cls); ?>">
							<?php if ($layout == "grid_v3"):?>
								<?php echo Opalservice_Template_Loader::get_template_part( 'content-service-grid-icon',$args_template ); ?>	
							<?php elseif($layout == "list_v1"):?>
								<?php echo Opalservice_Template_Loader::get_template_part( 'content-service-list',$args_template ); ?>	
							<?php elseif($layout == "list_v2"):?>
								<?php echo Opalservice_Template_Loader::get_template_part( 'content-service-list-icon',$args_template ); ?>	
							<?php elseif($layout == "list_v3"):?>
								<?php echo Opalservice_Template_Loader::get_template_part( 'content-service-list-number',$args_template ); ?>	
							<?php else: ?>
								<?php echo Opalservice_Template_Loader::get_template_part( 'content-service-grid',$args_template ); ?>	
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; //have_posts?>
		</div>	
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>