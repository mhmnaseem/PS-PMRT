$(function () {
    //Date time picker
    $('#datepicker,#datepicker1').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });


});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    if($('#editor1').length!==0){
        CKEDITOR.replace('editor1');
    }

    var setValue = $('#ajax_url').attr("data-set-value");

    if (setValue == 1) {


        var startDate = $('#datepicker').attr("data-start-date");
        var endDate = $('#datepicker1').attr("data-end-date");


        setData(startDate, endDate);

        function setData(startDate, endDate) {
            getStartDate = moment(startDate).format("MM-DD-YYYY HH:mm");
            getEndDate = moment(endDate).format("MM-DD-YYYY HH:mm");

            $('#datepicker').data("DateTimePicker").date(getStartDate);
            $('#datepicker1').data("DateTimePicker").date(getEndDate);

        }

        ajax();

    }
    //date time change and calculate spent time.
    $("#datepicker1").on("dp.change", function (e) {
        ajax();
    });


    // //
    // $('.ajax').click(function () {
    //     var t = $(this);
    //
    //
    //     var data = {
    //         'slug': $(t).attr("data-slug"),
    //         'value': $(t).attr("data-value")
    //     };
    //
    //
    //     $.ajax({
    //         url: $(t).attr("data-source"),
    //         data: data,
    //         dataType: "json",
    //         type: "post",
    //         success: function (data) {
    //             console.log(data);
    //             if (data.success = 'true') {
    //                 location.reload();
    //             }
    //
    //         }
    //     })
    // });


    function ajax() {
        var ajax_url = $('#ajax_url').val();

        var data = {
            'start_date': $('#datepicker').val(),
            'end_date': $('#datepicker1').val()
        };


        $.ajax({
            url: ajax_url,
            data: data,
            dataType: "json",
            type: "post",
            success: function (data) {

                if (data.success = 'true') {

                    $('#time_spent').text(data.html);

                }

            }
        })
    }

    $('[data-toggle="tooltip"]').tooltip();
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

});
$(function () {
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.nav-tabs a').click(function (e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });
});


