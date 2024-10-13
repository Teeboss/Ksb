@extends('layouts/pageHead')
<style>
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
<main class="marginTopSmallNavLong p-3" style="background-color:  #F5F5F5;">
    @isset($bannerLong)
        <div class="mx-auto m-2 wid80 wid100Mobile d-block higt125px" style="overflow: hidden;">
            <a href="{{ $bannerLong->url }}" target="_blank"><img src="{{ asset('files/' . $bannerLong->name) }}" class="wid100"
                    alt=""></a>
        </div>
    @else
        <!-- <div class="mx-auto m-2 wid80 wid100Mobile d-block higt125px" style="overflow: hidden;">
                                            <a href="/contact" class="d-block wid100 fontSize34px blackKsb boldEight text-center">PLACE YOUR ADVERTISEMENT HERE</a>
                                        </div> -->
        <div class="mx-auto m-2 wid80 wid100Mobile d-block higt125px" style="overflow: hidden;">
            <a href="#"><img src="{{ asset('icons/longBanner.gif') }}" class="wid100" alt=""></a>
        </div>
    @endisset
    <div class="d-block wid70 wid100Mobile mx-auto">
        <p class="fontSize24px ksbNewsGrey boldEight">{{ $news->newstitle }}</p>
        <p class="fontSize14px ksbNewsGreyLight boldFour">{{ date('M d,Y', strtotime($news->created_at)) }}</p>
        <div class="newsImageTwo">
            <img src="{{ asset('files/' . $news->name) }}" alt="" class="wid100">
        </div>
        <p class="fontSize14px lh-lg ksbNewsGreyLight boldFour mt-5">{{ $news->newsbody }}</p>
    </div>
    <!-- Modal markup -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img src="{{ asset('icons/telegramModal.gif') }}" class="wid100 pointers" alt="Image"
                        onclick="location.href='https://t.me/+BWWg98ga2RZmMjVk'">
                </div>
            </div>
        </div>
    </div>

</main>
@extends('layouts/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"
    integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
    integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
</script>
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
