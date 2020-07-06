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

    function getAddressByZipcode(zipcode, handler)
    {
        $.ajax({
            url: "https://viacep.com.br/ws/"+removeNonDigits(zipcode)+"/json/",
            method: "GET",
            dataType: "json",
            success: function(res){
                handler(res);
            }
        });
    }
    //#endregion

    //#region Functions
    function readFile(input, pluginContainer) {
        if (input.files && input.files[0])
        {
            var reader = new FileReader();

            reader.onload = function (e) {
                pluginContainer.croppie('bind', {
                    url: e.target.result
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

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
        let input = $('<input name="texts['+pageId+']['+textObj.id+']" value="'+textObj.text+'" id="text-'+textObj.id+'" class="album-data" type="text" placeholder="Informe o texto" '+inputStyle+'/>');
        let controls = $(
            '<div class="controls-'+textObj.controls_position+'">'+
                '<div class="'+((textObj.controls_position == 'left' || textObj.controls_position == 'right')? 'btn-group-vertical':'btn-group')+'" role="group">'+
                    '<button type="button" class="btn btn-info btn-change-text" ref="text-'+textObj.id+'" data-toggle="tooltip" data-placement="'+tooltipPlacement(textObj.controls_position)+'" title="Alterar o texto"><i class="far fa-edit"></i></button>'+
                    '<button type="button" class="btn btn-success btn-aplly-text" ref="text-'+textObj.id+'" data-toggle="tooltip" data-placement="'+tooltipPlacement(textObj.controls_position)+'" title="Aplicar" disabled><i class="fas fa-check"></i></button>'+
                '</div>'+
            '</div>'
        );
        textElement.append(input);
        textElement.append(controls);
        textElement.hide();
        return textElement;
    }

    function generateBackgroundElement(pageId, backgroundObj)
    {
        let backgroundElementStyle = 'style="'+
        'left: '+backgroundObj.x_position+'mm;'+
        'top: '+backgroundObj.y_position+'mm;'+
        'transform: rotate('+backgroundObj.rotation+'deg);'+
        'width: '+backgroundObj.width+'mm;'+
        'height: '+backgroundObj.height+'mm;'+
        '"';
        let pluginContainerStyle = 'style="'+
        'width: '+backgroundObj.width+'mm;'+
        'height: '+backgroundObj.height+'mm;'+
        '"';
        let croppieOpts = {
            enableExif: true,
            viewport: {
                width: backgroundObj.width+'mm',
                height: backgroundObj.height+'mm'
            },
            showZoomer: false,
            enableResize: false,
            mouseWheelZoom: false
        };
        let zoomSlideOrientation = ((backgroundObj.controls_position == 'left' || backgroundObj.controls_position == 'right')? 'vertical':'horizontal');

        let backgroundElement = $('<div class="background-container" pageid="'+pageId+'" backgroundid="'+backgroundObj.id+'" '+backgroundElementStyle+'></div>');
        let pluginContainer = $('<div class="plugin-container unloaded" id="background-'+backgroundObj.id+'" '+pluginContainerStyle+'></div>');
        let inputs = $(
            '<input type="file" accept="image/*" class="background-input"/>'+
            '<input type="hidden" name="background['+pageId+']['+backgroundObj.id+']" class="album-data" value="" />'
        );
        let controls = $(
            '<div class="controls-'+backgroundObj.controls_position+' has-zoom">'+
                ((backgroundObj.controls_position == 'bottom' || backgroundObj.controls_position == 'right')? '<div class="zoom-container-'+zoomSlideOrientation+'"><div class="zoom" data-toggle="tooltip" data-placement="'+tooltipPlacement(backgroundObj.controls_position)+'" title="Zoom"></div></div>':'')+
                '<div class="'+((backgroundObj.controls_position == 'left' || backgroundObj.controls_position == 'right')? 'btn-group-vertical':'btn-group')+'" role="group">'+
                    '<button type="button" class="btn btn-info btn-upload-background" ref="background-'+backgroundObj.id+'" data-toggle="tooltip" data-placement="'+tooltipPlacement(backgroundObj.controls_position)+'" title="Carregar imagem"><i class="fas fa-upload"></i></button>'+
                    '<button type="button" class="btn btn-warning btn-undo-background" ref="background-'+backgroundObj.id+'" data-toggle="tooltip" data-placement="'+tooltipPlacement(backgroundObj.controls_position)+'" title="Desfazer" disabled><i class="fas fa-undo"></i></button>'+
                    '<button type="button" class="btn btn-success btn-apply-background" ref="background-'+backgroundObj.id+'" data-toggle="tooltip" data-placement="'+tooltipPlacement(backgroundObj.controls_position)+'" title="Aplicar" disabled><i class="fas fa-check"></i></button>'+
                '</div>'+
                ((backgroundObj.controls_position == 'top' || backgroundObj.controls_position == 'left')? '<div class="zoom-container-'+zoomSlideOrientation+'"><div class="zoom" data-toggle="tooltip" data-placement="'+tooltipPlacement(backgroundObj.controls_position)+'" title="Zoom"></div></div>':'')+
            '</div>'
        );
        let viewElement = $('<img class="base-view" pageid="'+pageId+'" '+backgroundElementStyle+'/>');

        backgroundElement.append(pluginContainer);
        backgroundElement.append(inputs);
        backgroundElement.append(controls);
        backgroundElement.append(viewElement);
        controls.find('.btn-undo-background').hide();
        zoomSlider(controls.find('.zoom'), zoomSlideOrientation);
        pluginContainer.croppie(croppieOpts);
        backgroundElement.hide();
        return backgroundElement;
    }

    function generatePhotoElement(pageId, photoObj)
    {
        let photoElementStyle = 'style="'+
        'left: '+photoObj.x_position+'mm;'+
        'top: '+photoObj.y_position+'mm;'+
        'transform: rotate('+photoObj.rotation+'deg);'+
        'width: '+photoObj.frame_type.width+'mm;'+
        'height: '+photoObj.frame_type.height+'mm;'+
        '"';
        let pluginContainerStyle = 'style="'+
        'width: '+photoObj.frame_type.width+'mm;'+
        'height: '+photoObj.frame_type.height+'mm;'+
        '"';
        let croppieOpts = {
            enableExif: true,
            viewport: {
                width: photoObj.frame_type.width+'mm',
                height: photoObj.frame_type.height+'mm'
            },
            showZoomer: false,
            enableResize: false,
            mouseWheelZoom: false
        };
        let zoomSlideOrientation = ((photoObj.controls_position == 'left' || photoObj.controls_position == 'right')? 'vertical':'horizontal');

        let photoElement = $('<div class="photo-container" pageid="'+pageId+'" photoid="'+photoObj.id+'" '+photoElementStyle+'></div>');
        let pluginContainer = $('<div class="plugin-container unloaded" id="photo-'+photoObj.id+'" '+pluginContainerStyle+'></div>');
        let inputs = $(
            '<input type="file" accept="image/*" class="photo-input"/>'+
            '<input type="hidden" name="photo['+pageId+']['+photoObj.id+']" class="album-data" value="" />'
        );
        let controls = $(
            '<div class="controls-'+photoObj.controls_position+' has-zoom">'+
                ((photoObj.controls_position == 'bottom' || photoObj.controls_position == 'right')? '<div class="zoom-container-'+zoomSlideOrientation+'"><div class="zoom" data-toggle="tooltip" data-placement="'+tooltipPlacement(photoObj.controls_position)+'" title="Zoom"></div></div>':'')+
                '<div class="'+((photoObj.controls_position == 'left' || photoObj.controls_position == 'right')? 'btn-group-vertical':'btn-group')+'" role="group">'+
                    '<button type="button" class="btn btn-info btn-upload-photo" ref="photo-'+photoObj.id+'" data-toggle="tooltip" data-placement="'+tooltipPlacement(photoObj.controls_position)+'" title="Carregar imagem"><i class="fas fa-upload"></i></button>'+
                '</div>'+
                ((photoObj.controls_position == 'top' || photoObj.controls_position == 'left')? '<div class="zoom-container-'+zoomSlideOrientation+'"><div class="zoom" data-toggle="tooltip" data-placement="'+tooltipPlacement(photoObj.controls_position)+'" title="Zoom"></div></div>':'')+
            '</div>'
        );

        photoElement.append(pluginContainer);
        photoElement.append(inputs);
        photoElement.append(controls);
        controls.find('.btn-undo-photo').hide();
        zoomSlider(controls.find('.zoom'), zoomSlideOrientation);
        pluginContainer.croppie(croppieOpts);
        pluginContainer.on('update.croppie', photoUpdate);
        photoElement.hide();
        return photoElement;
    }

    function loadPagesElements(albumObj)
    {
        $.each(albumObj.pages, function(k, pageObj){
            pagesElements[pageObj.id] = [];
            pagesElements[pageObj.id]['texts'] = [];
            pagesElements[pageObj.id]['photos'] = [];
            pagesElements[pageObj.id]['backgrounds'] = [];

            $.each(pageObj.photos, function(k, photoObj){
                let photoElement = generatePhotoElement(pageObj.id, photoObj);
                addElement(photoElement);
                pagesElements[pageObj.id]['photos'].push(photoElement);
            });

            $.each(pageObj.backgrounds, function(k, backgroundObj){
                let backgroundElement = generateBackgroundElement(pageObj.id, backgroundObj);
                addElement(backgroundElement);
                pagesElements[pageObj.id]['backgrounds'].push(backgroundElement);
            });

            $.each(pageObj.texts, function(k, textObj){
                let textElement = generateTextElement(pageObj.id, textObj);
                addElement(textElement);
                pagesElements[pageObj.id]['texts'].push(textElement);
            });
        });
        $('[data-toggle="tooltip"]').tooltip();
    }

    function addElement(element)
    {
        $(".album-pages-container .fotorama__stage").append(element);
    }

    function hidePageElements(pageId)
    {
        if(pageId in pagesElements)
        {
            $('.view[pageid="'+pageId+'"]').hide();

            $.each(pagesElements[pageId]['texts'], function(){
                $(this).hide();
            });

            $.each(pagesElements[pageId]['photos'], function(){
                $(this).hide();
            });

            $.each(pagesElements[pageId]['backgrounds'], function(){
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
                $('.view[pageid="'+pageId+'"]').show();

                $.each(pagesElements[pageId]['texts'], function(){
                    $(this).show();
                });

                $.each(pagesElements[pageId]['photos'], function(){
                    $(this).show();
                });

                $.each(pagesElements[pageId]['backgrounds'], function(){
                    $(this).show();
                });
            }
            lastPageId = pageId;
        }
    }

    function zoomSlider(element, orientation)
    {
        element.slider({
            disabled: true,
            min: 20,
            orientation: orientation,
            slide: zoomSlideHandler
        });
    }

    function zoomSlideHandler(event, ui)
    {
        var container = $(this).closest('.background-container, .photo-container').find('.plugin-container');
        if(container.length == 1)
        {
            container.croppie('setZoom', (ui.value/100));
        }
    }

    function photoUpdate(ev, cropData)
    {
        let photoContainer = getPhotoContainer($(this));
        $(this).croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            console.log(resp);
            photoContainer.find('.album-data').val(resp);
        });
    }

    function enableBtn(btnElement)
    {
        btnElement.removeAttr('disabled');
    }

    function disableBtn(btnElement)
    {
        btnElement.attr('disabled', 'disabled');
        btnElement.tooltip('hide');
    }

    function showBtn(btnElement)
    {
        enableBtn(btnElement);
        btnElement.show();
    }

    function hideBtn(btnElement)
    {
        disableBtn(btnElement);
        btnElement.hide();
    }

    function enableZoom(slideElement)
    {
        slideElement.slider("option", "disabled", false);
    }

    function disableZoom(slideElement)
    {
        slideElement.slider("option", "disabled", true);
        slideElement.tooltip('hide');
    }

    function getBackgroundContainer(childElement)
    {
        return childElement.closest('.background-container');
    }

    function getBackgroundPluginContainer(childElement)
    {
        return getBackgroundContainer(childElement).find('.plugin-container');
    }

    function undoBackground(backgroundContainer)
    {
        let btnUndo = backgroundContainer.find('.btn-undo-background');
        let btnApply = backgroundContainer.find('.btn-apply-background');

        btnApply.insertAfter(btnUndo);

        backgroundContainer.find('.cr-boundary').show();
        hideBtn(btnUndo);
        showBtn(btnApply);
        enableZoom(backgroundContainer.find('.zoom'));

    }

    function getPhotoContainer(childElement)
    {
        return childElement.closest('.photo-container');
    }

    function getPhotoPluginContainer(childElement)
    {
        return getPhotoContainer(childElement).find('.plugin-container');
    }

    function undoPhoto(photoContainer)
    {
        let btnUndo = photoContainer.find('.btn-undo-background');
        let btnApply = photoContainer.find('.btn-apply-background');

        btnApply.insertAfter(btnUndo);

        photoContainer.find('.cr-boundary').show();
        hideBtn(btnUndo);
        showBtn(btnApply);
        enableZoom(photoContainer.find('.zoom'));

    }

    function removeNonDigits(text)
    {
        return text.replace( /\D+/g, '');
    }

    function changePhoneMask()
    {
        phoneNum = removeNonDigits($(this).val());
        $(this).unmask();
        $(this).val(phoneNum);
        if(phoneNum.length == 10)
        {
            $(this).mask('(99) 9999-9999?9');
        }
        else if(phoneNum.length == 11)
        {
            $(this).mask('(99) 99999-999?9');
        }
    }

    function setAddressHandler(addressObj)
    {
        var form = $('.form');
        form.find('#state').val(addressObj.uf.toUpperCase());
        form.find('#city').val(addressObj.localidade);
        form.find('#district').val(addressObj.bairro);
        form.find('#address').val(addressObj.logradouro);
        form.find('#address-number').focus();
    }
    //#endregion

    //#region Init
    getAlbum($(".album-pages-container").attr("albumid"), function(res){
        albumObj = res;
        //console.log(albumObj);
        if(albumObj.pages.length > 0)
        {
            loadPagesElements(albumObj);
            showPageElements(albumObj.pages[0].id);
        }
    });

    $('.zipcode').mask('99999-999', {
        completed: function(){
            getAddressByZipcode(this.val(), setAddressHandler);
        }
    });
    $('.phone').mask('(99) 9999-9999?9').change(changePhoneMask);
    //#endregion

    //#region Event Handlers

    //#region Steps
    $('.step').click(function(){
        let stepNum = $(this).attr('step');
        $('.step-content').removeClass('active');
        $('#step-'+stepNum+'-content').addClass('active');
    });
    //#endregion

    $('.fotorama').on('fotorama:show', function (e, fotorama, extra) {
        showPageElements(fotorama.activeFrame.id);
    });

    //#region Text Element Controls

    $('.album-pages-container').on('click', '.btn-change-text', function(){
        $('input#'+$(this).attr('ref')).val('');
        $('input#'+$(this).attr('ref')).focus();
        enableBtn($(this).closest('.input-container').find('.btn-aplly-text'));
    });

    $('.album-pages-container').on('click', '.btn-aplly-text', function(){
        $('input#'+$(this).attr('ref')).blur();
        disableBtn($(this));
    });

    $('.album-pages-container').on('keypress', '.input-container input', function(event){
        if(event.which == 13){
            $(this).blur();
            disableBtn($(this).closest('.input-container').find('.btn-aplly-text'));
        }
    });

    //#endregion

    //#region Background Element Controls
    $('.album-pages-container').on('click', '.btn-upload-background', function(){
        let backgroundContainer = getBackgroundContainer($(this));
        backgroundContainer.find('.background-input').trigger('click');
        undoBackground(backgroundContainer);
    });

    $('.album-pages-container').on('change', '.background-input', function(){
        let pluginContainer = getBackgroundPluginContainer($(this));
        let backgroundContainer = getBackgroundContainer($(this));
        pluginContainer.removeClass('unloaded');

        readFile(this, pluginContainer);
        enableBtn(backgroundContainer.find('.btn-apply-background'));
        enableZoom(backgroundContainer.find('.zoom'));
    });

    $('.album-pages-container').on('click', '.btn-apply-background', function(){
        let thisBtn = $(this);
        let pluginContainer = getBackgroundPluginContainer(thisBtn);
        let backgroundContainer = getBackgroundContainer(thisBtn);
        pluginContainer.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            console.log(resp);
            pluginContainer.find('.cr-boundary').hide();
            backgroundContainer.find('.album-data').val(resp);
            let container = thisBtn.closest('.fotorama__stage');
            let ref = thisBtn.attr('ref');
            let view = backgroundContainer.find('.base-view').clone().attr('id', ref)
            .removeClass('base-view').addClass('view')
            .attr('src', resp);
            if(container.find('.view#'+ref).length > 0)
                container.find('.view#'+ref).replaceWith(view);
            else
                container.prepend(view);
        });

        disableZoom(backgroundContainer.find('.zoom'));
        backgroundContainer.find('.btn-undo-background').insertAfter(thisBtn);
        hideBtn(thisBtn);
        showBtn(backgroundContainer.find('.btn-undo-background'));
    });

    $('.album-pages-container').on('click', '.btn-undo-background', function(){
        undoBackground(getBackgroundContainer($(this)));
    });
    //#endregion

    //#region Photo Element Controls
    $('.album-pages-container').on('click', '.btn-upload-photo', function(){
        let photoContainer = getPhotoContainer($(this));
        photoContainer.find('.photo-input').trigger('click');
        undoPhoto(photoContainer);
    });

    $('.album-pages-container').on('change', '.photo-input', function(){
        let pluginContainer = getPhotoPluginContainer($(this));
        let photoContainer = getPhotoContainer($(this));
        pluginContainer.removeClass('unloaded');

        readFile(this, pluginContainer);
        enableBtn(photoContainer.find('.btn-apply-photo'));
        enableZoom(photoContainer.find('.zoom'));
    });
    //#endregion

    $('#client-name').focusout(function(){
        console.log($('#receiver-name').length);
        if($(this).val() != '' && $('#receiver-name').val() == '')
            $('#receiver-name').val($(this).val());
    });
    //#endregion
});
