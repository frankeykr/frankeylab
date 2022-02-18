<?php
get_header();

$postType = get_post_type($post);
if (have_posts()):
    while (have_posts()):the_post();
        if (has_post_thumbnail()) {
            $singlePageImageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0];
        } else {
            $singlePageImageUrl = get_stylesheet_directory_uri() . "/image/no-image.svg";
        }
        ?>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var visualOffset;
                $(window).on('load',function(){
                    visualOffset = $('#main-image').offset().top + $('#main-image').outerHeight();
                });
                $(window).scroll(function() {
                    if ( $(window).scrollTop() > visualOffset){
                        $('.hamburger-menu').addClass("active");
                    } else {
                        $('.hamburger-menu').removeClass("active");
                    }
                });
            });
        </script>

        <div id="primary" class="content-area single-page-content-area">
            <div class="line" id="scrollIndicator"></div>
            <main id="main" class="site-main single-page-main" role="main">
                <div id="main-image" class="single-page-main__image-container">
                    <img src="<?= $singlePageImageUrl; ?>" alt="<?php the_title(); ?>">
                    <div class="content-container">
                        <ul class="tags">
                            <?php
                            $postTags = get_the_terms($post->ID, $postType . '-tag');
                            if ($postTags) {
                                foreach ($postTags as $tag) {
                                    echo '<li class="tag"><p>#' . esc_html($tag->name) . '</p></li>';
                                }
                            } ?>
                        </ul>
                        <div class="title-and-date">
                            <h1 class="title"><?php the_title(); ?></h1>
                            <span class="date"><?php the_date('Y/n/j'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="content-wrap single-page-wrap">
                    <div class="single-page">
                        <div class="single-page__content">
                            <?php the_content(); ?>
                            <div class="share-btn">
                                <ul class="share-btn__list">
                                    <li class="share-btn__list__item">
                                        <a class="twitter icon-twitter" href="//twitter.com/intent/tweet?text=<?php echo urlencode(the_title("","",0)); ?>&<?php echo urlencode(get_permalink()); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" title="share on twitter">
                                            <img src="<?= get_stylesheet_directory_uri()?>/image/logo-twitter.png" alt="">
                                        </a>
                                    </li>
                                    <li class="share-btn__list__item">
                                        <a class="facebook icon-facebook" href="//www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&t=<?php echo urlencode(the_title("","",0)); ?>" target="_blank" title="share on facebook">
                                            <img src="<?= get_stylesheet_directory_uri()?>/image/logo-facebook.png" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                        $postCategory = $postType . '-category';
                        $term = wp_get_object_terms($post->ID, $postCategory); //지정되어 있는 택소노미의 텀을 취득
                        $termName = $term[0]->name; //텀 이름
                        $termSlug = $term[0]->slug; //텀 슬러그
                        ?>
                        <div class="single-page__related-post">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2546334153394027"
                                crossorigin="anonymous"></script>
                            <!-- 본문아래 -->
                            <ins class="adsbygoogle"
                                style="display:block"
                                data-ad-client="ca-pub-2546334153394027"
                                data-ad-slot="8299709575"
                                data-ad-format="auto"
                                data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                            <div class="title">
                                <!-- <span class="slug" style="text-transform: uppercase;"><?= $termSlug?></span> -->
                                <span>RELATED POSTS</span>
                            </div>
                            <ul class="related-post-list">
                                <?php 
                                global $post;
                                $args = array(
                                    'numberposts' => 3,
                                    'post_type' => $postType,
                                    'orderby' => 'rand', //랜덤표시
                                    'post__not_in' => array($post->ID), //현재 표시중인 포스트는 예외
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => $postCategory,
                                            'field' => 'slug',
                                            'terms' => $termSlug
                                        )
                                    )
                                );
                                
                                $myPosts = get_posts($args); 
                                if($myPosts) {
                                    foreach($myPosts as $post) : setup_postdata($post); 
                                    ?>
                                        <li class="related-post-list__item">
                                            <a href="<?php the_permalink(); ?>">
                                                <div class="related-post-img">
                                                    <?php  
                                                    if (has_post_thumbnail()) {
                                                        the_post_thumbnail('medium');
                                                    } else {
                                                        echo '<img src="' . get_stylesheet_directory_uri() . '/image/no-image.svg">';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="related-post-title">
                                                    <p><?php the_title(); ?></p>
                                                </div>
                                            </a>
                                        </li>
                                    <?php 
                                    endforeach;
                                } else {
                                    echo '<li><p>관련 게시물이 없습니다.</p></li>';
                                } ?>

                                <?php 
                                wp_reset_postdata(); 
                                ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </main><!-- .site-main -->
        </div><!-- .content-area -->

    <?php
    endwhile;
endif;
get_footer();

