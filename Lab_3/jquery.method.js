(function($) {
    $.fn.reverseText = function(params) {

        params = $.extend( {minlength: 0, maxlength: 99999}, params);   

        this.each(function() { 

            var $t = $(this);  
            var origText = $t.text(); var newText = '';  

                if (origText.length >= params.minlength &&  origText.length <= params.maxlength) { 
                    for (var i = origText.length-1; i >= 0; i--) 
                        newText += origText.substr(i, 1);  
                    $t.text(newText);
                }
        });  
        return this;  
    }; 

    //$.fn.hidePhoto = function() {
      //  var $t = $('img');
        //var Photo = 

    //};

})(jQuery);