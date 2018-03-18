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
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 5,
                "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });


            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

            var nEditing = null;

            $('#editable-sample_new').click(function (e) {
                $.ajax({
                    type: "GET",
                    url: 'OrganizationMembers/FillSelStudent.php',
                    data: {
                        _code: document.getElementById('getappcode').innerText
                    },
                    success: function (data) {
                        document.getElementById('drpstud').innerHTML = data;

                    },
                    error: function (response) {
                        swal("Error encountered ", "Please try again", "error");
                    }

                });


            });

            $('#btnsync').click(function (e) {
                e.preventDefault();
                getcode = document.getElementById('getappcode').innerText;

                swal({
                        title: "Are you sure?",
                        text: "You want to sync the data of students into the table",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, do it!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: "GET",
                                url: 'OrganizationMembers/Syncdata.php',
                                dataType: 'json',
                                data: {
                                    _code: getcode
                                },
                                success: function (data) {
                                    // alert(data.list);
                                    swal("Record Synchronize!", "The data is successfully sync!", "success");
                                    //                                    window.location.reload();
                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }

                            });



                        } else {

                            swal("Cancelled", "The transaction is cancelled", "error");
                            $("#editable-sample_new").click();
                        }

                    });

            });
            var result = 0;

            $('#editable-sample a.i.cancel').click(function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });
            $('#editable-sample').on('click', 'a.delete', function () {
                var appcode = document.getElementById('getappcode').innerText;

                var getval = $(this).closest('tr').children('td:first').text();
                var getname = $(this).closest('tr').children('td:first').next().text();
                var nRow = $(this).parents('tr')[0];

                swal({

                        title: "Are you sure?",
                        text: "The record will be save and will be use for further transaction",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, do it!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {

                            $.ajax({
                                type: 'post',
                                url: 'OrganizationMembers/DelStud.php',
                                data: {
                                    _studno: getval,
                                    _appcode: appcode
                                },
                                success: function (response) {
                                    swal("Record Deleted!", "The data is successfully deleted!", "success");
                                    oTable.fnDeleteRow(nRow);
                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }

                            });



                        } else
                            swal("Cancelled", "The transaction is cancelled", "error");

                    });
            });

            $('#submit-data').click(function (e) {
                e.preventDefault();
                var getappcode = document.getElementById('getappcode').innerText;
                var _drpstud = document.getElementById('drpstud');
                var drpstudname = _drpstud.options[_drpstud.selectedIndex].text;
                var drpstudvalue = _drpstud.options[_drpstud.selectedIndex].value;
                var _drppos = document.getElementById('drppos');
                var _drpposvalue = _drppos.options[_drppos.selectedIndex].value;
                var _drppostext = _drppos.options[_drppos.selectedIndex].text;
                if (drpstudvalue != 'default') {
                    $('#close').click();
                    swal({
                        title: "Are you sure?",
                        text: "This data will be saved and used for further transaction",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, Add it!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: 'post',
                                url: 'OrganizationMembers/AddStud.php',
                                data: {
                                    _studno: drpstudvalue,
                                    _appcode: getappcode,
                                    _pos: _drpposvalue
                                },
                                success: function (response) {
                                    swal("Record Added!", "The data is successfully Added!", "success");
                                    var aiNew = oTable.fnAddData([drpstudvalue, drpstudname, _drppostext, _drppostext, "<center><a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-trash-o'></i></a></center>", ]);
                                    var nRow = oTable.fnGetNodes(aiNew[0]);
                                    document.getElementById("form-data").reset();
                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                    $('#editable-sample_new').click();
                                }
                            });

                        } else {
                            swal("Cancelled", "The transaction is cancelled", "error");
                            $('#editable-sample_new').click();
                        }
                    });

                } else {
                    swal("Please choose a student", "Please try again", "error");


                }


            });







        }

    };

}();
