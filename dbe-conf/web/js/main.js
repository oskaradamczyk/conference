$(document).ready(function () {

    $('div.close').click(function (e) {
        $(this).parent().hide();
        $('.footer-menu .nav-link.active.show').removeClass('active show');
    });
    $('.footer-menu .nav-link:not(#live)').click(function () {
        $('.content-wrapper > div').hide();
        $($(this).attr('href')).show();
    });
});