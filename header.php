<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>日本エコロジー株式会社 営業管理システム</title>
    <?php wp_head(); ?>

</head>

<body>
    <!-- 杉田追記 ーーーーーーーーーーーーーーーーーーーーーーーーーーーー-->
    <div class="main__wrapper">
        <div class="main" id="main">
            <header>
                <div class="sidebar__btn" id="sidebarToggle">
                    <button><img src="<?php echo get_template_directory_uri(); ?>/img/sidebar/arrows.png" alt=""></button>
                </div>
                <a class="header-title" href=""><img src="<?php echo get_template_directory_uri(); ?>/img/nihonecology_rogo.png" alt="ロゴ"></a>
                <div class="hamburger">
                    <span class="MenuBtn-BarFrame">
                        <span class="MenuBtn-BarFrame-FirstBar"></span>
                        <span class="MenuBtn-BarFrame-SecondBar"></span>
                        <span class="MenuBtn-BarFrame-ThirdBar"></span>
                    </span>
                </div>
                <nav class="hamburger__open">
                    <ul class="hamburger__open-list">
                        <a href="">
                            <div class="sidebar__item">
                                <p>ダッシュボード</p>
                            </div>
                        </a>
                        <div class="accordion">
                            <h2 class="accordion__ttl">結果報告<img src="<?php echo get_template_directory_uri(); ?>/img/sidebar/arrows.png"" alt=""></h2>
                            <div class=" accordion__cnt">
                                <a href="">
                                    <p>クローザー</p>
                                </a>
                                <a href="">
                                    <p>アプローチャー<br class="apu">飛び込み</p>
                                </a>
                                <a href="">
                                    <p>アプローチャー<br class="apu">メンテナンス</p>
                                </a>
                                <a href="">
                                    <p>アプローチャー<br class="apu">催事</p>
                                </a>
                                <a href="">
                                    <p>テレアポ</p>
                                </a>
                        </div>
                        <h2 class="accordion__ttl">訪問結果<img src="<?php echo get_template_directory_uri(); ?>/img/sidebar/arrows.png"" alt=""></h2>
                            <div class=" accordion__cnt">
                            <a href="">
                                <p>クローザー</p>
                            </a>
                            <a href="">
                                <p>アプローチャー<br class="apu">飛び込み</p>
                            </a>
                            <a href="">
                                <p>アプローチャー<br class="apu">メンテナンス</p>
                            </a>
                            <a href="">
                                <p>アプローチャー<br class="apu">催事</p>
                            </a>
                            <a href="">
                                <p>テレアポ</p>
                            </a>

        </div>
    </div>

    <a href="">
        <div class="sidebar__item">
            <p>営業成績</p>
        </div>
    </a>
    <a href="">
        <div class="sidebar__item">
            <p>条件検索</p>
        </div>
    </a>
    <a href="">
        <div class="sidebar__item">
            <p>設定</p>
        </div>
    </a>
    </ul>
    </nav>
    </header>