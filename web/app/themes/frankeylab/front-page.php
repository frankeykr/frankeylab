<?php
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="content-wrap front-page">
                <article class="content">
                    <?php the_content(); ?>
                </article>
                <aside class="sidebar front-page__sidebar">
                    <div class="profile">
                        <div class="profile__image-container">
                            <img class="profile__image-container__image" 
                            src="<?= get_stylesheet_directory_uri()?>/image/profile.png" alt="profile-img">
                        </div>
                        <div class="profile__name-container">
                            <span class="profile__name-container__name">TEST</span>
                        </div>
                        <div class="profile__content-container">
                            <p class="profile__content-container__content">
                                블로그·어필리에이트·프로그래밍을 사랑합니다. 
                                신규 졸업자로 세부 섬에 취직 → 11개월 만에 퇴직 → 프리랜서 → 창업 → 창업 실패 → 블로그를 쓰다 → 
                                블로그 수익 7자릿수 달성. 평소에는 방콕을 중심으로 남국에 틀어박히면서 생활비는 5만 엔 정도로 살고 있습니다.
                            </p>
                        </div>
                        <div class="profile__link-container">
                            <a href="<?= home_url()?>/#"><span>상세프로필</span></a>
                            <a href="<?= home_url()?>/#"><span>문의하기</span></a>
                        </div>
                    </div>
                </aside>
            </div>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php
get_footer();
