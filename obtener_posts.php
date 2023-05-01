function obtenerPosts($posts_args, $cantidad = 0, $excluir_posts_ids = array(), $id_lookup = '') {
      $principal1_args = array(
				'post_type' => 'post',
				'tag' => 'principal1',
				'order' => 'DESC',
				'orderby' => 'date',
				'posts_per_page' => 1,
			);

			$principal2_args = array(
				'post_type' => 'post',
				'tag' => 'principal2',
				'order' => 'DESC',
				'orderby' => 'date',
				'posts_per_page' => 1,
			);

			$principal3_args = array(
				'post_type' => 'post',
				'tag' => 'principal3',
				'order' => 'DESC',
				'orderby' => 'date',
				'posts_per_page' => 1,
			);

			$principal4_args = array(
				'post_type' => 'post',
				'tag' => 'principal4',
				'order' => 'DESC',
				'orderby' => 'date',
				'posts_per_page' => 1,
			);

			$principal5_args = array(
				'post_type' => 'post',
				'tag' => 'principal5',
				'order' => 'DESC',
				'orderby' => 'date',
				'posts_per_page' => 1,
			);

			$principal6_args = array(
				'post_type' => 'post',
				'tag' => 'principal6',
				'order' => 'DESC',
				'orderby' => 'date',
				'posts_per_page' => 1,
			);

			$principal7_args = array(
				'post_type' => 'post',
				'tag' => 'principal7',
				'order' => 'DESC',
				'orderby' => 'date',
				'posts_per_page' => 1,
			);

			$principal1 = new WP_Query($principal1_args);
			$principal2 = new WP_Query($principal2_args);
			$principal3 = new WP_Query($principal3_args);
			$principal4 = new WP_Query($principal4_args);
			$principal5 = new WP_Query($principal5_args);
			$principal6 = new WP_Query($principal6_args);
			$principal7 = new WP_Query($principal7_args);

			$principal_ids = array(
				$principal1->posts[0]->ID,
				$principal2->posts[0]->ID,
				$principal3->posts[0]->ID,
				$principal4->posts[0]->ID,
				$principal5->posts[0]->ID,
				$principal6->posts[0]->ID,
				$principal7->posts[0]->ID
			);
			// debug($principal_ids);

			// query final
			$posts_args = array(
				'post_type' => 'post',
				'post__not_in' => $excluir_posts_ids,
				'category__not_in' => array(get_category_by_slug('opinion')->term_id),
				'post__in' => $principal_ids,
				'posts_per_page' => ($cantidad > 0) ? $cantidad : 2,
				'orderby' => 'post__in',
			);
      $posts = new WP_Query($posts_args);

      $posts_obj = [];
      $posts_ids = [];
      $posts_tit = [];
      while ($posts->have_posts()) {
        $posts->the_post();
        $posts_obj[] = $posts->post;
        $posts_ids[] = $posts->post->ID;
        $posts_tit[] = $posts->post->post_title;
	}
    //debug($posts_tit);
    wp_reset_postdata();
    $return = [];
    $return['source'] = $posts;
    $return['obj'] = $posts_obj;
    $return['ids'] = $posts_ids;
    return $return;
  }
