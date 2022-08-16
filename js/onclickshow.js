$(document).ready(function() {
    $(".fa-search").click(function() {
        $(".icon").toggleClass("show");
        $("input[type='text']").toggleClass("show");
    });
});