var getcode = '';
var getname = '';
var latcode = '';


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

                latcode = aData[0];
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
            $('#divref').hide();

            $('#selRole').change(function (e) {
                e.preventDefault();
                var reftype = '';
                if (this.value == 'OSAS HEAD') {
                    $('#divref').show(500);
                    reftype = 'osas';

                    $.ajax({
                        type: 'get',
                        url: 'SystemSetup/UserAccount/Retrieve_Reference.php',
                        dataType: 'json',
                        data: {
                            _stat: reftype
                        },
                        success: function (data) {
                            document.getElementById('selRef').innerHTML = '<option value="-1">Please Select an User Reference</option>';
                            $.each(data, function (key, val) {
                                $('#selRef').append('<option value="' + val.val + '">' + val.text + '</option>')
                            });

                        },
                        error: function (response) {
                            swal("Error", response, "error");
                        }

                    });


                } else if (this.value == 'Administrator') {
                    $('#divref').hide(500);
                    document.getElementById('selRef').innerHTML = '<option value="default">Please Select an User Reference</option>';

                } else if (this.value == 'Organization') {
                    $('#divref').show(500);
                    reftype = 'org';

                    $.ajax({
                        type: 'get',
                        url: 'SystemSetup/UserAccount/Retrieve_Reference.php',
                        dataType: 'json',
                        data: {
                            _stat: reftype
                        },
                        success: function (data) {
                            document.getElementById('selRef').innerHTML = '<option value="-1">Please Select an User Reference</option>';
                            $.each(data, function (key, val) {
                                $('#selRef').append('<option value="' + val.val + '">' + val.text + '</option>')
                            });

                        },
                        error: function (response) {
                            swal("Error", response, "error");
                        }

                    });

                } else {
                    $('#divref').show(500);
                    reftype = 'stud';
                    $.ajax({
                        type: 'get',
                        url: 'SystemSetup/UserAccount/Retrieve_Reference.php',
                        dataType: 'json',
                        data: {
                            _stat: reftype
                        },
                        success: function (data) {
                            document.getElementById('selRef').innerHTML = '<option value="-1">Please Select an User Reference</option>';
                            $.each(data, function (key, val) {
                                $('#selRef').append('<option value="' + val.val + '">' + val.text + '</option>')
                            });

                        },
                        error: function (response) {
                            swal("Error", response, "error");
                        }

                    });

                }



            });
            $('#submit-data').click(function (e) {
                e.preventDefault();
                var username = document.getElementById("txtusername").value;
                var role = document.getElementById("selRole").value;
                var password = document.getElementById("txtpassword").value;
                var reference = document.getElementById("selRef").value;;
                if (username.length)
                    if (role != '-1')
                        if (password.length) {
                            $("#close").click();


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
                                            url: 'SystemSetup/UserAccount/Insert_UserAccount.php',
                                            data: {
                                                _username: username,
                                                _role: role,
                                                _reference: reference,
                                                _password: password
                                            },
                                            success: function (response) {
                                                swal("Record Added!", "The data is successfully added!", "success");

                                                if (role == 'OSAS HEAD')
                                                    var aiNew = oTable.fnAddData([username, "<center style='padding-top:10px'><span class='label label-primary'>OSAS HEAD</span></center>", '<center><span class="label label-primary">New Account</span></center>', "<center style='padding-top:10px'><span class='label label-success'>Active</span></center>", " <center style='padding-top:10px'><a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a><a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-ban'></i></a><center>", '']);
                                                else if (role == 'Organization')
                                                    var aiNew = oTable.fnAddData([username, "<center style='padding-top:10px'><span class='label label-inverse'>Organization</span></center>", '<center><span class="label label-primary">New Account</span></center>', "<center style='padding-top:10px'><span class='label label-success'>Active</span></center>", " <center style='padding-top:10px'><a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a><a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-ban'></i></a><center>", '']);
                                                else if (role == 'Administrator')
                                                    var aiNew = oTable.fnAddData([username, "<center style='padding-top:10px'><span class='label label-success'>Administrator</span></center>", '<center style="padding-top:10px"><span class="label label-primary">New Account</span></center>', "<center style='padding-top:10px'><span class='label label-success'>Active</span></center>", " <center><a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a><a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-ban'></i></a><center>", '']);
                                                else
                                                    var aiNew = oTable.fnAddData([username, "<center style='padding-top:10px'><span class='label label-warning'>Student</span></center>", '<center style="padding-top:10px"><span class="label label-primary">New Account</span></center>', "<center style='padding-top:10px'><span class='label label-success'>Active</span></center>", " <center><a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a><a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-ban'></i></a><center>"]);


                                                var nRow = oTable.fnGetNodes(aiNew[0]);
                                                document.getElementById("form-data").reset();
                                            },
                                            error: function (response) {
                                                swal(response, "Please try again", "error");
                                                $("#editable-sample_new").click();
                                            }

                                        });

                                    } else {
                                        swal("Cancelled", "The transaction is cancelled", "error");
                                        $("#editable-sample_new").click();
                                    }

                                });

                        }
                else
                    swal("Please Fill the password field", "Please try again", "error");
                else
                    swal("Please Fill the role field", "Please try again", "error");
                else
                    swal("Please Fill the username field", "Please try again", "error");




            });
            $('#editable-sample a.delete').live('click', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var getval = $(this).closest('tr').children('td:first').text();
                var role = $(this).closest('tr').children('td:first').next().html();
                var rec = $(this).closest('tr').children('td:first').next().next().html();

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
                                url: 'SystemSetup/UserAccount/Deactivate_UserAccount.php',
                                data: {
                                    _username: getval
                                },
                                success: function (response) {
                                    swal("Record Deleted!", "The data is successfully deleted!", "success");
                                    oTable.fnDeleteRow(nRow);
                                    var aiNew = oTable.fnAddData([getval, role, rec, "<center style='padding-top:10px'><span class='label label-danger'>Inactive</span></center>", " <center style='padding-top:10px'><a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a> <a class='btn btn-info retrieve' href='javascript:;'><i class='fa fa-undo'></i></a><center>"]);
                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                    oTable.fnDeleteRow(nRow);
                                }

                            });

                        } else
                            swal("Cancelled", "The transaction is cancelled", "error");

                    });
            });
            $('#editable-sample a.retrieve').live('click', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var getval = $(this).closest('tr').children('td:first').text();
                var role = $(this).closest('tr').children('td:first').next().html();
                var rec = $(this).closest('tr').children('td:first').next().next().html();


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
                                url: 'SystemSetup/UserAccount/Retrieve_UserAccount.php',
                                data: {
                                    _username: getval
                                },
                                success: function (response) {
                                    swal("Record Deleted!", "The data is successfully deleted!", "success");
                                    oTable.fnDeleteRow(nRow);
                                    var aiNew = oTable.fnAddData([getval, role, rec, "<center style='padding-top:10px'><span class='label label-success'>Active</span></center>", " <center style='padding-top:10px'><a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a> <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-ban'></i></a><center>", '']);
                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }

                            });

                        } else
                            swal("Cancelled", "The transaction is cancelled", "error");

                    });
            });

            $('#editable-sample a.cancel').live('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });



            $('#editable-sample a.edit').live('click', function (e) {
                e.preventDefault();
                var nRow = $(this).parents('tr')[0];
                editRow(oTable, nRow);
                nEditing = nRow;
                $.ajax({
                    type: 'post',
                    url: 'SystemSetup/UserAccount/Retrieve_UserDetails.php',
                    dataType: 'json',
                    data: {
                        _username: latcode
                    },
                    success: function (data) {
                        alert(data.ref);
                        document.getElementById('updtxtusername').value = data.uname;
                        document.getElementById('updselRole').value = data.role;



                        if (data.role == 'OSAS HEAD') {
                            $('#divref').show(500);
                            reftype = 'osas';

                            $.ajax({
                                type: 'get',
                                url: 'SystemSetup/UserAccount/Retrieve_Reference.php',
                                dataType: 'json',
                                data: {
                                    _stat: reftype
                                },
                                success: function (data) {
                                    document.getElementById('updselRef').innerHTML = '<option value="-1">Please Select an User Reference</option>';
                                    $.each(data, function (key, val) {
                                        if (data.ref == val.val)
                                            $('#updselRef').append('<option value="' + val.val + '" selected>' + val.text + '</option>')
                                        else
                                            $('#updselRef').append('<option value="' + val.val + '">' + val.text + '</option>')
                                    });

                                },
                                error: function (response) {
                                    swal("Error", response, "error");
                                }

                            });


                        } else if (data.role == 'Administrator') {
                            $('#divref').hide(500);
                            document.getElementById('updselRef').innerHTML = '<option value="default">Please Select an User Reference</option>';

                        } else if (data.role == 'Organization') {
                            $('#divref').show(500);
                            reftype = 'org';

                            $.ajax({
                                type: 'get',
                                url: 'SystemSetup/UserAccount/Retrieve_Reference.php',
                                dataType: 'json',
                                data: {
                                    _stat: reftype
                                },
                                success: function (data) {
                                    document.getElementById('updselRef').innerHTML = '<option value="-1">Please Select an User Reference</option>';
                                    $.each(data, function (key, val) {
                                        if (data.ref == val.val)
                                            $('#updselRef').append('<option value="' + val.val + '" selected>' + val.text + '</option>')
                                        else
                                            $('#updselRef').append('<option value="' + val.val + '">' + val.text + '</option>')
                                    });

                                },
                                error: function (response) {
                                    swal("Error", response, "error");
                                }

                            });

                        } else {
                            $('#divref').show(500);
                            reftype = 'stud';
                            $.ajax({
                                type: 'get',
                                url: 'SystemSetup/UserAccount/Retrieve_Reference.php',
                                dataType: 'json',
                                data: {
                                    _stat: reftype
                                },
                                success: function (data) {
                                    document.getElementById('updselRef').innerHTML = '<option value="-1">Please Select an User Reference</option>';
                                    $.each(data, function (key, val) {
                                        if (data.ref == val.val)
                                            $('#updselRef').append('<option value="' + val.val + '" selected>' + val.text + '</option>')
                                        else
                                            $('#updselRef').append('<option value="' + val.val + '">' + val.text + '</option>')
                                    });

                                },
                                error: function (response) {
                                    swal("Error", response, "error");
                                }

                            });

                        }









                        alert()
                        alert(data.ref)
                        alert(data.role)
                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });



            });
        }

    };

}();
