function likeVideo(button, videoId) {
    $.post("Ajax/likeVideo.php", { videoId: videoId })
        .done(function(data) {

            var likeButton = $(button);
            var dislikeButton = $(button).siblings(".DislikeButton");

            likeButton.addClass("active");
            dislikeButton.removeClass("active");

            var results = JSON.parse(data);
            updateLikesValue(likeButton.find(".text"), results.likes);

            updateLikesValue(dislikeButton.find(".text"), results.dislikes);
        });
}

function updateLikesValue(element, num) {
    var likesCountVal = element.text() || 0;
    element.text(parseInt(likesCountVal) + parseInt(num));
}