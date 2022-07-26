
$(function() {
    // handle submit event of form
    $(document).on("submit", "#handleAjax", function() {
    var e = this;
    // change login button text before ajax
    $(this).find("[type='submit']").html("LOGIN...");

    $.post($(this).attr('action'), $(this).serialize(), function(data) {

        $(e).find("[type='submit']").html("LOGIN");
        if (data.status) { // If success then redirect to login url
        window.location = data.redirect_location;
        }
    }).fail(function(response) {
        // handle error and show in html
        $(e).find("[type='submit']").html("LOGIN");
        $("#note").remove();
        var erroJson = JSON.parse(response.responseText);
        for (var err in erroJson) {
            for (var errstr of erroJson[err])
                $("#errors-list").append("<div id='note'>" + errstr + "</div>");

        }
    });
    return false;
    });
});


