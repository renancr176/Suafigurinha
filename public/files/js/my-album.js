$(document).ready(function(){
    //#region Global
    var albumObj = {};
    var pagesElements = [];
    var lastPageId = null;
    //#endregion

    //#region Api requests
    function getAlbum(albumId, handler)
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
    //#endregion

    //#region Functions
    function tooltipPlacement(placement)
    {
        switch(placement)
        {
            case 'top':
                return 'bottom';
            case 'bottom':
                return 'top';
            case 'left':
                return 'right';
            case 'right':
                return 'left';
            default:
                return 'bottom';
        }
    }

    function generateTextElement(pageId, textObj)
    {
        let textElementStyle = 'style="'+
        'width: '+textObj.width+'mm;'+
        'left: '+textObj.x_position+'mm;'+
        'top: '+textObj.y_position+'mm;'+
        'transform: rotate('+textObj.rotation+'deg);'+
        '"';
        let inputStyle = 'style="'+
        'width: '+textObj.width+'mm;'+
        'color: '+textObj.color+';'+
        'text-align: '+textObj.alignment+';'+
        'font-size: '+textObj.font_size+'pt;'+
        'font-family: '+textObj.font.title+';'+
        '"';
        let textElement = $('<div class="input-container" '+textElementStyle+' pageid="'+pageId+'" textid="'+textObj.id+'"></div>');
        let input = $('<input name="texts['+pageId+']['+textObj.id+']" value="'+textObj.text+'" id="text-'+textObj.id+'" type="text" placeholder="Informe o texto" '+inputStyle+'/>');
        let buttons = $(
            '<div class="controls-'+textObj.controls_position+'">'+
                '<div class="'+((textObj.controls_position == 'left' || textObj.controls_position == 'right')? 'btn-group-vertical':'btn-group')+'" role="group">'+
                    '<button type="button" class="btn btn-info btn-change-text" ref="text-'+textObj.id+'" data-toggle="tooltip" data-placement="'+tooltipPlacement(textObj.controls_position)+'" title="Alterar o texto"><i class="far fa-edit"></i></button>'+
                    '<button type="button" class="btn btn-success btn-aplly-text" ref="text-'+textObj.id+'" data-toggle="tooltip" data-placement="'+tooltipPlacement(textObj.controls_position)+'" title="Aplicar" disabled><i class="fas fa-check"></i></button>'+
                '</div>'+
            '</div>'
        );
        textElement.append(input);
        textElement.append(buttons);
        textElement.hide();
        return textElement;
    }

    function generateBackgroundElement(pageId, backgroundObj)
    {
        let diffWorkSpace = 10;
        let containerWidth = (parseInt(backgroundObj.width, 10) + (diffWorkSpace * 2));
        let containerHeight = (parseInt(backgroundObj.height, 10) + (diffWorkSpace * 2));
        let backgroudElementStyle = 'style="'+
        'left: '+(backgroundObj.x_position - diffWorkSpace)+'mm;'+
        'top: '+(backgroundObj.y_position - diffWorkSpace)+'mm;'+
        'transform: rotate('+backgroundObj.rotation+'deg);'+
        '"';
        let croppieOpts = {
            viewport: {
                width: containerWidth+'mm',
                height: containerHeight+'mm'
            },
            boundary: {
                width: backgroundObj.width+'mm',
                height: backgroundObj.height+'mm'
            }
        };

        let backgroundElement = $('<div class="background-container" pageid="'+pageId+'" backgroundid="'+backgroundObj.id+'" '+backgroudElementStyle+'></div>');
        let pluginContainer = $('<div class="plugin-container" id="background-'+backgroundObj.id+'" style="width: '+containerWidth+'mm; height: '+containerHeight+'mm; padding: '+diffWorkSpace+'mm;"></div>');

        let buttons = $(
            '<div class="controls-'+backgroundObj.controls_position+'">'+
                '<div class="'+((backgroundObj.controls_position == 'left' || backgroundObj.controls_position == 'right')? 'btn-group-vertical':'btn-group')+'" role="group">'+
                    '<button type="button" class="btn btn-success btn-upload-background" ref="background-'+backgroundObj.id+'" data-toggle="tooltip" data-placement="'+tooltipPlacement(backgroundObj.controls_position)+'" title="Carregar imagem"><i class="fas fa-upload"></i></button>'+
                    '<button type="button" class="btn btn-info btn-view-background" ref="background-'+backgroundObj.id+'" data-toggle="tooltip" data-placement="'+tooltipPlacement(backgroundObj.controls_position)+'" title="Aplicar e vizualisar" disabled><i class="fas fa-eye"></i></button>'+
                '</div>'+
            '</div>'
        );
        backgroundElement.append(pluginContainer);
        backgroundElement.append(buttons);
        pluginContainer.croppie(croppieOpts);
        backgroundElement.hide();
        return backgroundElement;
    }

    function loadPagesElements(albumObj)
    {
        $.each(albumObj.pages, function(k, pageObj){
            pagesElements[pageObj.id] = [];
            pagesElements[pageObj.id]['texts'] = [];
            pagesElements[pageObj.id]['photos'] = [];
            pagesElements[pageObj.id]['backgrouds'] = [];

            $.each(pageObj.photos, function(k, photoObj){
                //console.log(photoObj);
                //pagesElements[pageObj.id]['photos'].push();
            });

            $.each(pageObj.backgrounds, function(k, backgroudObj){
                //console.log(backgroudObj);
                let backgroudElement = generateBackgroundElement(pageObj.id, backgroudObj);
                $(".album-pages-container .fotorama__stage").append(backgroudElement);
                pagesElements[pageObj.id]['backgrouds'].push(backgroudElement);
            });

            $.each(pageObj.texts, function(k, textObj){
                //console.log(textObj);
                let textElement = generateTextElement(pageObj.id, textObj);
                $(".album-pages-container .fotorama__stage").append(textElement);
                pagesElements[pageObj.id]['texts'].push(textElement);
            });
        });
        $('[data-toggle="tooltip"]').tooltip();
        console.log(pagesElements);
    }

    function hidePageElements(pageId)
    {
        if(pageId in pagesElements)
        {
            $.each(pagesElements[pageId]['texts'], function(){
                $(this).hide();
            });

            $.each(pagesElements[pageId]['photos'], function(){
                //$(this).hide();
            });

            $.each(pagesElements[pageId]['backgrouds'], function(){
                $(this).hide();
            });
        }
    }

    function showPageElements(pageId)
    {
        if(lastPageId != pageId)
        {
            if(lastPageId != null)
                hidePageElements(lastPageId);

            if(pageId in pagesElements)
            {
                $.each(pagesElements[pageId]['texts'], function(){
                    $(this).show();
                });

                $.each(pagesElements[pageId]['photos'], function(){
                    //$(this).show();
                });

                $.each(pagesElements[pageId]['backgrouds'], function(){
                    $(this).show();
                });
            }
            lastPageId = pageId;
        }
    }

    function disableBtnApllyText(btnElement)
    {
        btnElement.attr('disabled', 'disabled');
        btnElement.tooltip('hide');
    }
    //#endregion

    getAlbum($(".album-pages-container").attr("albumid"), function(res){
        albumObj = res;
        //console.log(albumObj);
        if(albumObj.pages.length > 0)
        {
            loadPagesElements(albumObj);
            showPageElements(albumObj.pages[0].id);
        }
    });

    //#region Event Handlers
    $('.fotorama').on('fotorama:show', function (e, fotorama, extra) {
        showPageElements(fotorama.activeFrame.id);
    });

    $('.album-pages-container').on('click', '.btn-change-text', function(){
        $('input#'+$(this).attr('ref')).val('');
        $('input#'+$(this).attr('ref')).focus();
        $(this).closest('.input-container').find('.btn-aplly-text').removeAttr('disabled');
    });

    $('.album-pages-container').on('click', '.btn-aplly-text', function(){
        $('input#'+$(this).attr('ref')).blur();
        disableBtnApllyText($(this).closest('.input-container').find('.btn-aplly-text'));
    });

    $('.album-pages-container').on('keypress', '.input-container input', function(event){
        if(event.which == 13){
            $(this).blur();
            disableBtnApllyText($(this).closest('.input-container').find('.btn-aplly-text'));
        }
    });

    $('.album-pages-container').on('click', '.btn-upload-background', function(){

    });

    //#endregion
});
