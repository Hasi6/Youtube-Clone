function postComment(button, postedBy, videoId, replyTo, containerClass) {
    var textarea = $(button).siblings("textarea");
    var commentText = textarea.val();
    textarea.val("");

    if (commentText) {

        $.post("ajax/postComment.php", { commentText: commentText, postedBy: postedBy, videoId: videoId, responseTo: replyTo })
            .done((comment) => {

                $("." + containerClass).prepend(comment);

            });

    } else {
        alert("You can't Post Empty Comment");
    }
}

function toggleReply(button) {
    var parent = $(button).closest(".itemContainer");
    var commentForm = parent.find(".commentForm").first();

    commentForm.toggleClass("hidden");
}

function likeComment(commentId, button, videoId) {
    $.post("Ajax/likeComment.php", { commentId: commentId, videoId: videoId })
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

function dislikeComment(commentId, button, videoId) {

}