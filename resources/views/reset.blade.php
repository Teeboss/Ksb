@extends('layouts/pageHead')
<main class="mx-2 py-1 mx-sm-0 marginTopSmallNavLong" style="background-color: #f5f5f5;">
    <div class=" my-3 wid40 wid100Mobile p-4 rounded bgWhite mx-auto ">
        <p class="text-center fontSize20px boldFive">Reset Password</p>
        <p class="text-center fontSize10px boldFive">You will now be redirected to login</p>
        @if(Session::has('recovery'))
        <div class="alert alert-success">
            {{Session::get('recovery')}}
        </div>
        @endif
        @if(Session::has('pinMsg'))
        <div class="alert alert-danger">
            {{Session::get('pinMsg')}}
        </div>
        @endif
        <form action="{{ route('reset.store') }}" method="POST">
            @csrf
            <div id="errors-list-login"></div>
            <div class="my-4">
                <input type="text" name="pin" placeholder="Recovery Pin" class="form-control fontSize14px" id="">
                @if($errors->has('pin'))
                <span class="alert-danger">{{$error->first('pin')}}</span>
                @endif
            </div>
            <div class="my-4">
                <input type="text" name="password" placeholder="Insert Your new Password" class="form-control fontSize14px" id="">
                @if($errors->has('password'))
                <span class="alert-danger">{{$error->first('password')}}</span>
                @endif
            </div>
            <div class="my-4">
                <button type="submit" class="rounded-pill p-2 wid100 borderNone white boldSix fontSize18px bgBlueKsbTwo">Proceed</button>
            </div>

        </form>
    </div>
</main>
@extends('layouts/footer')