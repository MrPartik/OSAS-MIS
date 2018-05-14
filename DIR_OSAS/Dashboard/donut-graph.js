var item = [];
var getcourse = [];

$.ajax({
    type: "GET",
    url: 'Dashboard/DonutGraph.php',
    dataType: 'json',
    success: function (data) {
        var i = 0;
        $.each(data, function (key, val) {
            item.push({
                value: val.value,
                label: val.label,
                formatted: val.formatted
            });
            i++;
        });
        if (i == 0) {
            Morris.Donut({
                element: 'graph-donut',
                data: [
                    {
                        value: 100,
                        label: 'Empty',
                        formatted: 'No Members'
                    }
                ],
                backgroundColor: '#fff',
                labelColor: '#1fb5ac',
                colors: [
                    '#E67A77', '#D9DD81', '#79D1CF', '#95D7BB'
            ],
                formatter: function (x, data) {
                    return data.formatted;
                }
            });

        } else {
            Morris.Donut({
                element: 'graph-donut',
                data: item,
                backgroundColor: '#fff',
                labelColor: '#1fb5ac',
                colors: [
                '#E67A77', '#D9DD81', '#79D1CF', '#95D7BB', '#E67A74', '#D9DD82', '#79D3CF', '#94D7BB'
            ],
                formatter: function (x, data) {
                    return data.formatted;
                }
            });
        }



    },
    error: function (response) {
        swal("Error encountered while adding data", "Please try again", "error");
    }

});
