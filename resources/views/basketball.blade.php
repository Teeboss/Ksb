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
        <a href="{{ $bannerLong->url }}"><img src="{{ 'files/'.$bannerLong->name }}" class="wid100" alt=""></a>
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
                <p class="fontSize12px my-3 boldFive">Top Leagues</p>
                <div class="d-block wid100 mx-auto mb-3">
                    <a href="/" onclick="event.preventDefault(); loadGamesBasket(12);" class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/usa.png') }}" alt=""> USA NBA</a>
                    <a href="/" onclick="event.preventDefault(); loadGamesBasket(117);" class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/spain.png') }}" alt=""> Spain Liga ACB</a>
                    <a href="/" onclick="event.preventDefault(); loadGamesBasket(13);" class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/usa.png') }}" alt=""> USA WNBA</a>
                    <a href="/" onclick="event.preventDefault(); loadGamesBasket(242);" class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/italy.png') }}" alt=""> Italy Seria A</a>
                    <a href="/" onclick="event.preventDefault(); loadGamesBasket(104);" class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/turkey.png') }}" alt=""> Turkiye Super Ligi</a>
                    <a href="/" onclick="event.preventDefault(); loadGamesBasket(40);" class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/garmany.png') }}" alt=""> Garmany BBL</a>
                    <a href="/" onclick="event.preventDefault(); loadGamesBasket(45);" class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/greece.png') }}" alt=""> Greece BasketLeague</a>
                    <!-- <a href="/" onclick="event.preventDefault(); loadGamesBasket(39);" class="wid100 bodyA d-block boldFive p-2 marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/internationalChamp.png') }}" alt=""> International EuroLeague</a> -->
                    <!-- <button class="wid100 fontSize12px blackKsb bgNone borderNone p-2">See more</button> -->
                </div>
                <p class="fontSize12px my-3 boldFive">A - Z</p>
                <div class="d-block wid100 mx-auto mb-1" id="countries">
                    <a href="1" class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/au.jpg') }}" alt="" class="wid16px"> Australia</a>
                    <a href="3" class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/at.jpg') }}" class="wid16px" alt=""> Austria</a>
                    <a href="5" class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/us.jpg') }}" class="wid16px" alt=""> USA</a>
                    <a href="6" class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/angentina.png') }}" alt=""> Angentina</a>
                    <a href="7" class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/belgium.png') }}" alt=""> Belgium</a>
                    <a href="8" class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/brazil.png') }}" alt=""> Brazil</a>
                    <a href="9" class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/ca.jpg') }}" alt="" class="wid16px"> Canada</a>
                    <a href="11" class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/cn.jpg') }}" alt="" class="wid16px"> China</a>
                    <a href="10" class="wid100 bodyA d-block boldFive p-2 country marginY fontSize12px bgWhite"><img src="{{ asset('icons/football/croatia.png') }}" alt=""> Croatia</a>
                </div>
                <button class="wid100 fontSize12px blackKsb bgNone borderNone p-2" id="seeMore">Show more</button>
                <div class="wid100 wid100Mobile mt-4 shortBannerHeight">
                    <a href="{{ $bannerShort->url }}"><img src="{{ 'files/'.$bannerShort->name }}" class="wid100 wid100Mobile" alt=""></a>
                </div>
            </div>
            <div class="p-2 order-1 order-md-1 bgWhite mx-auto wid70 wid100Mobile" id="bodyVal">
                <p class="fontSize16px my-3 boldFive">Today Free Games</p>
                <div class="table-responsive shadow mb-4">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bgShaddyWhite">
                                <td colspan="8" class="white"><img src="{{ asset('icons/football/spain.png') }}" alt=""> Spain: Liga ACB</td>
                            </tr>
                            <tr class="boldFour">
                                <td colspan="4" class="fontSize10px">Events</td>
                                <td class="fontSize10px">Tip</td>
                                <td class="fontSize10px centerText">Odd
                                    <div class="d-flex justify-content-between">
                                        <span>1</span>
                                        <span>X</span>
                                        <span>2</span>
                                    </div>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </thead>
                        <tbody id="spainGames">
                            <tr>
                                <td colspan="8" class="bgGrey">
                                    <div class="d-block mx-auto">
                                        <img src="{{ asset('icons/loaders/Soccerball.gif') }}" alt="" class="wid10 d-block mx-auto">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive shadow mb-4">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bgShaddyWhite">
                                <td colspan="8" class="white"><img src="{{ asset('icons/football/cn.jpg') }}" class="wid16px" alt=""> China: CBA</td>
                            </tr>
                            <tr class="boldFour">
                                <td colspan="4" class="fontSize10px">Events</td>
                                <td class="fontSize10px">Tip</td>
                                <td class="fontSize10px centerText">Odd
                                    <div class="d-flex justify-content-between">
                                        <span>1</span>
                                        <span>X</span>
                                        <span>2</span>
                                    </div>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </thead>
                        <tbody id="chinaGames">
                            <tr>
                                <td colspan="8" class="bgGrey">
                                    <div class="d-block mx-auto">
                                        <img src="{{ asset('icons/loaders/Soccerball.gif') }}" alt="" class="wid10 d-block mx-auto">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive shadow mb-4">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bgShaddyWhite">
                                <td colspan="8" class="white"><img class="wid16px" src="{{ asset('icons/football/us.jpg') }}" alt=""> USA: NBA</td>
                            </tr>
                            <tr class="boldFour">
                                <td colspan="4" class="fontSize10px">Events</td>
                                <td class="fontSize10px">Tip</td>
                                <td class="fontSize10px centerText">Odd
                                    <div class="d-flex justify-content-between">
                                        <span>1</span>
                                        <span>X</span>
                                        <span>2</span>
                                    </div>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </thead>
                        <tbody id="NbaGames">
                            <tr>
                                <td colspan="8" class="bgGrey">
                                    <div class="d-block mx-auto">
                                        <img src="{{ asset('icons/loaders/Soccerball.gif') }}" alt="" class="wid10 d-block mx-auto">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive shadow mb-4">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bgShaddyWhite">
                                <td colspan="8" class="white"><img class="wid16px" src="{{ asset('icons/football/ukraine.png') }}" alt=""> Ukraine: FBU SuperLeague</td>
                            </tr>
                            <tr class="boldFour">
                                <td colspan="4" class="fontSize10px">Events</td>
                                <td class="fontSize10px">Tip</td>
                                <td class="fontSize10px centerText">Odd
                                    <div class="d-flex justify-content-between">
                                        <span>1</span>
                                        <span>X</span>
                                        <span>2</span>
                                    </div>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </thead>
                        <tbody id="ukraineGames">
                            <tr>
                                <td colspan="8" class="bgGrey">
                                    <div class="d-block mx-auto">
                                        <img src="{{ asset('icons/loaders/Soccerball.gif') }}" alt="" class="wid10 d-block mx-auto">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="wid100 bgBlue mt-4 longBannerHeight">
                    <a href="https://clcr.me/xsOTPT"><img src="{{ asset('icons/football/longBanner.gif') }}" class="" alt=""></a>
                </div>
                <div class="mt-2">
                    <img src="{{ asset('icons/kgsb.png') }}" alt="" class="my-5 wid45px">
                    <p class="fontSize14px linehigt17px boldFour">
                        Welcome to KGS BET - a membership-based sports prediction website where you can access accurate and detailed predictions for your favorite sports events. We focus on Football, Basketball, and Tennis, providing registered users with in-depth predictions and analysis to help them make informed betting decisions. <br><br>
                        Our website is designed to be user-friendly and easy to navigate, with a landing page that allows both registered and unregistered users to access a limited number of predictions. However, to access more detailed predictions, you'll need to register as a member.<br><br>
                        At KGS BET, we believe in providing our users with the most up-to-date and accurate predictions, which is why we have a dedicated team of experts who continuously analyze and research different sports events to bring you the most reliable predictions.<br><br>
                        In addition to predictions, our website also features banner placements and ads from leading sport betting brands, making it easy for you to place bets on your preferred sports events. Additionally, we have a Telegram channel where you can stay updated on the latest predictions and tips.<br><br>
                        If you're looking for a reliable and user-friendly website to help you make informed betting decisions, look no further than KGS BET. Join today and start reaping the benefits of our expert predictions!<br><br>
                    </p>
                    <a href="https://t.me/+v8J2LHM5RJEzZjhk" class="telegramBlue noneTextDecoration centerText d-block my-5 white fontSize16px p-2 boldSix wid100"><img src="{{ asset('icons/telegramVector.png') }}" alt=""> Click here to join telegram group</a>
                </div>
            </div>
        </div>
    </div>
</main>
@extends('layouts/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
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
    $(document).ready(function() {

        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/loadBasketballGames',
            type: 'GET',
            success: (data) => {
                $("#basketGames").html(data)
            }
        })
        $.ajax({
            url: '/loadSpainLeague',
            type: 'GET',
            success: (data) => {
                $("#spainGames").html(data)
            }
        })
        $.ajax({
            url: '/loadNbaLeague',
            type: 'GET',
            success: (data) => {
                $("#NbaGames").html(data)
            }
        })
        $.ajax({
            url: '/loadChinaLeague',
            type: 'GET',
            success: (data) => {
                $("#chinaGames").html(data)
            }
        })
        $.ajax({
            url: '/loadUkraineLeague',
            type: 'GET',
            success: (data) => {
                $("#ukraineGames").html(data)
            }
        })
        $("#seeMore").click(() => {
            $(this).text("Loading...")
            // $("#seeMore").text(function(i, text) {
            //     return text === "Show more" ? "Show less" : "Show more";
            // });
            $.ajax({
                url: '/loadCountriesBasket',
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
                    $('html, body').animate({
                        scrollTop: 20
                    }, 'slow');
                    //alert(element.getAttribute("href"));
                    //  $("#bodyVal").html(element.getAttribute("href"))
                    // document.getElementById("bodyVal").innerHTML = element.getAttribute("href");
                    $.ajax({
                        url: 'loadLeaguesBasket/' + element.getAttribute("href"),
                        type: "GET",
                        success: (data) => {
                            $("#bodyVal").html(data)
                        }
                    })
                })
            }
        );

    })

    function loadGamesBasket(leagueId) {
        $("#bodyVal").html(' <div class="d-block wid60 mx-auto"><img src = "{{ asset("icons/loaders/Soccerball.gif") }}" alt = "" class ="wid10 d-block mx-auto" ><p class="centerText blackSol fontSize12px">Loading games please wait...</p></div>');
        $.ajax({
            url: '/loadLeagueGamesBasket/' + leagueId,
            type: 'GET',
            success: (data) => {
                $("#bodyVal").html(data)
            }
        })
    }
</script>