<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Free Football Predictions, Tips and Stats| Free Tennis Prediction, Tips and Stats| Free Basketball Prediction
        Tips and Stats| KingSolomonBet</title>
    <meta property="og:image" content="{{ asset('icons/kgsb.jpg') }}" />
    <meta name="keywords"
        content="Football predictions, basketball prediction, tennis prediction, sports Betting Tips, KGSB, football, stats, scores, statistics, match previews, livescore, live scores, live predictions" />
    <meta name="description"
        content="Free football, basketball, and tennis predictions and statistics for more than 700 leagues. Match previews, stat trends, and live scores." />
    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('css/teeStyles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/api-football.css') }}">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type='image/x-icon'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
        integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//code.iconify.design/1/1.0.6/iconify.min.js"></script>


    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '749193083249992');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=749193083249992&ev=PageView&noscript=1" /></noscript>
</head>
<style>
    input[type="email"]::placeholder {
        font-size: 14px;
    }

    input[type="password"]::placeholder {
        font-size: 14px;
    }

    input[type="text"]::placeholder {
        font-size: 14px;
    }

    input[type="button"] {
        width: 100%;
        border: none;
    }
</style>

<body>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8FKKQNJ4Z8"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-8FKKQNJ4Z8');
    </script>
    <script>
        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Submit Event
            --------------------------------------------
            --------------------------------------------*/
            $(document).on("submit", "#handleAjax", function() {
                var e = this;

                $(this).find("[type='submit']").html("Register...");

                $.ajax({
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $(e).find("[type='submit']").html("Register");

                        if (data.status) {
                            //window.location = data.redirect;
                            location.reload();
                        } else {

                            $(".alert").remove();
                            $.each(data.errors, function(key, val) {
                                $("#errors-list").append(
                                    "<div class='alert alert-danger'>" + val +
                                    "</div>");
                            });
                        }

                    }
                });

                return false;
            });

        });
        $(document).on("submit", "#handleAjaxLogin", function() {
            var e = this;

            $(this).find("[type='submit']").html("Login...");

            $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $(e).find("[type='submit']").html("Login");

                    if (data.status) {
                        window.location = data.redirect;
                    } else {
                        $(".alert").remove();
                        $.each(data.errors, function(key, val) {
                            $("#errors-list-login").append("<div class='alert alert-danger'>" +
                                val + "</div>");
                        });
                    }

                }
            });

            return false;
        });
    </script>
