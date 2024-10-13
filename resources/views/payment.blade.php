<form id="paymentForm">
    <div class="form-group" style="margin-bottom: 10px;">
        <label for="phone-number">Phone Number</label>
        <input type="tel" id="phone-number" required />
    </div>
    <div class="form-group" style="margin-bottom: 10px;">
        <label for="email">Email</label>
        <input type="email" id="email" required />
    </div>
    <div class="form-group" style="margin-bottom: 10px;">
        <label for="amount">Amount</label>
        <input type="number" id="amount" required />
    </div>
    <div class="form-group" style="margin-bottom: 10px;">
        <label for="first-name">First Name</label>
        <input type="text" id="first-name" />
    </div>
    <div class="form-group" style="margin-bottom: 10px;">
        <label for="last-name">Last Name</label>
        <input type="text" id="last-name" />
    </div>
    <div class="form-submit">
        <button type="submit"> Pay </button>
    </div>
</form>
<!-- JS -->
<script src="https://bani-assets.s3.eu-west-2.amazonaws.com/static/widget/js/window.js" async></script>
<script>
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
            merchantKey: "pub_test_EGB9QD8TQPV0ZD", //The merchant Bani public key
            metadata: "", //Custom JSON object passed by the merchant. This is optional
            merchantRef: "", //Custom payment reference passed by the merchant. This is optional
            onClose: (response) => {
                console.log("ONCLOSE DATA", response)
            },
            callback: function(response) {
                let message = 'Payment complete! Reference: ' + response?.reference
                console.log(message, response)
            }
        })
        handler
    }
</script>
