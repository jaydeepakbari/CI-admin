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