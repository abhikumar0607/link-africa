jQuery(document).ready(function () {
    var maxLength = 50;
    $('#description > option').text(function(i, text) {
        if (text.length > maxLength) {
            return text.substr(0, maxLength) + '...';  
        }
    });
});
