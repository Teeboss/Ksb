<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="{{ asset('css/teeStyles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="{{ asset('icons/iconNav.png') }}" alt=""></a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" aria-current="page">{{Auth::guard('admin')->user()->username}} <span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Home</a>
                        </li>
                    </ul>
                    <a class="fontSize14px bodyA rounded bgSocials ms-1 py-2 px-3" href="{{ route('logoutAdmin') }}">
                        Logout
                    </a>
                </div>
            </div>
        </nav>

    </header>
    <main class="wid70 wid100Mobile mx-auto p-4">

        <div class="wid50  wid50Mobile mx-auto">

            <!-- Response message -->
            <div class="alert displaynone" id="responseMsg"></div>

            <!-- File preview -->
            <div id="filepreview" class="displaynone">
                <img src="" class="displaynone" with="200px" height="200px"><br>

            </div>

            <!-- Form -->
            <div class="form-group m-3">
                <label class="control-label col-md-3 col-sm-3 col-xs-12 noWrap" for="name">Cover Image <span class="required">*</span></label>

                <input type='file' id="file" name='file' class="form-control">

                <!-- Error -->
                <div class='alert alert-danger mt-2 d-none text-danger' id="err_file"></div>

            </div>
            <div class="form-group m-3">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">News Title <span class="required">*</span></label>

                <input type='text' id="newstitle" name='newstitle' class="form-control">

            </div>
            <div class="form-group m-3">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">News Body<span class="required">*</span></label>

                <input type='text' id="newsbody" name='newsbody' class="form-control" aria-label="news body " />

            </div>
            <div class="form-group m-3">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Admin<span class="required">*</span></label>

                <input type="text" id="uploader" name="uploader" readonly value="{{Auth::guard('admin')->user()->username}}" class="form-control">

                <!-- Error -->
                <!-- <div class='alert alert-danger mt-2 d-none text-danger' id="err_file"></div> -->
            </div>
            <div class="form-group text-center">
                <input type="button" id="submit" value='Submit' class='btn btn-success'>
            </div>

        </div>
        @foreach ($ads as $ad)

        <div class="bgSocials p-2 my-4 rounded wid80 wid100Mobile mx-auto">
            <img src="files/{{$ad->name}}" alt="" class="my-4 wid100">
            <div class="d-flex flex-wrap ">
                <p class="bgSocials m-2 wid100  p-2 rounded small " style="background-color: #acacac;"><span class="boldEight">News Title:</span> <br> {{$ad->newstitle}}</p>
                <p class="bgSocials m-2 wid100 p-1 rounded small"><span class="boldEight">News Body:</span> <br> {{$ad->newsbody}}</p>
                <div class="white p-2 rounded bgRed">
                    <a href="{{ route('dashboard.index') }}" onclick="event.preventDefault();
            document.getElementById(
              'delete-form-{{$ad->id}}').submit();">
                        Delete
                    </a>
                    </td>
                    <form id="delete-form-{{$ad->id}}" + action="{{route('news.destroy', $ad->id)}}" method="post">
                        @csrf @method('DELETE')
                    </form>
                </div>
            </div>
        </div>

        @endforeach
        {{ $ads->links() }}
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    $(document).ready(function() {

        $('#submit').click(function() {
            $(this).val("Uploading...");
            // Get the selected file
            var files = $('#file')[0].files;
            var newstitle = $('#newstitle').val()
            var uploader = $('#uploader').val()
            var newsbody = $('#newsbody').val()

            if (files.length > 0) {
                var fd = new FormData();

                // Append data 
                fd.append('file', files[0]);
                fd.append('_token', CSRF_TOKEN);
                fd.append('newstitle', newstitle);
                fd.append('uploader', uploader);
                fd.append('newsbody', newsbody);
                // fd.append('url', url);

                // Hide alert 
                $('#responseMsg').hide();

                // AJAX request 
                $.ajax({
                    url: "{{route('uploadFileNews')}}",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {

                        // Hide error container
                        $('#err_file').removeClass('d-block');
                        $('#err_file').addClass('d-none');

                        if (response.success == 1) { // Uploaded successfully

                            // Response message
                            $('#responseMsg').removeClass("alert-danger");
                            $('#responseMsg').addClass("alert-success");
                            $('#responseMsg').html(response.message);
                            $('#responseMsg').show();

                            // File preview
                            $('#filepreview').show();
                            $('#filepreview img,#filepreview a').hide();
                            if (response.extension == 'jpg' || response.extension == 'jpeg' || response.extension == 'png') {

                                $('#filepreview img').attr('src', response.filepath);
                                $('#filepreview img').show();
                                setTimeout(() => {
                                    location.reload()
                                }, 2000)
                            } else {
                                $('#filepreview a').attr('href', response.filepath).show();
                                $('#filepreview a').show();
                            }
                        } else if (response.success == 2) { // File not uploaded

                            // Response message
                            $('#responseMsg').removeClass("alert-success");
                            $('#responseMsg').addClass("alert-danger");
                            $('#responseMsg').html(response.message);
                            $('#responseMsg').show();
                        } else {
                            // Display Error
                            $('#err_file').text(response.error);
                            $('#err_file').removeClass('d-none');
                            $('#err_file').addClass('d-block');
                        }
                    },
                    error: function(response) {
                        console.log("error : " + JSON.stringify(response));
                    }
                });
            } else {
                alert("Please select a file.");
            }

        });
    });
</script>

</html>