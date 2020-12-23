<?php
/*
	Template Name: 文章归档
*/
get_header(); ?>
	<main id="main" class="archive-main width-half" role="main" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/Blog">
		<div class="heading">
			<div class="inner">
				<?php the_title( '<h1 class="title" itemprop="name">', '</h1>' ); ?>
				<span>所有文章共 <?php echo wp_count_posts()->publish; ?> 篇</span>
			</div>
		</div>
		<div id="primary" class="content archives">
		<?php
            $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' );
            $year=0; $mon=0; $output = ''; $i= 0;
            while ( $the_query->have_posts() ) : $the_query->the_post();
                $i++;
                $year_tmp = get_the_time('Y');
                $mon_tmp = get_the_time('n');
                if ($mon != $mon_tmp && $mon > 0) $output .= '</ul>';
                if ($year != $year_tmp && $year > 0) $output .= '</article>';
                if ($year != $year_tmp) { // 年份      
                    $year = $year_tmp;
                    $output .= '<h2 class="date-year">'. $year .'</h2><article class="item"><ul class="list">';
                }
                if ($mon != $mon_tmp) { // 月份 
                    $mon = $mon_tmp;
                    $output .= '<h4 class="date-mon"><a href="'. get_month_link( $year, $mon ) .'">'. $year .' - '. $mon .' </a></h4><ul class="list">';
                }
                $output .= '<li><i class="dot"></i><a href="'. get_permalink() .'">'. get_the_title() .'</a><span class="count-state">'. get_views(get_the_ID()) .'℃ / '. get_comments_number() .' 评</span></li>';
            endwhile;
            wp_reset_postdata();
            $output .= '</ul></article>';
            echo $output; ?>
		</div>
	</main>
<?php get_sidebar(); get_footer(); ?>