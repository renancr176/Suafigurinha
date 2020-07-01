$(document).ready(function(){
    var album = {};
    var pageElements = [];

    function loadAlbum(albumId, handler)
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

    function destroyPageElements()
    {
        $('[data-toggle="tooltip"]').tooltip('dispose');
        $.each(pageElements, function(){
            this.remove();
        });
        pageElements = [];
    }

    function generateTextElement(pageId, textObj)
    {
        var textElementStyle = 'style="'+
        'width: '+textObj.width+'mm;'+
        'margin-left: '+textObj.x_position+'mm;'+
        'margin-top: '+textObj.y_position+'mm;'+
        'transform: rotate('+textObj.rotation+'deg);'+
        '"';
        var inputStyle = 'style="'+
        'width: '+textObj.width+'mm;'+
        'color: '+textObj.color+';'+
        'text-align: '+textObj.alignment+';'+
        'font-size: '+textObj.font_size+'px;'+
        'font-family: '+textObj.font.title+';'+
        '"';
        var textElement = $('<div class="input-container" '+textElementStyle+'></div>');
        var input = $('<input name="texts['+pageId+']['+textObj.id+']" value="'+textObj.text+'" id="text-'+textObj.id+'" type="text" placeholder="Informe o texto" '+inputStyle+'/>');
        var buttons = $(
            '<div class="btn-group" role="group">'+
            '<button type="button" class="btn btn-info btn-change-text" ref="text-'+textObj.id+'" data-toggle="tooltip" data-placement="bottom" title="Alterar o texto"><i class="far fa-edit"></i></button>'+
            '</div>'
        );
        textElement.append(input);
        textElement.append(buttons);
        return textElement;
    }

    function setPageElements(pageId)
    {
        destroyPageElements();

        if(page = album.pages.find(x => x.id == pageId))
        {
            $.each(page.photos, function(k, photoObj){
                console.log(photoObj);
            });

            $.each(page.backgrounds, function(k, backgroudObj){
                console.log(backgroudObj);
            });

            $.each(page.texts, function(k, textObj){
                console.log(text);
                var textElement = generateTextElement(pageId, textObj);
                if(jQuery.inArray(textElement, pageElements) == -1)
                {
                    $(".album-pages-container .fotorama__stage").append(textElement);
                    pageElements.push(textElement);
                }
            });
        }
        $('[data-toggle="tooltip"]').tooltip();
    }

    loadAlbum($(".album-pages-container").attr("albumid"), function(res){
        album = res;
        if(album.pages.length > 0)
            setPageElements(album.pages[0].id);
    });

    $('.fotorama').on('fotorama:show', function (e, fotorama, extra) {
        setPageElements(fotorama.activeFrame.id);
    });

    $('.album-pages-container').on('click', '.btn-change-text', function(){
        $('input#'+$(this).attr('ref')).val('');
        $('input#'+$(this).attr('ref')).focus();
    });

    $('.album-pages-container').on('keypress', '.input-container input', function(event){
        if(event.which == 13){
            $(this).blur();
        }
    });
});
