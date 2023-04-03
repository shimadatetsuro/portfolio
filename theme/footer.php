<?php 
wp_footer(); 
require_once 'controller/footer.php';
?>
<footer id="contact" class="footer">
        <div class="footer-container container">
            <div class="footer-form">
                <p>お仕事のご依頼やご相談、お問い合わせはこちらからどうぞ。</p>
                <form action="<?= esc_url(home_url('contact'));?>" method="post" name="contact-form">
                    <div class="footer-form-input">
                        <i class="far fa-user"></i>
                        <input type="text" name="user_name" placeholder="氏名">
                    </div>
                    <div class="footer-form-input">
                        <i class="far fa-envelope"></i>
                        <input type="text" name="email" placeholder="メールアドレス">
                    </div>
                    <div class="footer-form-textarea">
                        <textarea name="content" placeholder="お問い合わせ内容"></textarea>
                    </div>
                    <input type="submit" value="送信する" class="button-secondary">
                </form>
            </div>
            <div class="footer-info">
                <div class="footer-info-nav">
                    <img class="footer-info-nav-img" src="<?php echo get_theme_file_uri('images/HatchfulExport-All/logo_transparent.png');?>" alt="logo">
                    <nav class="footer-info-nav-menu">
                        <ul>
                            <li><a href="#home">Home</a></li>
                            <li><a href="#works">portfolio</a></li>
                            <li><a href="#about">About</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="footer-info-follow">
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
                <p class="footer-info-copy">
                    <small>© 2022 Shimada Tetsuro. All Rights Reserved.</small>
                </p>
            </div>
        </div>
    </footer>
</body>
</html>