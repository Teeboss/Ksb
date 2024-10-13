<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="{{ asset('css/teeStyles.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicons.ico') }}" type='image/x-icon'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body style="background-color: #f5f5f5;">
    <header>
        <!-- place navbar here -->
    </header>
    <img src="{{ asset('icons/midIcon.png') }}" class=" mt-5 d-block mx-auto">
    <main class="mx-2 mx-sm-0">
        <div class=" my-3 wid40 wid100Mobile p-4 rounded bgWhite mx-auto ">
            <p class="text-center fontSize20px boldFive">Login</p>
            <form action="{{ route('loginAdmin.post')}}" method="POST" id="handleAjaxLogin">
                @csrf
                <div id="errors-list-login"></div>
                <div class="my-4">
                    <input type="email" name="email" placeholder="Email" class="form-control fontSize14px" id="">
                    @if($errors->has('email'))
                    <span class="alert-danger">{{$error->first('email')}}</span>
                    @endif
                </div>
                <div class="my-4">
                    <input type="password" name="password" placeholder="Password" class="form-control fontSize14px" id="">
                    @if($errors->has('password'))
                    <span class="alert-danger">{{$error->first('password')}}</span>
                    @endif
                </div>
                <div class="my-4">
                    <button type="submit" class="rounded-pill p-2 wid100 borderNone white boldSix fontSize18px bgBlueKsbTwo">Proceed</button>
                </div>

            </form>
            <a href="/" class=""> Goto the home page</a>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>