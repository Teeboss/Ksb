<script>
    $(document).on("submit", "#handleAjaxLogin", () => {
        var e = this;
        $(this).find('input[type="submit"]').html('Loging in...');
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: "POST",
            dataType: 'json',
            success: (data) => {
                if (data.status) {
                    location.reload();
                    alert('login successful')
                    $(this).find('input[type="submit"]').html('Loging in...');
                } else {
                    $.each(data.errors, (key, value) => {
                        $("#errors-list-login").append("<div class='alert alert-danger'>" + val + "</div>");
                    })
                }
            }
        })
        return false;
    })


    $(function() {

        /*------------------------------------------
        --------------------------------------------
        Submit Event
        --------------------------------------------
        --------------------------------------------*/
        $(document).on("submit", "#handleAjax", function() {
            var e = this;

            $(this).find("[type='submit']").html("Login...");

            $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $(e).find("[type='submit']").html("Login");

                    if (data.status) {
                        window.location = data.redirect;
                    } else {
                        $(".alert").remove();
                        $.each(data.errors, function(key, val) {
                            $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                        });
                    }

                }
            });

            return false;
        });

    });
</script>