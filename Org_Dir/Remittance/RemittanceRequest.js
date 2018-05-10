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


            $('#editable-sample_new').on('click',function (e) {
                $.ajax({
                    type: "GET",
                    url: 'Remittance/GetOrgMoney.php',
                    dataType: 'json',
                    success: function (data) {
                        document.getElementById('txtcurmon').value = data.amount;
                    },
                    error: function (response) {
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
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });


            $('#editable-sample').on('click', 'a.delete', function () {

                var getval = $(this).closest('tr').children('td:first').text();
                var nRow = $(this).parents('tr')[0];

                swal({

                        title: "Are you sure?",
                        text: "The record will be permanently deleted?",
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
                                url: 'Remittance/DelRemittance.php',
                                data: {
                                    _id: getval
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
                var txtname = document.getElementById('txtname').value;
                var txtamount = document.getElementById('txtamount').value;
                var txtdesc = document.getElementById('txtdesc').value;
              
                if (txtname.length > 0) {
                    if (txtamount > 0) {
                        if (txtdesc.length > 0) {
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
                                        url: 'Remittance/AddRemittance.php',
                                        data: {
                                            _sendby: txtname,
                                            _recby: $(".username").attr("code"),
                                            _amount: txtamount,
                                            _desc: txtdesc,
                                            _remarks: $('.username').attr('code')
                                        },
                                        success: function (response) {
                                            swal({
                                                title: "Record Added!",
                                                text: "The data is successfully Added!",
                                                type: "success",
                                                confirmButtonColor: '#88A755',
                                                confirmButtonText: 'Okay',
                                                closeOnConfirm: false
                                            }, function (isConfirm) {
                                                window.location.reload();

                                            });
                                        }
                                    });

                                } else {
                                    swal("Cancelled", "The transaction is cancelled", "error");
                                    $('#editable-sample_new').click();
                                }
                            });
                        } else {
                            swal("Please fill the description", "Please try again", "error");
                            $('#editable-sample_new').click();
                        }
                    } else {
                        swal("Please input a valid amount", "Please try again", "error");
                        $('#editable-sample_new').click();
                    }
                } else {
                    swal("Please fill the send by field", "Please try again", "error");
                    $('#editable-sample_new').click();
                }
            });
            $('#updsubmit-data ').on('click', function (e) {
                //update
                e.preventDefault();
                var _drporg = document.getElementById('upddrporg');
                var txtname = document.getElementById('updtxtname').value;
                var txtamount = document.getElementById('updtxtamount').value;
                var txtdesc = document.getElementById('updtxtdesc').value;
                var drporgname = _drporg.options[_drporg.selectedIndex].text;
                var drporgvalue = _drporg.options[_drporg.selectedIndex].value;
                if (drporgvalue != 'default') {
                    if (txtname.length > 0) {
                        if (txtamount > 0) {
                            if (txtdesc.length > 0) {
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
                                            url: 'Remittance/UpdRemittance.php',
                                            data: {
                                                _id: latcode,
                                                _orgcode: drporgvalue,
                                                _sendby: txtname,
                                                _amount: txtamount,
                                                _desc: txtdesc
                                            },
                                            success: function (response) {
                                                swal({
                                                    title: "Record Added!",
                                                    text: "The data is successfully Added!",
                                                    type: "success",
                                                    confirmButtonColor: '#88A755',
                                                    confirmButtonText: 'Okay',
                                                    closeOnConfirm: false
                                                }, function (isConfirm) {
                                                    window.location.reload();

                                                });
                                            }
                                        });

                                    } else {
                                        swal("Cancelled", "The transaction is cancelled", "error");
                                    }
                                });
                            } else {
                                swal("Please fill the description", "Please try again", "error");


                            }


                        } else {
                            swal("Please input a valid amount", "Please try again", "error");


                        }


                    } else {
                        swal("Please fill the send by field", "Please try again", "error");


                    }


                } else {
                    swal("Please choose an organization", "Please try again", "error");


                }


            });
            $('#editable-sample ').on('click', 'a.edit', function (e) {
                e.preventDefault();

                var getid = $(this).closest('tr').children('td:first').text();
                latcode = getid;
                var flag = 0;
                $.ajax({
                    type: "GET",
                    url: 'Remittance/GetData.php',
                    dataType: 'json',
                    data: {
                        _id: getid
                    },
                    success: function (data) {
                        document.getElementById('updtxtname').value = data.send;
                        document.getElementById('updtxtamount').value = data.amo;
                        document.getElementById('updtxtdesc').value = data.desc;
                        document.getElementById('upddrporg').value = data.code;

                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });

//                document.getElementById('updtxtname').value = getname;
//                document.getElementById('updtxtamount').value = getnum;


            });





        }

    };

}();
