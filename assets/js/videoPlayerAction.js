function likeVideo(button, videoid) {
    $.post("Ajax/likeVideo.php")
        .done(function(data) {
            alert(data);
        });
}