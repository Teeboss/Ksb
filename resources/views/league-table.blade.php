@extends('layouts/pageHead')
<style>
    td,
    td p {
        /* height: 50px; */
        vertical-align: middle;
    }
</style>
<main class="marginTopSmallNavLong" style="background-color:  #F5F5F5;">
    @isset($bannerLong)
        <div class="mx-auto m-2 wid80 wid100Mobile d-block higt125px" style="overflow: hidden;">
            <a href="{{ $bannerLong->url }}" target="_blank"><img src="{{ 'files/' . $bannerLong->name }}" class="wid100"
                    alt=""></a>
        </div>
    @else
        <!-- <div class="mx-auto m-2 wid80 wid100Mobile d-block higt125px" style="overflow: hidden;">
                                                                                                                                                                                                                                                                                                                                                                                <a href="/contact" class="d-block wid100 fontSize34px blackKsb boldEight text-center">PLACE YOUR ADVERTISEMENT HERE</a>
                                                                                                                                                                                                                                                                                                                                                                            </div> -->
        <div class="mx-auto m-2 wid80 wid100Mobile d-block higt125px" style="overflow: hidden;">
            <a href="#"><img src="{{ asset('icons/longBanner.gif') }}" class="wid100" alt=""></a>
        </div>
    @endisset
    <div class="wid80 wid100Mobile p-lg-3 bgWhite mx-auto rounded">
        <div class="d-flex flex-wrap justify-content-center">
            <div class="p-2 mx-auto order-2 order-md-0 bgSocials wid30 wid100Mobile">
                <p class="fontSize12px my-3 boldFive">Top Football League Games</p>
                <div class="d-block wid100 mx-auto mb-3">
                    <a href="/" onclick="event.preventDefault(); loadGames(39);"
                        class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/england.png') }}" alt=""> England Premier</a>
                    <a href="/" onclick="event.preventDefault(); loadGames(78);"
                        class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/garmany.png') }}" alt=""> Garmany Bundesliga</a>
                    <a href="/" onclick="event.preventDefault(); loadGames(2);"
                        class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/europa.png') }}" alt=""> UEFA Champions League</a>
                    <a href="/" onclick="event.preventDefault(); loadGames(3);"
                        class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/europa.png') }}" alt=""> UEFA Europa League</a>
                    <a href="/" onclick="event.preventDefault(); loadGames(45);"
                        class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/england.png') }}" alt=""> England FA Cup</a>
                    <a href="/" onclick="event.preventDefault(); loadGames(61);"
                        class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/france.png') }}" alt=""> France League 1</a>
                    <a href="/" onclick="event.preventDefault(); loadGames(140);"
                        class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/spain.png') }}" alt=""> Spain LaLiga</a>
                    <a href="/" onclick="event.preventDefault(); loadGames(135);"
                        class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/italy.png') }}" alt=""> Italy Seria A</a>
                    <a href="/" onclick="event.preventDefault(); loadGames(10);"
                        class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img
                            src="https://media-1.api-sports.io/football/leagues/10.png" alt="" class="wid16px">
                        International Friendlies </a>
                    <a href="/" onclick="event.preventDefault(); loadGames(36);"
                        class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/africa.png') }}" alt=""> African Nations Cup
                        Qualifiers</a>
                    <!-- <a href="/" onclick="event.preventDefault();Games(78);" class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/africa.png') }}" alt=""> African Nations Cup</a> -->
                    <!-- <button class="wid100 fontSize12px blackKsb bgNone borderNone p-2">See more</button> -->
                </div>
                <p class="fontSize12px my-3 boldFive">A - Z</p>
                <div class="d-block wid100 mx-auto mb-1" id="countries">
                    <a href="DZ"
                        class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/algeria.png') }}" alt=""> Algeria</a>
                    <a href="AO"
                        class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/angola.png') }}" alt=""> Angola</a>
                    <a href="AR"
                        class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/angentina.png') }}" alt=""> Angentina</a>
                    <a href="AU"
                        class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/australia.png') }}" alt=""> Australia</a>
                    <a href="BE"
                        class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/belgium.png') }}" alt=""> Belgium</a>
                    <a href="BR"
                        class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/brazil.png') }}" alt=""> Brazil</a>
                    <a href="BG"
                        class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/bulgeria.png') }}" alt=""> Bulgeria</a>
                    <a href="CL"
                        class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/chile.png') }}" alt=""> Chile</a>
                    <a href="CR"
                        class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/costa.png') }}" alt=""> Costa Rica</a>
                    <a href="HR"
                        class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/croatia.png') }}" alt=""> Croatia</a>
                    <a href="CY"
                        class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img
                            src="{{ asset('icons/football/cyprus.png') }}" alt=""> Cyprus</a>
                </div>
                <button class="wid100 fontSize12px blackKsb bgNone borderNone p-2" id="seeMore">Show more</button>
                <div class="wid100 wid100Mobile mt-4 shortBannerHeight">
                    <a href="{{ $bannerShort->url }}"><img src="{{ 'files/' . $bannerShort->name }}"
                            class="wid100 wid100Mobile" alt=""></a>
                </div>
            </div>
            <div class="p-2 order-1 order-md-1 bgWhite mx-auto wid70 wid100Mobile" id="bodyVal">
                <div class="d-block wid80 wid100Mobile mx-auto">
                    {{-- <p class="fontSize16px my-3 boldFive">English premier League</p> --}}
                    <iframe frameborder="0" scrolling="yes" class="wid100"
                        style="margin-bottom: 0px; padding-bottom: 0px" height="700"
                        src="https://www.fctables.com/england/premier-league/iframe/?type=table&lang_id=2&country=67&template=10&team=&timezone=Pacific/Midway&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=0&ga=0&gd=0&pts=1&ng=1&form=1&width=520&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=1&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=3bafda&hfc=FFFFFF"></iframe>
                    <p class="fontSize16px my-3 boldFive" style="margin-top: -32px;">Spanish LaLiga</p>
                    <iframe frameborder="0" scrolling="yes" style="margin-top: -122px;" class="wid100"
                        height="700"
                        src="https://www.fctables.com/spain/liga-bbva/iframe/?type=table&lang_id=2&country=201&template=43&timezone=Pacific/Midway&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=0&ga=0&gd=0&pts=1&ng=1&form=1&width=520&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=1&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=3bafda&hfc=FFFFFF"></iframe>
                    <p class="fontSize16px my-3 boldFive" style="margin-top: -32px;">Spanish LaLiga</p>
                    <iframe frameborder="0" scrolling="yes" style="margin-top: -122px;" class="wid100"
                        height="700"
                        src="https://www.fctables.com/germany/1-bundesliga/iframe/?type=table&lang_id=2&country=83&template=16&timezone=Pacific/Midway&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=0&ga=0&gd=0&pts=1&ng=1&form=1&width=520&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=1&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=3bafda&hfc=FFFFFF"></iframe>
                    <iframe frameborder="0" scrolling="yes" style="margin-top: -132px;" class="wid100"
                        height="700"
                        src="https://www.fctables.com/france/ligue-1/iframe/?type=table&lang_id=2&country=77&template=15&timezone=Pacific/Midway&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=0&ga=0&gd=0&pts=1&ng=1&form=1&width=520&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=1&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=3bafda&hfc=FFFFFF"></iframe>
                </div>
                <div class="wid100 bgBlue mt-4 longBannerHeight">
                    <a href="https://clcr.me/xsOTPT"><img src="{{ asset('icons/football/longBanner.gif') }}"
                            class="" alt=""></a>
                </div>
                <div class="mt-2">
                    <img src="{{ asset('icons/kgsb.png') }}" alt="" class="my-5 wid45px">
                    <p class="fontSize14px linehigt17px boldFour">
                        Welcome to KGS BET - a membership-based sports prediction website where you can access accurate
                        and detailed predictions for your favorite sports events. We focus on Football, Basketball, and
                        Tennis, providing registered users with in-depth predictions and analysis to help them make
                        informed betting decisions. <br><br>
                        Our website is designed to be user-friendly and easy to navigate, with a landing page that
                        allows both registered and unregistered users to access a limited number of predictions.
                        However, to access more detailed predictions, you'll need to register as a member.<br><br>
                        At KGS BET, we believe in providing our users with the most up-to-date and accurate predictions,
                        which is why we have a dedicated team of experts who continuously analyze and research different
                        sports events to bring you the most reliable predictions.<br><br>
                        In addition to predictions, our website also features banner placements and ads from leading
                        sport betting brands, making it easy for you to place bets on your preferred sports events.
                        Additionally, we have a Telegram channel where you can stay updated on the latest predictions
                        and tips.<br><br>
                        If you're looking for a reliable and user-friendly website to help you make informed betting
                        decisions, look no further than KGS BET. Join today and start reaping the benefits of our expert
                        predictions!<br><br>
                    </p>
                    <a href="https://t.me/+BWWg98ga2RZmMjVk"
                        class="telegramBlue noneTextDecoration centerText d-block my-5 white fontSize16px p-2 boldSix wid100"><img
                            src="{{ asset('icons/telegramVector.png') }}" alt=""> Click here to join telegram
                        group</a>
                </div>
            </div>
        </div>
    </div>
</main>
@extends('layouts/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"
    integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
    integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
</script>
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
    $(document).ready(() => {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })

        $("#seeMore").click(() => {
            $(this).text("Loading...")
            // $("#seeMore").text(function(i, text) {
            //     return text === "Show more" ? "Show less" : "Show more";
            // });
            $.ajax({
                url: '/loadCountries',
                type: 'GET',
                success: (data) => {
                    $("#countries").html(data)
                }
            })
        })


        Array.from(document.getElementsByClassName("country")).forEach(
            function(element, index, array) {
                element.addEventListener("click", (e) => {
                    e.preventDefault()
                    //alert(element.getAttribute("href"));
                    //  $("#bodyVal").html(element.getAttribute("href"))
                    // document.getElementById("bodyVal").innerHTML = element.getAttribute("href");
                    $.ajax({
                        url: 'loadLeagues/' + element.getAttribute("href"),
                        type: "GET",
                        success: (data) => {
                            $("#bodyVal").html(data)
                        }
                    })
                })
            }
        );

        // if (localStorage.getItem('loadGamesLocal') !== null) {
        //     $('#tennisGames').html($('#tennisGames').data('old-state'));
        // } else {
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: '/loadTennisGames',
        //         type: 'GET',
        //         success: (data) => {
        //             $("#tennisGames").html(data)
        //         }

        //     })
        //     $('#tennisGames').data('old-state', $('#tennisGames').html());
        //     localStorage.setItem('loadGamesLocal', $('#tennisGames').data('old-state'));
        // }
        // setTimeout(function() {
        //     localStorage.removeItem('loadGamesLocal');
        // }, 120000);
    })

    function loadGames(leagueId) {
        $("#bodyVal").html(
            ' <div class="d-block wid60 mx-auto"><img src = "{{ asset('icons/loaders/Soccerball.gif') }}" alt = "" class ="wid10 d-block mx-auto" ><p class="centerText blackSol fontSize12px">Loading games please wait...</p></div>'
        );
        $.ajax({
            url: '/loadLeagueGames/' + leagueId,
            type: 'GET',
            success: (data) => {
                $("#bodyVal").html(data)
            }
        })
    }
</script>
