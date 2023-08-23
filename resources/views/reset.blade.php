@extends('layouts/pageHead')
<main class="p-3 marginTopSmallNavLong" style="background-color: #f5f5f5;">
    <div class=" wid40 wid100Mobile  rounded bgWhite p-4 mx-auto ">
        <p class="text-center fontSize20px boldFive">Reset Password</p>
        <p class="text-center fontSize10px boldFive">You will now click on the login button</p>
        @if (Session::has('recovery'))
            <div class="alert alert-success">
                {{ Session::get('recovery') }}
            </div>
        @endif
        @if (Session::has('pinMsg'))
            <div class="alert alert-danger">
                {{ Session::get('pinMsg') }}
            </div>
        @endif
        <form action="{{ route('reset.store') }}" method="POST">
            @csrf
            <div id="errors-list-login"></div>
            <div class="my-4">
                <input type="text" name="pin" placeholder="Recovery Pin" class="form-control fontSize14px"
                    id="">
                @if ($errors->has('pin'))
                    <span class="alert-danger">{{ $error->first('pin') }}</span>
                @endif
            </div>
            <div class="my-4">
                <input type="password" name="password" placeholder="Insert Your new Password"
                    class="form-control fontSize14px" id="">
                @if ($errors->has('password'))
                    <span class="alert-danger">{{ $error->first('password') }}</span>
                @endif
            </div>
            <div class="my-4">
                <button type="submit"
                    class="rounded-pill p-2 wid100 borderNone white boldSix fontSize18px bgBlueKsbTwo">Proceed</button>
            </div>

        </form>
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
