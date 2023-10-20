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
            <a href="{{ $bannerLong->url }}"><img src="{{ 'files/' . $bannerLong->name }}" class="wid100" alt=""></a>
        </div>
    @else
        <div class="mx-auto m-2 wid80 wid100Mobile d-block higt125px" style="overflow: hidden;">
            <a href="#"><img src="{{ asset('icons/longBanner.gif') }}" class="wid100" alt=""></a>
        </div>
    @endisset
    <div class="wid80 wid100Mobile  p-2 p-sm-2 bgWhiteKsb mx-auto rounded">
        <div class="d-flex justify-content-center">
            <div class="wid70 wid100Mobile me-lg-3">
                <p class="fontSize16px boldFive">Today Free Games</p>
                <div class="table-responsive bgWhite">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td colspan="2" class="boldFive fontSize10px">Events</td>
                                <td class="boldFive fontSize10px">Tip</td>
                                <td colspan="2" class="boldFive fontSize10px centerText">Odd <br>
                                    <div class="d-flex justify-content-between">
                                        <span>1</span>
                                        <span>X</span>
                                        <span>2</span>
                                    </div>
                                </td>
                                <td class="boldFive fontSize10px text-center">Booking</td>
                            </tr>
                        </thead>
                        <tbody id="homeGames">
                            <tr>
                                <td colspan="6" class="bgGrey">
                                    <div class="d-block mx-auto">
                                        <img src="{{ asset('icons/loaders/Soccerball.gif') }}" alt=""
                                            class="wid10 d-block mx-auto">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="https://t.me/+JuEe07nfSssxM2Y0"
                    class="telegramBlue noneTextDecoration centerText noneTextDecoration d-block mx-auto my-5 white fontSize16px p-2 boldSix wid100"><img
                        src="{{ asset('icons/telegramVector.png') }}" alt=""> Click here to join telegram
                    group</a>
                <div class=" d-block mx-auto">
                    <p class="bgBlackKsb boldFive fontSize14px white p-2 m-1">Popular Football League</p>
                    @guest
                        <a href="" class="wid100 bodyA d-block boldFive p-2 fontSize12px bgWhite m-1"
                            data-bs-toggle="modal" data-bs-target="#loginModal"><img src="{{ asset('icons/uefa.png') }}"
                                alt=""> UEFA Champions League</a>
                        <a href="" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"
                            data-bs-toggle="modal" data-bs-target="#loginModal"><img
                                src="{{ asset('icons/premierLeague.png') }}" alt=""> Premier League</a>
                        <a href="" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"
                            data-bs-toggle="modal" data-bs-target="#loginModal"><img
                                src="{{ asset('icons/bundesliga.png') }}" alt=""> Bundesliga</a>
                        <a href="" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"
                            data-bs-toggle="modal" data-bs-target="#loginModal"><img src="{{ asset('icons/laliga.png') }}"
                                alt=""> LaLiga</a>
                        <a class="bodyA noWrap mt-2 bgSocials fontSize14px boldSix centerText d-block mx-auto wid12 wid50HalfMobile p-2 rounded"
                            type="button" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom"
                            data-bs-content="Login or Sign up before you access this feature">See more</a>
                    @else
                        <a href="/football" class="wid100 bodyA d-block boldFive p-2 fontSize12px bgWhite m-1"><img
                                src="{{ asset('icons/uefa.png') }}" alt=""> UEFA Champions League</a>
                        <a href="/football" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"><img
                                src="{{ asset('icons/premierLeague.png') }}" alt=""> Premier League</a>
                        <a href="/football" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"><img
                                src="{{ asset('icons/bundesliga.png') }}" alt=""> Bundesliga</a>
                        <a href="/football" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"><img
                                src="{{ asset('icons/laliga.png') }}" alt=""> LaLiga</a>
                        <a href="/football"
                            class="bodyA noWrap mt-2 bgSocials fontSize14px boldSix centerText d-block mx-auto wid12 wid50HalfMobile p-2 rounded">See
                            more</a>
                    @endguest
                </div>
                <div class="d-block my-5">
                    <p class="bgBlackKsb boldFive fontSize14px white p-2 m-1">Popular Basketball League</p>
                    @guest
                        <a href="" class="wid100 bodyA d-block boldFive p-2 fontSize12px bgWhite m-1"
                            data-bs-toggle="modal" data-bs-target="#loginModal"><img src="{{ asset('icons/nba.png') }}"
                                alt=""> NBA</a>
                        <a href="" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"
                            data-bs-toggle="modal" data-bs-target="#loginModal"><img src="{{ asset('icons/fiba.png') }}"
                                alt=""> FIBA</a>
                        <a href="" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"
                            data-bs-toggle="modal" data-bs-target="#loginModal"><img
                                src="{{ asset('icons/usaFlag.png') }}" alt=""> USA</a>
                        <a href="" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"
                            data-bs-toggle="modal" data-bs-target="#loginModal"><img
                                src="{{ asset('icons/chinaBasket.png') }}" alt=""> Chinese Basketball
                            Association</a>

                        <a class="bodyA noWrap mt-2 bgSocials fontSize14px boldSix centerText d-block mx-auto wid12 wid50HalfMobile p-2 rounded"
                            type="button" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom"
                            data-bs-content="Login or Sign up before you access this feature">See more</a>
                    @else
                        <a href="/basketball" class="wid100 bodyA d-block boldFive p-2 fontSize12px bgWhite m-1"><img
                                src="{{ asset('icons/nba.png') }}" alt=""> NBA</a>
                        <a href="/basketball" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"><img
                                src="{{ asset('icons/fiba.png') }}" alt=""> FIBA</a>
                        <a href="/basketball" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"><img
                                src="{{ asset('icons/usaFlag.png') }}" alt=""> USA</a>
                        <a href="basketball" class="wid100 bodyA d-block p-2 boldFive fontSize12px bgWhite m-1"><img
                                src="{{ asset('icons/chinaBasket.png') }}" alt=""> Chinese Basketball
                            Association</a>
                        <a class="bodyA mt-2 bgSocials fontSize14px boldSix noWrap centerText d-block mx-auto wid12 wid50HalfMobile p-2 rounded"
                            onclick="location.href='/basketball'">See more</a>
                    @endguest
                </div>
                <div>
                    <p class="fontSize14px boldFive">Sports Popular Categories</p>

                    <div class="d-flex justify-content-between">
                        @guest
                            <a href="" data-bs-toggle="modal" data-bs-target="#loginModal"><img
                                    src="{{ asset('icons/footballFrame.png') }}" class="wid90px" alt=""></a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#loginModal"><img
                                    src="{{ asset('icons/basketballFrame.png') }}" class="wid90px" alt=""></a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#loginModal"><img
                                    src="{{ asset('icons/tennisFrame.png') }}" class="wid90px" alt=""></a>
                        @else
                            <a href="/football"><img src="{{ asset('icons/footballFrame.png') }}" class="wid90px"
                                    alt=""></a>
                            <a href="basketball"><img src="{{ asset('icons/basketballFrame.png') }}" class="wid90px"
                                    alt=""></a>
                            <a href="/tennis"><img src="{{ asset('icons/tennisFrame.png') }}" class="wid90px"
                                    alt=""></a>
                        @endguest
                    </div>

                </div>
                <a href="https://t.me/+JuEe07nfSssxM2Y0"
                    class="telegramBlue centerText noneTextDecoration d-block my-5 white fontSize16px p-2 boldSix wid100"><img
                        src="{{ asset('icons/telegramVector.png') }}" alt=""> Click here to join telegram
                    group</a>
                <div class="my-3">
                    <p class="fontSize14px boldFive">Special offers from bookmarkers, click to claim bonus</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <img src="{{ asset('icons/betano-nigeria.png') }}" class="wid45px rounded-3" alt="">
                        <img src="{{ asset('icons/betano-nigeria.png') }}" class="wid45px rounded-3" alt="">
                        <img src="{{ asset('icons/betano-nigeria.png') }}" class="wid45px rounded-3" alt="">
                        <img src="{{ asset('icons/betano-nigeria.png') }}" class="wid45px rounded-3" alt="">
                        <a href="https://www.betano.ng/"><img src="{{ asset('icons/betano-nigeria.png') }}"
                                class="wid45px rounded-3" alt=""></a>
                    </div>
                </div>
                <div class="my-3">
                    <p class="fontSize14px boldFive">Sport News</p>
                    <div class="wid100 d-flex flex-wrap justify-content-sm-start p-0 justify-content-center">
                        @foreach ($newses as $news)
                            <div class="col-sm-5 col-11 m-sm-3 m-2 pointers"
                                onclick="location.href='/news/{{ $news->id }}'">
                                <div class="newsImage">
                                    <img src="{{ 'files/' . $news->name }}" alt="" class="wid100">
                                </div>
                                <p class="fontSize14px boldFour socialColorDeeperNine m-0 mt-2">
                                    {{ date('M d,Y', strtotime($news->created_at)) }}</p>
                                <p class="fontSize20px boldFive socialColorDeeper m-0">{{ $news->newstitle }}</p>
                                <p class="fontSize14px boldFour bodyA m-0">{{ substr($news->newsbody, 0, 90) }}...</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a href="/news" target="_blank"
                    class="bodyA noWrap mt-2 bgSocials fontSize14px boldSix centerText d-block mx-auto wid12 wid50HalfMobile p-2 rounded">See
                    more</a>
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
                    <a href="https://t.me/+JuEe07nfSssxM2Y0"
                        class="telegramBlue noneTextDecoration centerText d-block my-5 white fontSize16px p-2 boldSix wid100"><img
                            src="{{ asset('icons/telegramVector.png') }}" alt=""> Click here to join telegram
                        group</a>
                </div>
            </div>
            <div class="wid30 deskTop">
                <div class="d-block">
                    @isset($bannerShort)
                        <div class="wid100 mt-4 shortBannerHeight">
                            <a href="{{ $bannerShort->url }}" target="_blank"><img
                                    src="{{ 'files/' . $bannerShort->name }}" class="wid100 wid100Mobile"
                                    alt=""></a>
                        </div>
                    @else
                        <div class="wid100 mt-4 shortBannerHeight">
                            <a href="/" target="_blank"><img src="{{ asset('icons/shortBanner.jpg') }}"
                                    class="wid100 wid100Mobile" alt=""></a>
                        </div>
                    @endisset
                    @isset($bannerHome)
                        <div class=" wid100 bgBlue mt-4 longBannerHeight" style="height: 600px; overflow: hidden;">
                            <a href="{{ $bannerHome->url }}" target="_blank"><img
                                    src="{{ 'files/' . $bannerHome->name }}" class="" alt=""></a>
                        </div>
                    @else
                        <div class=" wid100 bgBlue mt-4 longBannerHeight" style="height: 600px; overflow: hidden;">
                            <a href="/" target="_blank"><img src="{{ asset('icons/longBanner.png') }}"
                                    class="" alt=""></a>
                        </div>
                    @endisset
                    @isset($bannerShort)
                        <div class="wid100 mt-4 shortBannerHeight">
                            <a href="{{ $bannerShort->url }}" target="_blank"><img
                                    src="{{ 'files/' . $bannerShort->name }}" class="wid100 wid100Mobile"
                                    alt=""></a>
                        </div>
                    @else
                        <div class="wid100 mt-4 shortBannerHeight">
                            <a href="/" target="_blank"><img src="{{ asset('icons/shortBanner.jpg') }}"
                                    class="wid100 wid100Mobile" alt=""></a>
                        </div>
                    @endisset
                    @isset($bannerHome)
                        <div class=" wid100 bgBlue mt-4 longBannerHeight" style="height: 600px; overflow: hidden;">
                            <a href="{{ $bannerHome->url }}" target="_blank"><img
                                    src="{{ 'files/' . $bannerHome->name }}" class="" alt=""></a>
                        </div>
                    @else
                        <div class=" wid100 bgBlue mt-4 longBannerHeight" style="height: 600px; overflow: hidden;">
                            <a href="/" target="_blank"><img src="{{ asset('icons/longBanner.png') }}"
                                    class="" alt=""></a>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
        <!-- <div class="wid100 d-flex flex-wrap justify-content-sm-start justify-content-center">
            @foreach ($newses as $news)
<div class="col-sm-4 col-11 m-3">
                <div class="newsImage">
                    <img src="{{ 'files/' . $news->name }}" alt="" class="wid100">
                </div>
                <p class="fontSize14px boldFour socialColorDeeperNine m-0 mt-2">{{ date('M d,Y', strtotime($news->created_at)) }}</p>
                <p class="fontSize20px boldFive socialColorDeeper m-0">{{ $news->newstitle }}</p>
                <p class="fontSize14px boldFour bodyA m-0">{{ $news->newsbody }}</p>

            </div>
@endforeach
        </div> -->
    </div>




    <!-- Modal markup -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img src="{{ asset('icons/telegramModal.gif') }}" class="wid100 pointers" alt="Image"
                        onclick="location.href='https://t.me/+JuEe07nfSssxM2Y0'">
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
    $(document).ready(function() {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/loadHomeGames',
            type: 'GET',
            success: (data) => {
                $("#homeGames").html(data)
            }
        })



        if (localStorage.getItem('myItem') !== null) {
            $('#imageModal').modal('hide');
        } else {
            setTimeout(function() {
                $('#imageModal').modal('show');
                localStorage.setItem('myItem', 'myValue');
            }, 6000);
        }
        setTimeout(function() {
            localStorage.removeItem('myItem');
        }, 120000);
    });
</script>
