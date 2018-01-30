$(document).ready(function () {
    $('.panel-btn').click(function (e) {
        e.preventDefault();
        $(this).attr('disabled', true);
        var that = $(this);
        $.post($(this).data('action'))
            .done(function (data) {
                that.append(' <i class="fa fa-check-circle-o" aria-hidden="true"></i>');
                setTimeout(function () {
                    that.text(that.html().replace('<i class="fa fa-check-circle-o" aria-hidden="true"></i>', ''));
                    that.attr('disabled', false);
                }, 1000);
            })
            .fail(function (data) {
                that.append(' <i class="fa fa-times-circle-o" aria-hidden="true"></i>');
                setTimeout(function () {
                    that.text(that.html().replace('<i class="fa fa-times-circle-o" aria-hidden="true"></i>', ''));
                    that.attr('disabled', false);
                }, 1000);
            });
    });
});