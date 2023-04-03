<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Profile</title>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1BV6QDD1XJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1BV6QDD1XJ');
</script>

    <!-- Google Search Console -->
    <meta name="google-site-verification" content="__sY3BsLSnbHyqT6kn1gFFFOQD19yMDFSiykMOoMKfQ" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/7ba2902154.js" crossorigin="anonymous"></script>
    <!-- Normalize.css -->
    <link rel="stylesheet" href="<?php echo get_theme_file_uri('stylesheets/normalize.css');?>">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=
Piazzolla:opsz,wght@8..30,400;8..30,700&display=swap" rel="stylesheet">
    <!-- My Styles -->
    <link rel="stylesheet" href="<?php echo get_theme_file_uri('stylesheets/style.css');?>">
    <link rel="stylesheet" href="<?php echo get_theme_file_uri('stylesheets/style-mobile.css');?>">
    <link rel="stylesheet" href="<?php echo get_theme_file_uri('stylesheets/style-tablet.css');?>">
    <link rel="stylesheet" href="<?php echo get_theme_file_uri('stylesheets/style-laptop.css');?>">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo get_theme_file_uri('images/HatchfulExport-All/favicon.png');?>">
    <?php wp_head(); ?>
</head>
<body>
    <header class="header">
        <div class="header-logo">
            <img class="header-logo-img" src="<?php echo get_theme_file_uri('images/HatchfulExport-All/logo_transparent.png');?>" alt="logo">
            <span class="header-logo-title">Engineer/Developer</span>
        </div>
        <nav class="header-nav">
            <ul class="header-nav-menu">
                <li class="header-nav-menu-item"><a href="<?php echo esc_url(home_url()) ?>">Home</a></li>
                <li class="header-nav-menu-item"><a href="#works">portfolio</a></li>
                <li class="header-nav-menu-item"><a href="#about">About</a></li>
                <li class="header-nav-menu-item"><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>
