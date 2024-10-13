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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<style>
    .trans {
        padding: 2%;
        transition: padding 0.5s ease-in-out;
    }

    .trans:hover {
        padding: 3%;
    }
</style>

<body style="background-color: #f5f5f5;">
    <header>
        <!-- place navbar here -->
    </header>
    <img src="{{ asset('icons/midIcon.png') }}" class=" mt-5 d-block mx-auto">
    <main class="mx-2 mx-sm-0">
        <div class="wid40 wid100Mobile p-4 rounded bgWhite my-3 mx-auto">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
            <p class="text-center boldSix fontSize24px">Admin UI</p>
            @section('content')
            <form action="{{ route('adminRegistration.post') }}" method="POST" id="handleAjax">
                @csrf
                <div id="errors-list"></div>
                <div class="my-4">
                    <input type="text" name="username" class="form-control" placeholder="Admin Username" aria-label="Last name">
                    @if ($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="my-4">
                    <input type="email" name="email" placeholder="Email" class="form-control fontSize14px" id="">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="my-4">
                    <input type="password" name="password" placeholder="Password" class="form-control fontSize14px" id="">
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="my-4">
                    <button type="submit" class=" trans rounded-pill borderNone wid100 white boldSix fontSize18px bgBlueKsbTwo">Proceed</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).on("submit", "#handleAjax", function() {
        var e = this;

        $(this).find("[type='submit']").html("Register...");

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: "POST",
            error: (error) => {
                console.log(error)
            },
            dataType: 'json',
            success: function(data) {
                $(e).find("[type='submit']").html("Register");

                if (data.status) {
                    //window.location = data.redirect;
                    location.replace("/dashboard")
                } else {

                    $(".alert").remove();
                    $.each(data.message, function(key, val) {
                        $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                    });
                }

            }
        });

        return false;
    });
</script>