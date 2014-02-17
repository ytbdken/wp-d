<?php get_header(); ?>

<div class="row main-content">
	<div class="large-9 large-centered columns">
		<?php if(is_archive()): ?>
		<h5 class="page-title">
			<?php if ( is_day() ) :
						printf( __( '" %s " の一覧', 'wp_d' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( '" %s " の一覧', 'wp_d' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'wp_d' ) ) );
					elseif ( is_year() ) :
						printf( __( '" %s " の一覧', 'wp_d' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wp_d' ) ) );
					elseif ( is_category() ) :
						printf( __( '" %s " の一覧', 'wp_d' ), single_cat_title( '', false ) );
					elseif( is_tag() ) :
						printf( __( '" %s " の一覧', 'wp_d' ), single_tag_title( '', false ) );
					else :
						_e( 'Archives', 'wp_d' );
					endif; ?>
		</h5>
		<hr>
		<?php endif; ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="large-2 columns mb">
				<?php
					$author_bio_avatar_size = apply_filters( 'wp-d_author_bio_avatar_size', 320 );
					echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
				?>
				<p><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author(); ?></a></p>
			</div>
			<div class="large-10 columns">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title"> <a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						</a> </h2>
					<p class="published">
						<?php the_time('Y.m.d'); ?>
					</p>
				</div>
				<?php the_content(); ?>
				<?php if (!is_page()){?>
				<ul class="no-bullet post-meta">
					<?php
							$cats = get_the_category(); 
							foreach( $cats as $cat) { 
								echo '<li><span class="secondary radius label">';
								echo $cat->cat_name . '</span></li>'; 
							}
							$posttags = get_the_tags(); 
							if ($posttags) { 
								foreach($posttags as $tag) { 
								echo '<li><span class="secondary radius label">';
								echo $tag->name . '</span></li>'; 
								} 
							} 
							?>
				</ul>
				<?php }?>
				<?php edit_post_link('編集','(',')'); ?>
				<?php wp_link_pages( ); ?>
				<?php if (is_single()){?>
				<div class="row">
					<div class="small-6 columns">
						<?php previous_post_link( '%link', '<span class="meta-nav button">' . _x( '&larr;前の記事', '', '' ) . '</span>' ); ?>
					</div>
					<div class="small-6 columns text-right">
						<?php next_post_link( '%link', '<span class="meta-nav button">' . _x( '次の記事&rarr;', '', '' ) . '</span>' ); ?>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
		<?php endwhile;?>
		<hr>
		<div class="row">
			<div class="large-12 columns">
				<?php wp_d_paging_nav(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
