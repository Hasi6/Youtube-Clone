function setNewThumbnail(thumbnailId, videoId, itemElement) {
    $.post("./Ajax/updateThumbnail.php", { videoId: videoId, thumbnailId: thumbnailId })
        .done(function() {

        });
}