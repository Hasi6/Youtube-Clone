function subscribe(userTo, userFrom, button) {

    if (userTo === userFrom) {
        alert("Can't Subscribe Your Self");
        return;
    }

    $.post("ajax/subscribe.php")
        .done(function() {
            console.log("done");
        });
}