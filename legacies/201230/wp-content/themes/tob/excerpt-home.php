<?php
_the_ads('ad_home_header', 'list-header');

_the_leadpager(); 

echo '<div class="excerpts-wrapper">';
    echo '<div class="excerpts">';

        // Sticky loop
        $pagenums    = get_option( 'posts_per_page', 10 );
        $offset_nums = 0;
        $sticky_nums = 0;
        $sticky_ids  = get_option('sticky_posts');

        if( $sticky_ids ){

            rsort( $sticky_ids );

            $sticky_nums = count($sticky_ids);

            if( $sticky_nums > $pagenums-1 ){
                $sticky_nums = $pagenums-1;
                $sticky_ids = array_slice($sticky_ids, 0, $sticky_nums, true);
            }

            if( $paged <= 1 ){
                $args = array(
                    'post__in'            => $sticky_ids,
                    'posts_per_page'      => $sticky_nums,
                    'ignore_sticky_posts' => 1
                );
                query_posts($args);
                while ( have_posts() ) : the_post();
                    get_template_part( 'excerpt', 'item' );
                endwhile; 
                wp_reset_query();

                $pagenums = $pagenums-$sticky_nums;
            }else{
                $offset_nums = $sticky_nums;
            }

        }


        // Normal loop
        $args = array(
            'posts_per_page'      => $pagenums,
            'paged'               => $paged,
            'ignore_sticky_posts' => 1
        );

        if( $offset_nums ){
            $args['offset'] = $pagenums*($paged-1) - $offset_nums;
        }

        if( $sticky_ids ){
            $args['post__not_in'] = $sticky_ids;
        }

        if( _hui('notinhome') ){
            $pool = array();
            foreach (_hui('notinhome') as $key => $value) {
                if( $value ) $pool[] = $key;
            }
            if( $pool ) $args['cat'] = '-'.implode($pool, ',-');
        }

        query_posts($args);
        while ( have_posts() ) : the_post();
            get_template_part( 'excerpt', 'item' );
        endwhile; 

        wp_reset_query();


    echo '</div>';
echo '</div>';

_paging();

_the_ads('ad_home_footer', 'list-footer');
