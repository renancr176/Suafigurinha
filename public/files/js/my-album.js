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
    function navStep(stepNum = 1)
    {
        if(stepNum >= 1)
        {
            let previousStep = stepNum-1;
            let stepActive = $('.step.active').attr('step');
            if(previousStep >= 1)
                checkStepCompletation(previousStep);

            let previousStepIsCompleted = $('#step-'+previousStep).hasClass('completed');

            if((stepNum > stepActive && previousStepIsCompleted) || stepNum < stepActive)
            {
                $('.step, .step-content').removeClass('active');
                $('#step-'+stepNum+', #step-'+stepNum+'-content').addClass('active');
            }
            else if(stepNum != stepActive && stepNum > stepActive)
            {
                showToast('<p>'+$('.step:not(.completed):first').attr('alert')+'</p>');
            }
        }
    }

    function checkStepCompletation(stepNum)
    {
        switch(stepNum)
        {
            case 1:
                return checkStep1();
            case 2:
                return checkStep2();
            default:
                return false;
        }
    }

    function checkStep1()
    {
        let valid = true;
        let step1Data = [];
        let alert = [];
        alert['texts'] = [];
        alert['photos'] = [];
        alert['backgrounds'] = [];

        $('#step-1').removeClass('completed');
        $('#step-1-form-content').html('');

        $.each(albumObj.pages, function(k, pageObj){
            $.each(pagesElements[pageObj.id]['texts'], function(k2, text){
                if(text.find('.album-data').val() == '')
                {
                    valid = false;
                    alert['texts'].push(pageObj.sequence);
                    return;
                }

                step1Data.push(text.find('.album-data').clone().removeAttr('style').attr('type', 'hidden'));
            });
            $.each(pagesElements[pageObj.id]['photos'], function(k2, photo){
                if(photo.find('.album-data').val() == '')
                {
                    valid = false;
                    alert['photos'].push(pageObj.sequence);
                    return;
                }

                step1Data.push(photo.find('input.album-data').clone());
            });
            $.each(pagesElements[pageObj.id]['backgrounds'], function(k2, background){
                if(background.find('.album-data').val() == '')
                {
                    valid = false;
                    alert['backgrounds'].push(pageObj.sequence);
                    return;
                }

                step1Data.push(background.find('.album-data').clone());
            });
        });

        if(valid)
        {
            $.each(step1Data, function(k, data){
                $('#step-1-form-content').append(data);
            });

            $('#step-1').addClass('completed');
        }
        else if(alert['texts'].length > 0
        || alert['photos'].length > 0
        || alert['backgrounds'].length > 0)
        {
            let msg = '';
            if(alert['texts'].length > 0)
                msg += '<p>Exitem texto(s) não informados na(s) página(s) '+jQuery.unique(alert['texts']).join(', ')+'.</p>';
            if(alert['photos'].length > 0)
                msg += '<p>Exitem foto(s) não carregada(s) na(s) página(s) '+jQuery.unique(alert['photos']).join(', ')+'.</p>';
            if(alert['backgrounds'].length > 0)
                msg += '<p>Exitem fundo(s) não carregado(s) ou não aplicado(s) na(s) página(s) '+jQuery.unique(alert['backgrounds']).join(', ')+'.</p>';
            showToast(msg);
        }

        return valid;
    }

    function checkStep2()
    {
        let valid = true;
        $('#step-2-form-content').html('');

        $.each($('#step-2-content input[required], #step-2-content select[required]'), function()
        {
            if(!validateField($(this)))
            {
                valid = false;
                return;
            }
        });

        if(valid)
        {
            let formContent = $('#step-2-content').clone();

            formContent.removeAttr('class').removeAttr('id');
            formContent.find('.col-form-label').addClass('col-form-label-sm');
            $.each(formContent.find('input, select'), function(){
                $(this).removeClass('is-valid').addClass('form-control-sm').attr('readonly', 'readonly');
            });

            $('#step-2-form-content').append(formContent);

            $('#step-2').addClass('completed');
        }

        return valid;
    }

    function showToast(body, title = '<strong class="mr-auto">Alerta</strong>')
    {
        let toastElement = $(
        '<div class="toast">'+
            '<div class="toast-header">'+
                '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                '</button>'+
            '</div>'+
            '<div class="toast-body">'+
            '</div>'+
        '</div>'
        );
        toastElement.find('.toast-header').prepend($(title));
        toastElement.find('.toast-body').append($(body));

        $('#toast-container').append(toastElement);

        toastElement.toast({
            delay: 5000
        });
        toastElement.on('hidden.bs.toast', function() {
            $(this).remove();
        });
        toastElement.toast('show');
    }

    function readFile(input, pluginContainer) {
        if (input.files && input.files[0])
        {
            var reader = new FileReader();

            reader.onload = function (e) {
                pluginContainer.croppie('bind', {
                    url: e.target.result
                });

                callBack();
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
        let input = $('<input name="texts['+pageId+']['+textObj.id+']" value="" id="text-'+textObj.id+'" class="album-data" type="text" placeholder="'+textObj.text+'" '+inputStyle+'/>');
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

    function generatePhotoElement(pageId, frameType, photoObj)
    {
        let photoElementStyle = 'style="'+
        'left: '+photoObj.x_position+'mm;'+
        'top: '+photoObj.y_position+'mm;'+
        'transform: rotate('+photoObj.rotation+'deg);'+
        'width: '+frameType.width+'mm;'+
        'height: '+frameType.height+'mm;'+
        '"';
        let pluginContainerStyle = 'style="'+
        'width: '+frameType.width+'mm;'+
        'height: '+frameType.height+'mm;'+
        '"';
        let croppieOpts = {
            enableExif: true,
            viewport: {
                width: frameType.width+'mm',
                height: frameType.height+'mm'
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
                let photoElement = generatePhotoElement(pageObj.id, albumObj.frame_type, photoObj);
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

    function removeNonDigits(text)
    {
        return text.replace( /\D+/g, '');
    }

    function removeNonAlphaNumeric(text)
    {
        return text.replace(/[^a-zA-Z0-9]+/g, '');
    }

    function changePhoneMask()
    {
        phoneNum = removeNonDigits($(this).val());
        $(this).unmask();
        $(this).val(phoneNum);
        if(phoneNum.length == 11)
        {
            $(this).mask('(99) 99999-999?9');
        }
        else
        {
            $(this).mask('(99) 9999-9999?9');
        }

        validateField($(this));
    }

    function setAddressHandler(addressObj)
    {
        var form = $('.form');
        form.find('#state').val(addressObj.uf.toUpperCase()).trigger('focusout').trigger('change');
        form.find('#city').val(addressObj.localidade).trigger('focusout');
        form.find('#district').val(addressObj.bairro).trigger('focusout');
        form.find('#address').val(addressObj.logradouro).trigger('focusout');
        form.find('#address-number').focus();
    }

    function validateField(field)
    {
        if((field.is('input') || field.is('select')) && field.attr('required') != undefined)
        {
            let pattern = field.attr('pattern') != undefined ? new RegExp(field.attr('pattern')) : undefined;

            if(removeNonAlphaNumeric(field.val()).length > 0
            && (pattern == undefined || pattern.test(field.val())))
                field.addClass('is-valid').removeClass('is-invalid');
            else
                field.addClass('is-invalid').removeClass('is-valid');
        }

        return field.hasClass('is-valid');
    }
    //#endregion

    //#region Init
    getAlbum($(".album-pages-container").attr("albumid"), function(res){
        albumObj = res;
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

        navStep(stepNum);
    });
    //#endregion

    $('.fotorama').on('fotorama:show', function (e, fotorama, extra) {
        showPageElements(fotorama.activeFrame.id);
    });

    //#region Text Element Controls

    $('.album-pages-container').on('click', '.btn-change-text', function(){
        let thisElement =  $('input#'+$(this).attr('ref'));
        thisElement.attr('placeholder', 'Informe o texto');
        thisElement.focus();
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
        if(backgroundContainer.find('.btn-undo-background').is(':visible'))
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
    });

    $('.album-pages-container').on('change', '.photo-input', function(){
        let pluginContainer = getPhotoPluginContainer($(this));
        let photoContainer = getPhotoContainer($(this));
        pluginContainer.removeClass('unloaded');

        readFile(this, pluginContainer);
        enableZoom(photoContainer.find('.zoom'));
    });
    //#endregion

    $('#step-2-content #client-name').focusout(function(){
        if($(this).val() != '' && $('#receiver-name').val() == '')
            $('#receiver-name').val($(this).val()).trigger('focusout');
    });

    $('#step-2-content #state').change(function(){
        $(this).find('option').removeAttr('selected');
        $(this).find('option[value="'+$(this).val()+'"]').attr('selected', 'selected');
    });

    $('#step-2-content input[required], #step-2-content select[required]').focusout(function(){
        validateField($(this));
    });
    //#endregion
});
