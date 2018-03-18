var item = [];
var getcourse = [];

var text = [{
        value: "12",
        label: "2013-04-03",
        formatted: "at least 13%"
}, {
        value: "88",
        label: "2123-04-03",
        formatted: "at least123123%"
}

           ];



//    '{ "employees" : [' +//    '{ "value": 70,"label": "foo","formatted": "at least 70%" },' +
//    '{ "value": 10,"label": "fooz","formatted": "at least 70%" },' +
//    '{ "value": 20,"label": "foozss","formatted": "at least 70%" } ]}';
//var obj = JSON.parse(text);
//alert(obj.employees[1].value + " " + obj.employees[1].label)

$.ajax({
    type: "GET",
    url: 'Dashboard/DonutGraph.php',
    dataType: 'json',
    data: {
        _appcode: $(".username").attr("code")
    },
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
        '#E67A77', '#D9DD81', '#79D1CF', '#95D7BB'
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
// Use Morris.Area instead of Morris.Line
