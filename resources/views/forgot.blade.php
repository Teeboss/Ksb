@extends('layouts/pageHead')
<main class="marginTopSmallNavLong p-3" style="background-color: #f5f5f5;">
    <div class=" wid40 wid100Mobile  rounded bgWhite p-4 mx-auto ">
        <p class="text-center fontSize20px boldFive">Recover your password</p>
        <p class="text-center fontSize10px boldFive">we'll send you a password reset pin to your registered email
            address.</p>
        @if (Session::has('successfor'))
            <div class="alert alert-success">
                {{ Session::get('successfor') }}
            </div>
        @endif
        @if (Session::has('noMail'))
            <div class="alert alert-danger">
                {{ Session::get('noMail') }}
            </div>
        @endif
        <form action="{{ route('forgot.store') }}" method="POST">
            @csrf
            <div id="errors-list-login"></div>
            <div class="my-4">
                <input type="email" name="email" placeholder="Email" class="form-control fontSize14px"
                    id="">
                @if ($errors->has('email'))
                    <span class="alert-danger">{{ $error->first('email') }}</span>
                @endif
            </div>
            <div class="my-4">
                <button type="submit"
                    class="rounded-pill p-2 wid100 borderNone white boldSix fontSize18px bgBlueKsbTwo">Proceed</button>
            </div>

        </form>
        <a href="/recovery" class="fontSize12px"> Goto Recovery Page</a>
    </div>
</main>

@extends('layouts/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"
    integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8FKKQNJ4Z8"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-8FKKQNJ4Z8');
</script>
