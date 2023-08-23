@extends('layouts/pageHead')
<style>
    html {
        scroll-behavior: smooth;
    }

    /* bootstrap links colors*/
    .pagination>li>a,
    .pagination>li>span {
        color: #4d4d4d;
    }

    .pagination>.active>a,
    .pagination>.active>a:focus,
    .pagination>.active>a:hover,
    .pagination>.active>span,
    .pagination>.active>span:focus,
    .pagination>.active>span:hover {
        background-color: #4d4d4d;
        border-color: #4d4d4d;
    }
</style>
<main class="marginTopSmallNavLong p-1 p-sm-3" style="background-color:  #F5F5F5;">
    <div class="mx-auto d-block wid90 wid100Mobile bgLinearBlue p-4 p-sm-5 mb-3 rounded-2 rounded-sm-5">
        <div class="d-flex flex-wrap">
            <div class="col-md-8">
                <span class="boldFour white fontSize10px boldFour text-center d-block">24/7 sport bet Predictions. happy customer</span>
                <span class="fontSize44px white boldSeven my-3">Join Our VIP Channel and get Premium TIP that will make you over $500 monthly.</span>
                <span class="fontSize18px boldFive white d-block my-3">Get VIP tips from our expert punters, VIP rollovers on all events across selected bookies. It takes 2 min to join,No experience is needed,24/7 support.</span>
                <a href="https://paystack.com/pay/kgsb-vip" class="bgLinearGreen wid-40 wid-50-mobile text-decoration-none p-2 fontSize16px boldThree rounded-5 d-block text-center mb-3">Start Making Money with Us !</a>

                <a href="/" class="fontSize16px boldFour white text-decoration-none d-inline-block ms-3">Head back to our Home page</a>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <!-- <div class=" wid40 wid100Mobile  rounded bgWhite p-4 mx-auto" id="sectionTwo">
        <p class="text-center fontSize20px boldFive">Join our Premium Channel</p>
        <p class="text-center fontSize10px boldFive">we'll like to coloborate with you.</p>
        @if(Session::has('successSub'))
        <div class="alert alert-success">
            {{Session::get('successSub')}}
        </div>
        @endif
        @if(Session::has('noSub'))
        <div class="alert alert-danger">
            {{Session::get('noSub')}}
        </div>
        @endif
        <form action="{{ route('subscribe.store') }}" method="POST" id="paymentForm">
            @csrf
            <div id="errors-list-login"></div>
            <div class="my-4">
                <input type="text" name="fullname" placeholder="Full Name" class="form-control fontSize14px" id="">
                @if($errors->has('name'))
                <span class="alert-danger">{{$error->first('name')}}</span>
                @endif
            </div>
            <div class="my-4">
                <input type="email" name="email" placeholder="Email" class="form-control fontSize14px" id="email">
                @if($errors->has('email'))
                <span class="alert-danger">{{$error->first('email')}}</span>
                @endif
            </div>
            <div class="my-4">
                <input type="number" name="amount" placeholder="Enter amount" class="form-control fontSize14px" id="amount">
                @if($errors->has('email'))
                <span class="alert-danger">{{$error->first('email')}}</span>
                @endif
            </div>
            <input type="hidden" id="amount" value="6000">
            <div class="my-4">
                <button type="submit" class="rounded-pill p-2 wid100 borderNone white boldSix fontSize18px bgBlueKsbTwo" onclick="payWithPaystack()">Proceed</button>
            </div>

        </form>
        <a href="/recovery" class="fontSize12px"> Goto Recovery Page</a>
    </div> -->
</main>
@extends('layouts/footer')
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script src="{{ asset('js/teeJs.js') }}"></script>
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



        // if (localStorage.getItem('myItem') !== null) {
        //     $('#imageModal').modal('hide');
        // } else {
        //     setTimeout(function() {
        //         $('#imageModal').modal('show');
        //         localStorage.setItem('myItem', 'myValue');
        //     }, 6000);
        // }
        // setTimeout(function() {
        //     localStorage.removeItem('myItem');
        // }, 120000);
    });
</script>