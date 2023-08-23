@extends('layouts/pageHead')
<style>
    td,
    td p {
        /* height: 50px; */
        vertical-align: middle;
    }
</style>
<main class="marginTopSmallNavLong " style="background-color:  #F5F5F5;">
    <div class="d-block wid70 p-2 wid100Mobile mx-auto">
        <div class="d-flex flex-wrap justify-content-center align-items-center ">
            <div class="wid50 wid100Mobile p-2">
                <p class="fontSize20px boldFour mb-1">Reach out.</p>
                <p class="fontSize44px boldSeven mb-5">We’re here to help. Just reach out to us,</p>
                <p class="fontSize14px boldSeven mb-2"><a href="mailto: support@Kingsolomonbet.com" class="fontSize14px bodyA boldFour">support@Kingsolomonbet.com</a></p>
                <p class="fontSize14px boldSeven mb-2"><a href="tel: +2347012345678" class="fontSize14px boldFour bodyA">+234 701 234 5678</a></p>
                <div class="d-flex">
                    <img src="{{ asset('icons/dd.png') }}" alt="" class="m-1">
                    <img src="{{ asset('icons/smallTwitter.png') }}" alt="" class="m-1">
                    <img src="{{ asset('icons/smallInsta.png') }}" alt="" class="m-1">
                </div>
            </div>
            <div class="wid50 wid100Mobile rounded bgWhite p-4">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
                <form method="POST" action="{{ route('contact.us.store') }}" id="contactUSForm">
                    @csrf
                    <div id="errors-list-login"></div>
                    <div class="my-4">
                        <input type="email" name="email" id="formGroupExampleInput2" placeholder="Email" class="form-control fontSize14px" id="">
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="my-4">
                        <input type="text" name="subject" id="formGroupExampleInput2" placeholder="Subject" class="form-control fontSize14px" id="">
                        @if ($errors->has('subject'))
                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                        @endif
                    </div>
                    <div class="my-4">
                        <textarea name="message" id="" cols="30" rows="5" class="form-control fontSize14px" placeholder="Message"></textarea>
                        @if ($errors->has('message'))
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                        @endif
                    </div>
                    <div class="my-4">
                        <button type="submit" class="rounded-pill p-2 wid100 borderNone white boldSix fontSize18px bgBlueKsbTwo">Submit</button>
                    </div>

                </form>
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
        $("#bodyVal").html(' <div class="d-block wid60 mx-auto"><img src = "{{ asset("icons/loaders/Soccerball.gif") }}" alt = "" class ="wid10 d-block mx-auto" ><p class="centerText blackSol fontSize12px">Loading games please wait...</p></div>');
        $.ajax({
            url: '/loadLeagueGames/' + leagueId,
            type: 'GET',
            success: (data) => {
                $("#bodyVal").html(data)
            }
        })
    }
</script>