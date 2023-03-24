<main>
    <img src="{{ asset('icons/midIcon.png') }}" class=" mt-5 d-block mx-auto">
    <h2 class="text-center boldEight blackKsb ">Recovery Pin for {{ $data->email }}</h2>
    <br>

    <strong>Your Pin: </strong>{{ $data->pin }} <br>


    Thank you
</main>