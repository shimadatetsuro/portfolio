<?php get_header(); ?>
<main id="home" class="main">
        <section class="main-hero">
            <div class="main-hero-container container">
                <div class="main-hero-highlight">
                    <h1>I'm <strong>Shimada Tetsuro</strong>,a <strong>engineer/developer</strong> based in Miyazaki, Japan</h1>
                    <div class="main-hero-highlight-links">
                        <p>このポートフォリオサイトのコードは<a href="" target="_blank">こちら</a>にまとまっています。<br>
                        お問い合わせは<a href="#contact">コンタクトフォーム</a>からどうぞ：）</p>
                        <ul class="social-links">
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-github"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-dribbble"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-medium"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <figure class="main-hero-img">
                    <img src="<?php echo get_theme_file_uri('images/image-profile.jpg');?>" alt="profile">
                </figure>
            </div>
        </section>

        <section id="works" class="main-works">
            <h2><i class="fas fa-palette"></i>portfolio</h2>
            <div class="container">
<?php 
    if(have_posts()):
        while(have_posts()):
            // 以下ループ
            the_post(); 
?>
                <div class="main-works-item">
                    <figure class="main-works-item-img primary">
                        <?php the_post_thumbnail(); ?>
                    </figure>
                    <div class="main-works-item-text">
                        <h3>
                            <?php echo get_the_title(); ?>
                        </h3>
                                <?php echo the_excerpt(); ?>
                            <a href="<?php echo get_the_permalink(); ?>" class="button">
                                もっと読む
                            </a>
                    </div>
                </div>
        <!-- ここまでループ -->
        <?php endwhile; ?>
    <?php endif; ?>
            </div>
        </section>
        <section id="about" class="main-about">
            <h2><i class="fas fa-icons"></i>About</h2>
            <figure class="main-about-img">
                <img class="mobile" src="<?php echo get_theme_file_uri('images/image-profile.jpg');?>" alt="profile">
                <img class="tablet-and-up" src="<?php echo get_theme_file_uri('images/image-about.jpg');?>" alt="about">
            </figure>
            <div class="main-about-container container">
                <div class="main-about-description">
                    <h3>自己紹介</h3>
                    <p>ペットの猫「モコ」を愛するアラサーの男性です。
                        接客業、公務員、測量業、製造業と様々な業種を経験した後に、自分を見つめなおし、パソコンが好きだったのもありＩＴ業界の扉を叩く。
                    </p>
                    <p>職業訓練校に入校し、いくつか資格取得をした後にPHPについて勉強中。
                        将来の夢は猫を多頭飼いすることです。
                    </p>
                </div>
                <div class="main-about-addition">
                    <h3></h3>
                    <div class="main-about-addition-skills">
                        <ul>
                            <li>Excel表計算処理技能認定試験2級</li>
                            <li>ITパスポート</li>
                            <li>ネットマーケティング検定</li>
                        </ul>
                        <ul>
                            <li>ウェブクリエイター能力認定試験HTML5対応版エキスパート</li>
                            <li>基本情報技術者</li>
                            
                        </ul>
                    </div>
                    <h3>関連リンク</h3>
                    <div class="main-about-addition-follow">
                        <ul class="social-links">
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-github"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-dribbble"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-medium"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>