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
    <div class="mx-auto d-block mt-md-1 mt-3 wid90 wid100Mobile bgLinearBlue p-4 p-sm-5 mb-3 rounded-2 rounded-sm-5">
        <div class="d-flex flex-wrap">
            <div class="col-md-8">
                <span class="boldFour white fontSize10px boldFour text-center d-block">24/7 sport bet Predictions. happy
                    customer</span>
                <span class="fontSize44px white boldSeven my-3">Join Our VIP Channel and get Premium TIP that will make
                    you over $500 monthly.</span>
                <span class="fontSize18px boldFive white d-block my-3">Get VIP tips from our expert punters, VIP
                    rollovers on all events across selected bookies. It takes 2 min to join,No experience is needed,24/7
                    support.</span>
                {{-- <div class="wid40 wid100Mobile d-flex" id="paymentButtons">
                    <a href="https://paystack.com/pay/kgsb-vip"
                        class="bgLinearGreen wid-40 wid-50-mobile text-decoration-none p-2 fontSize16px boldThree rounded-5 d-block text-center mb-3">Nigeria</a>
                    <a
                        class="bgLinearWorld wid-40 wid-50-mobile text-decoration-none p-2 fontSize16px boldThree rounded-5 d-block text-center mb-3">Africa</a>
                </div> --}}
                <div class="wid0 cardNgBg">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, fugit accusamus harum iusto dicta
                    veniam illo obcaecati culpa maiores odit magni quaerat magnam neque autem laboriosam, porro
                    distinctio explicabo aliquam.
                </div>
                <a href="https://paystack.com/pay/kgsb-vip"
                    class="bgLinearGreen wid-40 wid-50-mobile text-decoration-none p-2 fontSize14px boldThree rounded-5 d-block text-center mb-3">Start
                    Making Money with Us Naija !</a>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                    class="bgLinearWorld wid-40 wid-50-mobile text-decoration-none p-2 fontSize14px boldThree rounded-5 d-block text-center mb-3">Click
                    here if you're outside Nigeria</button>

                <a href="/" class="fontSize16px boldFour white text-decoration-none d-inline-block ms-3">Head back
                    to our Home page</a>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Make Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm">
                        <div class="row">
                            <div class="col" style="margin-bottom: 10px;">
                                <label for="phone-number" class="fontSize14px boldSix">Phone Number</label>
                                <input type="tel" id="phone-number" class="form-control" required />
                            </div>
                            <div class="col" style="margin-bottom: 10px;">
                                <label for="email" class="fontSize14px boldSix">Email</label>
                                <input type="email" id="email" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="amount" class="fontSize14px boldSix">Amount</label>
                            <input type="number" id="amount" class="form-control" required />
                        </div>
                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="first-name" class="fontSize14px boldSix">First Name</label>
                            <input type="text" id="first-name" class="form-control" />
                        </div>
                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="last-name" class="fontSize14px boldSix">Last Name</label>
                            <input type="text" id="last-name" class="form-control" />
                        </div>
                        <div class="form-submit">
                            <button type="submit"
                                class="bgLinearGreen wid100 wid-50-mobile text-decoration-none p-2 fontSize16px boldSeven rounded-5 d-block text-center mb-3">
                                Pay </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fontSize14px boldSix"
                        data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
</main>
@extends('layouts/footer')
<script src="https://bani-assets.s3.eu-west-2.amazonaws.com/static/widget/js/window.js" async></script>

{{-- <script src="https://js.paystack.co/v1/inline.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"
    integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
    integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
</script>
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

        $("#paymentButtons").hide();

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


        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener('submit', (e) => payWithBani(e), false);

        function payWithBani(e) {
            e.preventDefault()

            let handler = BaniPopUp({
                amount: document.getElementById('amount').value, //The amount the customer wants to pay
                phoneNumber: document.getElementById('phone-number')
                    .value, //The mobile number of the customer in int format i.e +2348173709000
                email: document.getElementById('email').value, //The email of the customer
                firstName: document.getElementById('first-name').value, //The first name of the customer
                lastName: document.getElementById('last-name').value, //The last name of the customer
                merchantKey: "pub_prod_FHEC2H7XG124T54W62EVCPE1J71V2S", //The merchant Bani public key
                metadata: "", //Custom JSON object passed by the merchant. This is optional
                merchantRef: "", //Custom payment reference passed by the merchant. This is optional
                onClose: (response) => {
                    console.log("ONCLOSE DATA", response)
                },
                callback: function(response) {
                    let message = 'Payment complete! Reference: ' + response?.reference
                    location.replace('/payday')
                    console.log(message, response)
                }
            })
            handler
        }
    })
</script>
