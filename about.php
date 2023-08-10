<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/about.css">
    <link rel="icon" href="img/logo.jpg" type="image/gif" sizes="16x16">

    <title>Document</title>
</head>

<body>
    <div class="header">
        <?php require('./components/header.php')?>
    </div>
    <div class="container about-banner">
        <h1 class="about-title">About</h1>
        <p class="about-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in
            eros elementum tristique.
            Duis cursus, mi quis.
        </p>
        <div class="about_img">
            <img src="./img/banner1.avif" alt="">
        </div>
    </div>
    <div class="subheadline">
        <span></span>
        INTRODUCTIONS
        <span></span>
    </div>
    <div class="main introduction">
        <h1>We always want to give our customers a great experience</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ut voluptatem deserunt rerum hic facere
            consequatur, voluptatum, illo qui id vel vero necessitatibus, nam error alias itaque mollitia. Assumenda,
            nemo modi, nulla quod saepe ex itaque alias deleniti, et veniam quisquam voluptatibus dolor nam non. Ducimus
            enim fuga aliquam a nam?</p>
    </div>
    <div class="subheadline">
        <span></span>
        creator
        <span></span>
    </div>
    <div class=" main creators">
        <div class="creator">
            <div class="creator_img">
                <img src="https://assets.website-files.com/5be96251aaba7a84f6ecdf81/5be96251aaba7a8449ece020_Isabel.jpg"
                    alt="">
            </div>
            <div class="creator_infor">
                <h4 class="creator_infor__name">Ninh Do</h4>
                <p class="creator_infor__position">CEO</p>
            </div>
        </div>
        <div class="creator">
            <div class="creator_img">
                <img src="https://assets.website-files.com/5be96251aaba7a84f6ecdf81/5be96251aaba7a6004ece019_Maurice.jpg"
                    alt="">
            </div>
            <div class="creator_infor">
                <h4 class="creator_infor__name">Ninh Do</h4>
                <p class="creator_infor__position">CEO</p>
            </div>
        </div>
    </div>
    <div class="banner">

    </div>

    <div class="subheadline">
        <span></span>
        HISTORY TIMELINE
        <span></span>
    </div>

    <div class="main timeline-list">
        <div class="timeline">
            <p class="time">
                OCTOBER 2018
            </p>
            <div class="timeline_title">
                One day however a small line
            </div>
            <div class="timeline__content">
                It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the
                all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day
                however a small line of blind text by the name of Lorem Ipsum.
            </div>
            <div class="line">
                <div class="line-x">

                </div>
                <div class="line-y"></div>
            </div>
        </div>

        <div class="timeline">
            <p class="time">
                AUGUST 2018
            </p>
            <div class="timeline_title">
                One day however a small line
            </div>
            <div class="timeline__content">
                It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the
                all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day
                however a small line of blind text by the name of Lorem Ipsum.
            </div>
            <div class="line">
                <div class="line-x">

                </div>
                <div class="line-y"></div>
            </div>
        </div>

        <div class="timeline">
            <p class="time">
                JUNE 2018
            </p>
            <div class="timeline_title">
                One day however a small line
            </div>
            <div class="timeline__content">
                It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the
                all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day
                however a small line of blind text by the name of Lorem Ipsum.
            </div>
            <div class="line">
                <div class="line-x">

                </div>
                <div class="line-y"></div>
            </div>
        </div>

        <div class="timeline">
            <p class="time">
                AUGUST 2023
            </p>
            <div class="timeline_title">
                We've started CDN clothes.
            </div>

            <div class="line">
                <div class="line-x">

                </div>
                <div class="line-y"></div>
            </div>
        </div>


    </div>
    <div>
        <?php require('components/subcribe.php')?>
    </div>
    <div>
        <?php require('components/footer.php')?>

    </div>
</body>

</html>