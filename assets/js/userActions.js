function subscribe(userTo, userFrom, button) {

    if (userTo === userFrom) {
        alert("Can't Subscribe Your Self");
        return;
    }

    $.post("Ajax/subscribe.php", { userTo: userTo, userFrom: userFrom })
        .done(function(count) {

            if (count != null) {
                $(button).toggleClass("subscribe unsubscribe");

                if ($(button).hasClass("subscribe")) {
                    var buttonText = "SUBSCRIBE";
                } else {
                    var buttonText = "SUBSCRIBED";
                }
                $(button).text(buttonText + " " + count);
            } else {
                alert("Some thing went Wrong");
            }
        });
}