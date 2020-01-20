window['site_url'] = $('base').attr("href");

(function ($) {
    $.fn.btn = function (action) {
        var self = $(this);
        var tagName = self.prop("tagName");
        if(tagName == 'A'){
            if (action == 'loading') {
                $(self).attr('data-text',$(self).text());
                $(self).text("Loading..");
            }
            if (action == 'reset') { $(self).text($(self).attr('data-text')); }
        }
        else {
            if (action == 'loading') { $(self).addClass("btn-loading"); }
            if (action == 'reset') { $(self).removeClass("btn-loading"); }
        }
    }
})(jQuery);

function json_callback(json,container){
    $container = $(container);
    $container.find(".is-invalid").removeClass("is-invalid");
    $container.find("span.invalid-feedback").remove();

    if(json['redirect']){
        window.location.href = json['redirect'];
    }

    if(json['errors']){
        $.each(json['errors'], function(i,j){
            $ele = $container.find('[name="'+ i +'"]');
            if($ele){
                $ele.addClass("is-invalid");
                $ele.after("<span class='invalid-feedback'>"+ j +"</span>");
            }
        })
    }
}
$(document).ajaxStop(function() {
    $('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
});

$('[data-toggle="tooltip"]').tooltip()

function removePopover(){
    $('.popover').popover('hide', function() {
        $('.popover').remove();
    });
}

$(document).delegate(".image-chooser","click",function(e){
    e.preventDefault();
    $('#modal-image').remove();
    removePopover()

    var element = this;

    $(element).popover({
        html: true,
        placement: 'right',
        trigger: 'focus',
        content: function() {
            return '<button type="button" id="button-image" class="btn btn-primary"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon m-0 icon-sm"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>\
                 <button type="button" id="button-clear" class="btn btn-danger"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon m-0 icon-sm"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
        }
    });

    $(element).popover('show');

    $('#button-image').on('click', function() {
        removePopover()
        
        $(element).attr('id',"filemanager-" + Date.now());
        $.ajax({
            url: window['site_url'] + 'admin/filemanager',
            type:'GET',
            dataType:'html',
            data:{
                target:$(element).attr("id"),
            },
            beforeSend:function(){
                
            },
            complete:function(){
                
            },
            success:function(html){
                $('body').append('<div id="modal-image" class="modal">' + html + '</div>');
                $('#modal-image').modal('show');
            },
        })
    });

    $('#button-clear').on('click', function() {
        $(element).find('img').attr('src', window['data-placeholder']);
        $(element).find('input').attr('value', '');
        $(element).popover('hide', function() {
            $('.popover').remove();
        });
    });
})