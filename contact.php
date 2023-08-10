<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="img/logo.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="/css/contactPage.css">
    <title>CDN</title>
</head>

<body>
    <div class="header" style="margin-bottom: 80px">
        <?php require('components/header.php')?>
    </div>

    <div class="container contact-banner">
        <h1 class="contact-title">Let's Connect</h1>
        <p class="contact-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in
            eros elementum tristique.
            Duis cursus, mi quis.
        </p>
        <div class="subheadline">
            <span></span>
            OUR OFFICES
            <span></span>
        </div>

        <div class="office">
            <div class="office-img">
                <img src="img/office/office3.avif" alt="">
                <div class="office-area">
                    <h4>Ha Noi</h4>
                    <span>Opening time</span>
                    <ul class="office-time">
                        <li>Mon - Fri 08:00 to 22:00</li>
                        <li>Sat - 09:00 to 20:00</li>
                        <li>Sun - 12:00 to 18:00</li>
                    </ul>
                </div>
            </div>
            <div class="office-img">
                <img src="img/office/office4.avif" alt="">
                <div class="office-area">
                    <h4>Ho Chi Minh</h4>
                    <span>Opening time</span>
                    <ul class="office-time">
                        <li>Mon - Wed 09:00 to 21:00</li>
                        <li>Thu - Sat 09:00 to 22:00</li>
                        <li>Sun - 10:00 to 19:00</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End office -->


    </div>
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29789.178217380562!2d105.75062450000001!3d21.046794799999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31345457e292d5bf%3A0x20ac91c94d74439a!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2hp4buHcCBIw6AgTuG7mWk!5e0!3m2!1svi!2s!4v1690180722155!5m2!1svi!2s"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>


    <section>
        <div class="subheadline">
            <span></span>

            DIRECTORY

            <span></span>

        </div>
        <div class="directory">
            <ul>
                <li>PRESS</li>
                <li>MANAGEMENT</li>
                <li>SUPPORT</li>
            </ul>
            <ul>
                <li>Robb Kohler</li>
                <li>Robb Kohler</li>
                <li>Robb Kohler</li>
            </ul>
            <ul>
                <li>086-374-4962
                    <br>
                    robb.kohler@coffeestyle.com
                </li>
                <li>086-374-4962
                    <br>
                    robb.kohler@coffeestyle.com
                </li>
                <li>086-374-4962
                    <br>
                    robb.kohler@coffeestyle.com
                </li>
            </ul>
        </div>
    </section>
    <!-- ------------------END directory----------------- -->

    <div class="subcribe container">
        <?php require('components/subcribe.php')?>
    </div>

    <div class="footer">
        <?php require('components/footer.php')?>
    </div>
</body>

</html>