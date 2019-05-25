function likeVideo(button, videoId) {
    $.post("Ajax/likeVideo.php", { videoId: videoId })
        .done(function(data) {

            var likeButton = $(button);
            var dislikeButton = $(button).siblings(".DislikeButton");

            likeButton.addClass("active");
            dislikeButton.removeClass("active");
        });
}