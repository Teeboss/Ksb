$("#homeId").hide();

const paymentForm = document.getElementById("paymentForm");
paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {
    e.preventDefault();

    let handler = PaystackPop.setup({
        key: "pk_test_2a01b2976eb8068ad54b150a2950838746c569fb", // Replace with your public key
        email: document.getElementById("email").value,
        amount: document.getElementById("amount").value * 100,
        ref: "" + Math.floor(Math.random() * 1000000000 + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        // label: "Optional string that replaces customer email"
        onClose: function () {
            alert("Window closed.");
        },
        callback: function (response) {
            let message = "Payment complete! Reference: " + response.reference;
            alert(message);
        },
    });

    handler.openIframe();
}
