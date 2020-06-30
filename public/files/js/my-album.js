$(document).ready(function(){
    var album = {};

    function loadElements(albumId, handler)
    {
        $.ajax({
            url: "/api/album/"+albumId,
            method: "GET",
            dataType: "json",
            success: function(res){
                handler(res);
            }
        });
    }

    function setPageElements(pageId){
        console.log(pageId);
    }

    loadElements($(".album-pages-container").attr("albumid"), function(res){
        album = res;
        if(album.pages.length > 0)
            setPageElements(album.pages[0].id);
    });

    $('.fotorama').on('fotorama:show', function (e, fotorama, extra) {
        setPageElements(fotorama.activeFrame.id);
    });
});
