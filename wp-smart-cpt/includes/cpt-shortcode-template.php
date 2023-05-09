<?php
$custom_post_types = get_option('custom_post_types', array());
foreach ($custom_post_types as $cpt_name => $cpt_data) {
    $shortCodeName = preg_replace('/\s+/', '_', $cpt_name);
    add_shortcode($shortCodeName . '-cpts', function ($atts) use ($cpt_name) {
        $atts = shortcode_atts(array(
            'posts_per_page' => 10,
            'paged' => 1
        ), $atts);

        $args = array(
            'post_type' => $cpt_name,
            'posts_per_page' => $atts['posts_per_page'],
            'paged' => $atts['paged'],
        );

        $query = new WP_Query($args);

        $output = '';

        if ($query->have_posts()) {
            $output .= '<ul class="cpt-posts">';
            while ($query->have_posts()) {
                $query->the_post();
                $output .= '<li>';
                $output .= '<a href="' . get_permalink() . '">';
                if (has_post_thumbnail()) {
                    $output .= get_the_post_thumbnail(null, 'thumbnail');
                }
                $output .= '<h3>' . get_the_title() . '</h3>';
                $output .= '<p>' . wp_trim_words(get_the_content(), 50) . '</p>';
                $output .= '</a>';
                $output .= '</li>';
            }
            $output .= '</ul>';

            $output .= '<div class="pagination">';
            $big = 999999999;
            $output .= paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $query->max_num_pages
            ));
            $output .= '</div>';
        } else {
            $output .= 'No posts found.';
        }

        wp_reset_postdata();

        return $output;
    });
}
