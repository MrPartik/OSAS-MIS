var getcode = '';
var getname = '';
var latcode = '';
var appcode = '';
var EditableTable = function () {
    return {
        //main function to initiate the module
        init: function () {
            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }
                oTable.fnDraw();
            }

            function editRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                var jqTds = $('>td', nRow);
                var nRow = $(this).parents('tr')[0];
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate('<center><a class="btn btn-success edit" href="">Edit</a> <a class="btn btn-danger delete" href="">Delete</a></center>', nRow, 3, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate('<a class="btn btn-success edit" href="">Edit</a>', nRow, 3, false);
                oTable.fnDraw();
            }
            var oTable = $('#editable-sample').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1]
                    , [5, 15, 20, "All"] // change per page values here
                ]
                , // set the initial value
                "iDisplayLength": 5
                , "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>"
                , "sPaginationType": "bootstrap"
                , "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                    , "oPaginate": {
                        "sPrevious": "Prev"
                        , "sNext": "Next"
                    }
                }
                , "aoColumnDefs": [{
                        'bSortable': false
                        , 'aTargets': [0, 1, 2, 3, 4, 5, 6]
                    }
                ]
            });
            oTable.fnSort([]);
            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown
            var nEditing = null;
            $('#drporg').change(function (e) {
                var _drporg = document.getElementById('drporg');
                var drporgname = _drporg.options[_drporg.selectedIndex].text;
                var drporgvalue = _drporg.options[_drporg.selectedIndex].value;
                $.ajax({
                    type: "GET"
                    , url: 'Organization/Cashflow/FillTable.php'
                    , dataType: 'json'
                    , data: {
                        _code: drporgvalue
                    }
                    , success: function (data) {
                        var table = $('#editable-sample').DataTable();
                        jQuery(table.fnGetNodes()).each(function () {
                            oTable.fnDeleteRow(0);
                        });
                        $.each(data, function (key, val) {
                            var aiNew = oTable.fnAddData(['<label cashID =' + val.id + '>' + val.ref + '</label>', '<label>'+ val.orgCode+' - '+ val.desc + '</label>', '<label>' + val.col + '</label>', '<label>' + val.exp + '</label>', '<label>' + val.bal + '</label>', '<label>' + val.rem + '</label>', '<label>' + val.dat + '</label>']);
                            var nRow = oTable.fnGetNodes(aiNew[0]);
                        });
                    }
                    , error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                });
            });
            var result = 0;
            $('#editable-sample a.i.cancel').click(function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                }
                else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });
        }
    };
}();
