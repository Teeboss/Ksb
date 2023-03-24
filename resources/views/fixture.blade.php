@extends('layouts/pageHead')
<style>
    .wg_width_90 {
        width: 99px !important;
    }
</style>
<main class="marginTopSmallNavLong" style="background-color:  #F5F5F5;">
    <?php //echo request()->leagueId;"\n" 
    ?>
    <?php // echo date("Y", strtotime("-1 year")); 
    ?>
    <div class="mx-auto m-2 wid80 wid100Mobile d-block higt125px" style="overflow: hidden;">
        <a href="{{ $bannerLongFix->url }}"><img src="{{ asset('files/'.$bannerLongFix->name) }}" class="wid100" alt=""></a>
    </div>
    <div class="d-block p-2 p-sm-0 mx-auto wid100Mobile wid60 bgWhite" id="fixtureData">
        <div class="d-block mx-auto wid80">
            <img src="{{ asset('icons/loaders/Soccerball.gif') }}" alt="" class="wid10 d-block mx-auto">
        </div>
    </div>
    <div class="mx-auto m-0 wid60 wid20Mobile d-block higt125px" style="overflow: hidden;">
        <a href="{{ $bannerLongFix->url }}"><img src="{{ asset('files/'.$bannerLongFix->name) }}" class="wid100" alt=""></a>
    </div>
    <div class="wid60 wid100Mobile d-block mx-sm-auto" style="overflow: scroll;">
        <!-- <div id="wg-api-football-standings" data-host="api-football-v1.p.rapidapi.com" data-key="0126ec08b8msh9cb2066fb6d9415p1a063ajsn7b6be79b4e0f" data-league="39" data-season="2022" data-theme="" data-show-toolbar="true" data-show-errors="true" data-show-logos="true">
        </div> -->
        <div id="wg-api-football-standings" data-host="api-football-v1.p.rapidapi.com" data-key="de69946105msh74b7a8ee65acaa7p1503aejsna90bccd18650" data-league="{{request()->leagueId}}" data-team="" data-season="2022" data-theme="" data-show-errors="false" data-show-logos="true" class="wg_loader"></div>
    </div>
    <style>

    </style>
</main>
@extends('layouts/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script type="module" src="https://widgets.api-sports.io/2.0.3/widgets.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/loadFixture/' + <?php echo request()->fixtureId ?> + '/' + <?php echo request()->leagueId ?>,
            type: 'GET',
            success: (data) => {
                $("#fixtureData").html(data)
            }
        })
    })
</script>