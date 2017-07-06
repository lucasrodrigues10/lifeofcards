$(document).ready(function() {
    $('.nav-pills a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })
    $('#myModal').modal('show');

});
