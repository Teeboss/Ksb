@extends('layouts/pageHead')
<main class="mx-2 py-1 mx-sm-0 marginTopSmallNavLong" style="background-color: #f5f5f5;">
    <div class=" my-3 wid40 wid100Mobile p-4 rounded bgWhite mx-auto ">
        <p class="text-center fontSize20px boldFive">Recover your password</p>
        <p class="text-center fontSize10px boldFive">we'll send you a password reset pin to your registered email address.</p>
        @if(Session::has('successfor'))
        <div class="alert alert-success">
            {{Session::get('successfor')}}
        </div>
        @endif
        @if(Session::has('noMail'))
        <div class="alert alert-danger">
            {{Session::get('noMail')}}
        </div>
        @endif
        <form action="{{ route('forgot.store') }}" method="POST">
            @csrf
            <div id="errors-list-login"></div>
            <div class="my-4">
                <input type="email" name="email" placeholder="Email" class="form-control fontSize14px" id="">
                @if($errors->has('email'))
                <span class="alert-danger">{{$error->first('email')}}</span>
                @endif
            </div>
            <div class="my-4">
                <button type="submit" class="rounded-pill p-2 wid100 borderNone white boldSix fontSize18px bgBlueKsbTwo">Proceed</button>
            </div>

        </form>
        <a href="/recovery" class="fontSize12px"> Goto Recovery Page</a>
    </div>
</main>
@extends('layouts/footer')