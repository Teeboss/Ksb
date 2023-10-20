<x-fixture-head></x-fixture-head>
<main class="marginTopSmallNavLong" style="background-color:  #F5F5F5;">
    @isset($bannerLong)
        <div class="mx-auto m-2 wid80 wid100Mobile d-block higt125px" style="overflow: hidden;">
            <a href="{{ $bannerLong->url }}"><img src="{{ asset('files/' . $bannerLong->name) }}" class="wid100"
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
    <div class="d-block p-2 p-sm-0 mx-auto wid100Mobile wid50 bgWhite" id="fixtureData">
        <div class="d-block mx-auto wid80">
            <img src="{{ asset('icons/loaders/Soccerball.gif') }}" alt="" class="wid10 d-block mx-auto">
        </div>
    </div>
    <div class="wid60 wid100Mobile d-block mx-sm-auto" style="overflow: scroll;">
        <div id="wg-api-basketball-games" data-host="api-basketball.p.rapidapi.com"
            data-key="de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650" data-date="" data-league=""
            data-season="2022" data-theme="" data-refresh="15" data-show-toolbar="true" data-show-errors="false"
            data-show-logos="true" data-modal-game="true" data-modal-standings="true" data-modal-show-logos="true">
        </div>
    </div>
    <script type="module" src="https://widgets.api-sports.io/2.0.3/widgets.js"></script>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"
    integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
    integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
</script>
<script type="module" src="https://widgets.api-sports.io/2.0.3/widgets.js"></script>
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
    //  $(document).ready(function() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/loadFixtureBasketball/' + <?php echo request()->fixtureId; ?> + '/' + <?php echo request()->leagueId; ?>,
        type: 'GET',
        success: (data) => {
            $("#fixtureData").html(data)
        }
    })

    //  })
</script>
