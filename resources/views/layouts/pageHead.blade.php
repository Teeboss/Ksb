<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Free Football Predictions, Tips and Stats| Free Tennis Prediction, Tips and Stats| Free Basketball Prediction Tips and Stats| KingSolomonBet</title>
    <meta property="og:image" content="{{ asset('icons/kgsb.jpg') }}" />
    <meta name="keywords" content="Football predictions, basketball prediction, tennis prediction, sports Betting Tips, KGSB, football, stats, scores, statistics, match previews, livescore, live scores, live predictions" />
    <meta name="description" content="Free football, basketball, and tennis predictions and statistics for more than 700 leagues. Match previews, stat trends, and live scores." />
    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('css/teeStyles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/api-football.css') }}">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type='image/x-icon'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=749193083249992&ev=PageView&noscript=1" /></noscript>
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
    <nav class="fixed-top bgBlackKsb deskTop p-2">
        <div class="wid80 d-block mx-auto">
            <div class=" d-flex justify-content-between align-items-center">
                <a href="/"><img src="{{ asset('icons/iconNavs.png') }}" class="wid120px" alt=""></a>
                <div class="d-flex justify-content-between wid65 align-items-center ">
                    <a href="https://t.me/+v8J2LHM5RJEzZjhk" class="fontSize14px navA" target="_blank" rel="noopener noreferrer">Join us telegram <img src="{{ asset('icons/TelegramLogo.png') }}" alt="" class="ms-1"></a>
                    <a href="#" target="_blank" class="fontSize14px navA" rel="noopener noreferrer">English(US)</a>
                    <div>
                        @guest
                        <a href="" class="fontSize14px navA me-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                        <button class="fontSize14px navAButton py-2 px-3" data-bs-toggle="modal" data-bs-target="#registrationModal">
                            Register
                        </button>
                        @else
                        <a href="" class="fontSize14px navA ms-4" data-bs-toggle="modal" data-bs-target="#myAccountModal">{{Auth::user()->email}} </a>
                        <a class="fontSize14px navAButton ms-1 py-2 px-3" href="{{ route('logout') }}">
                            Logout
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
            <div class="d-flex wid60 mt-4 justify-content-between">
                @guest
                <a href="/" class="boldFive fontSize16px navA {{ (request()->is('/')) ? 'navActive' : '' }}" id="homeId">Home</a>
                <a href="" class="boldFive fontSize16px navA {{ (request()->is(['football', 'fixture/*'])) ? 'navActive' : '' }}" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <!-- <img src="{{ asset('icons/SoccerBall.png') }}" class="me-1" alt=""> -->
                    Football</a>
                <a href="/basketball" class="boldFive fontSize16px navA {{ (request()->is(['basketball', 'basketballfixture'])) ? 'navActive' : '' }}" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Basketball</a>
                <a href="/tennis" class="boldFive fontSize16px navA {{ (request()->is(['tennis', 'tennisfixture'])) ? 'navActive' : '' }}" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Tennis</a>
                <a href="/livescores" class="boldFive fontSize16px navA {{ (request()->is(['livescores', 'livescores'])) ? 'navActive' : '' }}" data-bs-toggle="modal" data-bs-target="#loginModal">
                    LiveScores</a>
                <a href="/subscription" class="boldFive fontSize16px navA {{ (request()->is(['subscription', 'subscription'])) ? 'navActive' : '' }}" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Telegram VIP</a>
                @else
                <a href="/" class="boldFive fontSize16px navA {{ (request()->is('/')) ? 'navActive' : '' }}" id="homeId">Home</a>
                <a href="/football" class="boldFive fontSize16px navA {{ (request()->is(['football', 'fixture/*'])) ? 'navActive' : '' }}">
                    <!-- <img src="{{ asset('icons/SoccerBall.png') }}" class="me-1" alt=""> -->
                    Football</a>
                <a href="/basketball" class="boldFive fontSize16px navA {{ (request()->is(['basketball', 'basketfix/*'])) ? 'navActive' : '' }}">
                    <!-- <img src="{{ asset('icons/Basketball.png') }}" class="me-1" alt=""> -->
                    Basketball</a>
                <a href="/tennis" class="boldFive fontSize16px navA {{ (request()->is(['tennis', 'tennisfixture'])) ? 'navActive' : '' }}"> <!-- <img src="{{ asset('icons/TennisBall.png') }}" class="me-1" alt=""> -->
                    Tennis</a>
                <a href="/livescores" class="boldFive fontSize16px navA {{ (request()->is(['livescores', 'livescores'])) ? 'navActive' : '' }}">
                    LiveScores</a>
                <a href="/subscription" class="boldFive fontSize16px navA {{ (request()->is(['subscription', 'subscription'])) ? 'navActive' : '' }}">
                    Telegram VIP</a>
                @endguest
            </div>
        </div>
    </nav>
    <nav class="fixed-top bgBlackKsb mobile p-2">
        <div class="wid100Mobile d-block mx-auto">
            <div class="d-flex my-3 justify-content-between align-items-center">
                <img src="{{ asset('icons/iconNavs.png') }}" class="wid120px" alt="">
                <div class="d-flex align-items-center">
                    @guest
                    <a href="" class="fontSize12px white me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    <span class="white">|</span>
                    <a href="" class="fontSize12px navAMobile ms-2" data-bs-toggle="modal" data-bs-target="#registrationModal">Register</a>
                    @else
                    <a href="" class="fontSize12px white me-2">{{Auth::user()->email}} </a>
                    <span class="white">|</span>
                    <a href="{{ route('logout') }}" class="fontSize12px navAMobile ms-2">Logout</a>
                    @endguest
                </div>
            </div>
            <div class=" d-flex justify-content-between">
                @guest
                <a href="/" class="boldFive fontSize12px navA {{ (request()->is('/')) ? 'navActive' : '' }}" id="homeId">Home</a>
                <a href="" class="boldFive fontSize12px navA {{ (request()->is(['football' , 'fixture/*'])) ? 'navActive' : '' }}" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Football</a>
                <a href="" class="boldFive fontSize12px navA {{ (request()->is(['basketball', 'basketballfixture'])) ? 'navActive' : '' }}" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <!-- <img src="{{ asset('icons/Basketball.png') }}" class="me-1" alt=""> -->
                    Basketball</a>
                <a href="" class="boldFive fontSize12px navA {{ (request()->is('tennis')) ? 'navActive' : ''}}" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Tennis</a>
                <a href="" class="boldFive fontSize12px navA {{ (request()->is('livescores')) ? 'navActive' : ''}}" data-bs-toggle="modal" data-bs-target="#loginModal">
                    LiveScores</a>
                <a href="" class="boldFive fontSize12px navA {{ (request()->is('subscription')) ? 'navActive' : ''}}" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Telegram VIP</a>
                @else
                <a href="/" class="boldFive fontSize12px navA {{ (request()->is('/')) ? 'navActive' : '' }}" id="homeId">Home</a>
                <a href="/football" class="boldFive fontSize12px navA {{ (request()->is(['football' , 'fixture/*'])) ? 'navActive' : '' }}">
                    <!-- <img src="{{ asset('icons/SoccerBall.png') }}" class="me-1" alt=""> -->
                    Football</a>
                <a href="/basketball" class="boldFive fontSize12px navA {{ (request()->is(['basketball', 'basketfix/*'])) ? 'navActive' : '' }}">
                    <!-- <img src="{{ asset('icons/Basketball.png') }}" class="me-1" alt=""> -->
                    Basketball</a>
                <a href="/tennis" class="boldFive fontSize12px navA {{ (request()->is('tennis')) ? 'navActive' : ''}}">
                    <!-- <img src="{{ asset('icons/TennisBall.png') }}" class="me-1" alt=""> -->
                    Tennis</a>
                <a href="/livescores" class="boldFive fontSize12px navA {{ (request()->is('livescores')) ? 'navActive' : ''}}">
                    <!-- <img src="{{ asset('icons/TennisBall.png') }}" class="me-1" alt=""> -->
                    LiveScores</a>
                <a href="/subscription" class="boldFive fontSize12px navA {{ (request()->is('subscription')) ? 'navActive' : ''}}">
                    <!-- <img src="{{ asset('icons/TennisBall.png') }}" class="me-1" alt=""> -->
                    Telegram VIP</a>
                @endguest
            </div>

        </div>
    </nav>
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="wid80 my-3 mx-auto">
                        <p class="text-center fontSize20px boldFive">Login</p>
                        <form action="{{ route('login.post')}}" method="POST" id="handleAjaxLogin">
                            @csrf
                            <div id="errors-list-login"></div>
                            <div class="my-4">
                                <input type="email" name="email" placeholder="Email" class="form-control fontSize14px" id="">
                                @if($errors->has('email'))
                                <span class="alert-danger">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                            <div class="my-4">
                                <input type="password" name="password" placeholder="Password" class="form-control fontSize14px" id="">
                                @if($errors->has('password'))
                                <span class="alert-danger">{{$error->first('password')}}</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mb-2 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label shaddyWhite fontSize12px" for="exampleCheck1">Remember Me</label>
                                </div>
                                <a href="/forgotpassword" class="redKsb noneTextDecoration fontSize12px">forget your password?</a>
                            </div>
                            <div class="my-4">
                                <button type="submit" class="rounded-pill p-2 wid100 borderNone white boldSix fontSize18px bgBlueKsbTwo">Proceed</button>
                            </div>

                        </form>
                        <p class="text-center fontSize16px ">Don't have an account? <a data-bs-toggle="modal" data-bs-target="#registrationModal" class="noneTextDecoration boldSix blackKsb pointers">Sign Up</a></p>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Registration Modal -->
    <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="wid80 my-3 mx-auto">
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                        @endif
                        <p class="text-center boldSix fontSize24px">Register Now</p>
                        @section('content')
                        <form action="{{ route('registration.post') }}" method="POST" id="handleAjax">
                            @csrf
                            <div id="errors-list"></div>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="firstname" class="form-control" placeholder="First name" aria-label="First name">
                                    @if ($errors->has('firstname'))
                                    <span class="text-danger">{{ $errors->first('firstname') }}</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <input type="text" name="lastname" class="form-control" placeholder="Last name" aria-label="Last name">
                                    @if ($errors->has('lastname'))
                                    <span class="text-danger">{{ $errors->first('lastname') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="my-4">
                                <input type="email" name="email" placeholder="Email" class="form-control fontSize14px" id="">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="my-4">
                                <input type="tel" name="phone" placeholder="Phone Number" class="form-control fontSize14px" id="">
                                @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="my-4">
                                <input type="password" name="password" placeholder="Password" class="form-control fontSize14px" id="">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mb-2 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label shaddyWhite fontSize12px" for="exampleCheck1">I Accept KsbBet <a href="" class="blackKsb fontSize12px">Terms and Conditions</a></label>
                                </div>
                                <!-- <a href="" class="redKsb noneTextDecoration fontSize12px">forget your password?</a> -->
                            </div>
                            <div class="my-4">
                                <button type="submit" class=" rounded-pill borderNone p-2 wid100 white boldSix fontSize18px bgBlueKsbTwo">Proceed</button>
                            </div>

                        </form>
                        <p class="text-center fontSize16px">I have an account? <a class="noneTextDecoration boldSix blackKsb pointers" data-bs-toggle="modal" data-bs-target="#loginModal">Sign in</a></p>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
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
                                $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
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
                            $("#errors-list-login").append("<div class='alert alert-danger'>" + val + "</div>");
                        });
                    }

                }
            });

            return false;
        });
    </script>