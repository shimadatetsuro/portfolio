<?php get_header(); ?>
        <section id="works" class="main-works">
            <!-- <h2><i class="fas fa-palette"></i>Works</h2> -->
            <div class="container">
                <div class="main-works-item">
                    <?php if(have_posts()):
                        while(have_posts()):
                            the_post();
                        ?>
                    <figure class="main-works-item-img primary">
                        <!-- 記事のサムネイル -->
                        <?php the_post_thumbnail('small'); ?>
                    </figure>
                    <div class="main-works-item-text">
                        <h3>
                            <?php echo get_the_title(); ?>
                        </h3>
                        <!-- <p>
                            2023年2月12日
                        </p>
                        <p>
                            使用言語、コンセプト、制作期間、コメント
                        </p> -->
                        <p>
                            <?php echo get_the_content(); ?>
                        </p>
                        <?php endwhile; 
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>