var remit_linegraph = [];



$.ajax({
    type: "GET",
    url: 'Dashboard/Remittance.php',
    dataType: 'json',
    data: {
        _appcode: $(".username").attr("code")
    },
    success: function (data) {
        var i = 0;
        $.each(data, function (key, val) {
            remit_linegraph.push({
                elapsed: val.date,
                value: val.amount
            });
            i++;
        });


        Morris.Line({
            element: 'graph-line',
            data: remit_linegraph,
            xkey: 'elapsed',
            ykeys: ['value'],
            labels: ['value'],
            lineColors: ['#1FB5AD'],
            parseTime: false
        });




    },
    error: function (response) {
        swal("Error encountered while adding data", "Please try again", "error");
    }

});
