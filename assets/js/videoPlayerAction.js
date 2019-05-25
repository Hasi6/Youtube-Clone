function likeVideo(button, videoId) {
    $.post("Ajax/likeVideo.php", { videoId: videoId })
        .done(function(data) {
            alert(data)
        });
}