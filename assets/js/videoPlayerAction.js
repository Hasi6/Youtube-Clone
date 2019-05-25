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

            if (results.likes < 0) {
                likeButton.removeClass("active");
                likeButton.find("img:first").attr("src", "assets/images/icons/thumb-up.png");
            } else {
                likeButton.find("img:first").attr("src", "assets/images/icons/thumb-up-active.png");
            }

            dislikeButton.find("img:first").attr("src", "assets/images/icons/thumb-down.png");
        });
}

function updateLikesValue(element, num) {
    var likesCountVal = element.text() || 0;
    element.text(parseInt(likesCountVal) + parseInt(num));
}