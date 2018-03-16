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



            }

            function saveRow(oTable, nRow) {
                var code = document.getElementById('txtupdcode').value;
                oTable.fnUpdate(code, nRow, 0, false);
                oTable.fnUpdate(document.getElementById('txtupdname').value, nRow, 1, false);
                oTable.fnUpdate(document.getElementById('txtupddesc').value, nRow, 2, false);
                if (document.getElementById('chkupdacc').checked)
                    oTable.fnUpdate('Accredited', nRow, 3, false);
                else
                    oTable.fnUpdate('This application is ready for accreditation', nRow, 3, false);

                //                oTable.fnUpdate('<center><a class="btn btn-success edit" href="">Edit</a> <a class="btn btn-danger delete" href="">Delete</a></center>', nRow, 4, false);
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
            $('#btnStep1').click(function (e) {
                e.preventDefault();

                var year = document.getElementById('drpyear').value;

                $.ajax({
                    type: 'post',
                    url: 'Organization/OrganizationProfile/Step1.php',
                    data: {
                        _year: year,
                        _appcode: latcode,
                        _orgname: getname


                    },
                    success: function (response) {},
                    error: function (response) {
                        swal(response, "Please try again", "error");
                    }
                });


            });
            $('#btnStep2').click(function (e) {
                e.preventDefault();

                var drpcate = document.getElementById('drpcat');
                var drpcatname = drpcate.options[drpcate.selectedIndex].text;
                var drpcatcode = drpcate.options[drpcate.selectedIndex].value;


                if (drpcatname == 'Academic Organization') {
                    $.ajax({
                        type: 'post',
                        url: 'Organization/OrganizationProfile/pre_Step2.php',
                        data: {
                            _appcode: latcode

                        },
                        success: function (response) {},
                        error: function (response) {
                            swal(response, "Please try again", "error");
                        }
                    });

                    $('#e9 option:selected').each(function (index, brand) {
                        $.ajax({
                            type: 'post',
                            url: 'Organization/OrganizationProfile/Step2.php',
                            data: {
                                _appcode: latcode,
                                _catcode: drpcatcode,
                                _coucode: brand.value


                            },
                            success: function (response) {

                            },
                            error: function (response) {
                                swal(response, "Please try again", "error");
                            }
                        });

                    });

                } else {
                    $.ajax({
                        type: 'post',
                        url: 'Organization/OrganizationProfile/pre_Step2.php',
                        data: {
                            _appcode: latcode

                        },
                        success: function (response) {},
                        error: function (response) {
                            swal(response, "Please try again", "error");
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: 'Organization/OrganizationProfile/Step2-b.php',
                        data: {
                            _appcode: latcode,
                            _catcode: drpcatcode

                        },
                        success: function (response) {

                        },
                        error: function (response) {
                            swal(response, "Please try again", "error");
                        }
                    });

                }




            });

            $('#btnStep3').click(function (e) {
                e.preventDefault();

                var advname = document.getElementById('txtadvname').value;

                $.ajax({
                    type: 'post',
                    url: 'Organization/OrganizationProfile/Step3.php',
                    data: {
                        _appcode: latcode,
                        _advname: advname


                    },
                    success: function (response) {

                    },
                    error: function (response) {
                        swal(response, "Please try again", "error");
                    }
                });


            });
            $('#btnStep4').click(function (e) {
                e.preventDefault();

                var mission = document.getElementById('txtmission').value;
                var vision = document.getElementById('txtvision').value;

                $.ajax({
                    type: 'post',
                    url: 'Organization/OrganizationProfile/Step4.php',
                    data: {
                        _appcode: latcode,
                        _mission: mission,
                        _vision: vision


                    },
                    success: function (response) {},
                    error: function (response) {
                        swal(response, "Please try again", "error");
                    }
                });


            });
            $('#btnFinish').click(function (e) {
                e.preventDefault();
                var x = 0;
                $('#updaccreqlist tr').each(function (index, brand) {
                    x++;

                });
                for (var z = 1; z <= x; z++) {

                    chkstat = document.getElementById('chkupdstat' + z);
                    if (chkstat.checked)
                        stat = 1;
                    else
                        stat = 0;

                    reccode = document.getElementById('updcode' + z).innerText;
                    //                    alert(latcode + '-' + reccode + '-' + stat);


                    $.ajax({
                        type: 'post',
                        url: 'Organization/OrganizationProfile/Step5.php',
                        async: true,
                        data: {
                            _drpcode: latcode,
                            _reccode: reccode,
                            _stat: stat

                        },
                        success: function (response) {
                            swal("Woaah, that's neat!", "The application is successfull!", "success");
                            $('#tableForm').show(500);
                            $('#wizardForm').hide(500);


                            //document.getElementById("form-data").reset();
                        },
                        error: function (response) {
                            swal("Error encountered while adding data", "Please try again", "error");
                        }
                    });

                }


            });

            $('#drpcat').change(function () {

                var e = document.getElementById("drpcat");
                var getcat = e.options[e.selectedIndex].text;
                if (getcat == 'Academic Organization')
                    $('#course').removeClass('hidden');
                else
                    $('#course').addClass('hidden');


            });


            $('#submit-data').click(function (e) {
                e.preventDefault();

                //                var code = document.getElementById('txtcode').value;
                var name = document.getElementById('txtname').value;
                var desc = document.getElementById('txtdesc').value;
                var acc = document.getElementById('chkacc');
                var accstat = '';
                var chkstat = '';
                var chkcode = '';
                var stat = 0;

                if (acc.checked)
                    accstat = 'Accredited';
                else
                    accstat = 'This application is ready for accreditation';
                $("#close").click();

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
                            url: 'Organization/OrganizationProfile/Add-ajax.php',
                            data: {
                                _name: name,
                                _desc: desc,
                                _accstat: accstat


                            },
                            success: function (response) {
                                swal("Record Updated!", "The data is successfully Added!", "success");
                                //                                var aiNew = oTable.fnAddData([code, name, desc, accstat, "<center><a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'>Edit</a> <a class='btn btn-danger delete' href='javascript:;'>Delete</a>		</center>", '']);
                                //                                var nRow = oTable.fnGetNodes(aiNew[0]);
                                document.getElementById("form-data").reset();
                            },
                            error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                                $("#openAddmodal").click();
                            }
                        });


                    } else {
                        swal("Cancelled", "The transaction is cancelled", "error");
                        //                        $("#openAddmodal").click();
                        document.getElementById("form-data").reset();
                    }
                });

            });

            $('#updsubmit-data').click(function (e) {
                e.preventDefault();
                var code = document.getElementById('txtupdcode').value;
                var name = document.getElementById('txtupdname').value;
                var desc = document.getElementById('txtupddesc').value;
                var acc = document.getElementById('chkupdacc');
                var accstat = '';
                var getid = document.getElementById('txtgetid').value;
                var chkstat = '';
                var chkcode = '';
                var stat = 0;
                $("#updclose").click();
                if (acc.checked)
                    accstat = 'Accredited';
                else
                    accstat = 'This application is ready for accreditation';
                //                $("#updclose").click();

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
                            url: 'Organization/OrganizationProfile/Update-ajax.php',
                            data: {
                                _id: getid,
                                _code: code,
                                _name: name,
                                _desc: desc,
                                _accstat: accstat


                            },
                            success: function (response) {
                                swal("Record Updated!", "The data is successfully Added!", "success");
                                $("#updclose").click();
                                saveRow(oTable, nEditing);
                                nEditing = null;
                                document.getElementById("form-data2").reset();



                            },
                            error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                                $("#openModalupd").click();
                            }
                        });





                    } else {
                        swal("Cancelled", "The transaction is cancelled", "error");
                        $("#openModalupd").click();
                    }
                });



            });

            $('#editable-sample').on('click', 'a.wizardOpen',function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                getname = $(this).closest('tr').children('td:first').next().text();
                latcode = $(this).closest('tr').children('td:first').text();
                document.getElementById('lblname').innerText = getname + ' Application Wizard';

                var fillyear = '';
                var fillcat = '';
                $('#step-1').css('display', 'block');
                $('#step-2').css('display', 'none');
                $('#step-3').css('display', 'none');
                $('#step-4').css('display', 'none');
                $('#step-5').css('display', 'none');

                $('#astep1').removeClass('btn-success');

                $('#astep2').removeClass('btn-success');
                $('#astep2').attr('disabled', 'disabled');

                $('#astep3').removeClass('btn-success');
                $('#astep2').attr('disabled', 'disabled');

                $('#astep4').removeClass('btn-success');
                $('#astep4').prop('disabled', true);

                $('#astep5').removeClass('btn-success');
                $('#astep5').prop('disabled', true);

                $.ajax({
                    type: 'GET',
                    url: 'Organization/OrganizationProfile/GetCurrentStep.php',
                    data: {
                        _appcode: latcode
                    },
                    success: function (curstep) {
                        //DITO NASGSTART YUNG PAGFILL SA STEP1
                        if (curstep > 1) {

                            $.ajax({
                                type: 'GET',
                                url: 'Organization/OrganizationProfile/FillStep1.php',
                                dataType: 'json',
                                data: {
                                    _appcode: latcode
                                },
                                success: function (step) {
                                    $('#drpyear option').each(function (index, brand) {
                                        if (brand.value == step.year) {
                                            fillyear = fillyear + '<option value="' + step.year + '" selected >' + step.year + '</option>';

                                        } else {
                                            fillyear = fillyear + '<option value="' + brand.value + '" >' + brand.value + '</option>';
                                        }


                                    });
                                    document.getElementById('drpyear').innerHTML = fillyear;
                                    $("#btnStep1").click();

                                },
                                error: function (errorfill) {
                                    swal(errorfill, "Please try again", "error");
                                }

                            });

                        }
                        //END NG FILL NG STEP1
                        //DITO NASGSTART YUNG PAGFILL SA STEP2
                        if (curstep > 2) {

                            $.ajax({
                                type: 'GET',
                                url: 'Organization/OrganizationProfile/FillStep2.php',
                                dataType: 'json',
                                data: {
                                    _appcode: latcode
                                },
                                success: function (step) {
                                    if (step.catname != 'Academic Organization') {
                                        $('#course').addClass('hidden');
                                    }

                                    $('#drpcat option').each(function (index, brand) {
                                        if (brand.value == step.catcode) {
                                            fillcat = fillcat + '<option value="' + step.catcode + '" selected >' + step.catname + '</option>';

                                        } else {
                                            fillcat = fillcat + '<option value="' + brand.value + '" >' + brand.text + '</option>';
                                        }


                                    });

                                    var item = [];
                                    var i = 0;
                                    $.ajax({
                                        type: 'GET',
                                        url: 'Organization/OrganizationProfile/FillCourse.php',
                                        dataType: 'json',
                                        async: true,
                                        data: {
                                            _appcode: latcode
                                        },
                                        success: function (data2) {
                                            $.each(data2, function (key, val) {
                                                item.push(val.course);
                                            });
                                            $("#e9").select2("val", item);


                                        },
                                        error: function (response2) {
                                            swal(response2, "Please try again", "error");
                                        }

                                    });

                                    document.getElementById('drpcat').innerHTML = fillcat;
                                    $("#btnStep1").click();
                                    $("#btnStep2").click();
                                },
                                error: function (errorfill) {
                                    swal(errorfill, "Please try again", "error");
                                }

                            });

                        }
                        //END NG FILL NG STEP2
                        //DITO NASGSTART YUNG PAGFILL SA STEP3
                        if (curstep > 3) {

                            $.ajax({
                                type: 'GET',
                                url: 'Organization/OrganizationProfile/FillStep3.php',
                                dataType: 'json',
                                async: true,
                                data: {
                                    _appcode: latcode
                                },
                                success: function (step) {
                                    document.getElementById('txtadvname').value = step.advname;
                                    $("#btnStep1").click();
                                    $("#btnStep2").click();
                                    $("#btnStep3").click();


                                },
                                error: function (response2) {
                                    swal(response2, "Please try again", "error");
                                }

                            });

                        }
                        //END NG FILL NG STEP3
                        //DITO NASGSTART YUNG PAGFILL SA STEP4
                        if (curstep > 4) {

                            $.ajax({
                                type: 'GET',
                                url: 'Organization/OrganizationProfile/FillStep4.php',
                                dataType: 'json',
                                async: true,
                                data: {
                                    _appcode: latcode
                                },
                                success: function (step) {
                                    document.getElementById('txtmission').value = step.mission;
                                    document.getElementById('txtvision').value = step.vision;
                                    $("#btnStep1").click();
                                    $("#btnStep2").click();
                                    $("#btnStep3").click();
                                    $("#btnStep4").click();

                                },
                                error: function (response2) {
                                    swal(response2, "Please try again", "error");
                                }

                            });



                        }
                        //END NG FILL NG STEP4
                        //DITO NASGSTART YUNG PAGFILL SA STEP5
                        if (curstep == 5) {
                            $('#updaccreqlist tr ').each(function (index, brand) {
                                index++;
                                var reqcode = document.getElementById('updcode' + index).innerText;
                                $.ajax({
                                    type: 'GET',
                                    url: 'Organization/OrganizationProfile/FillAccreditationTable.php',
                                    async: true,
                                    data: {
                                        _appcode: latcode,
                                        _reqcode: reqcode
                                    },
                                    success: function (data2) {
                                        if (data2 == '1')
                                            $('#chkupdstat' + index).prop('checked', true);
                                        $("#btnStep1").click();
                                        $("#btnStep2").click();
                                        $("#btnStep3").click();
                                        $("#btnStep4").click();



                                    },
                                    error: function (response2) {
                                        swal(response2, "Please try again", "error");
                                    }

                                });


                            });



                        }
                        //END NG FILL NG STEP5

                    },
                    error: function (response) {
                        swal(response, "Please try again", "error");
                    }

                });


            });
            $('#editable-sample').on('click',' a.delete', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var getval = $(this).closest('tr').children('td:first').text();

                swal({

                        title: "Are you sure?",
                        text: "The record will be save and will be use for Semester",
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
                                url: 'Organization/OrganizationProfile/Delete-ajax.php',
                                data: {
                                    _code: getval
                                },
                                success: function (response) {
                                    swal("Record Deleted!", "The data is successfully deleted!", "success");
                                    oTable.fnDeleteRow(nRow);
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

            $('#editable-sample').on('click', 'a.cancel',function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });



            $('#editable-sample').on('click',' a.edit', function (e) {
                e.preventDefault();

                var id = $(this).closest('tr').children('td:first').text();
                document.getElementById('txtgetid').value = $(this).closest('tr').children('td:first').text();
                $.ajax({
                    type: "GET",
                    url: 'Organization/OrganizationProfile/GetData-ajax.php',
                    dataType: 'json',
                    data: {
                        _id: id
                    },
                    success: function (data) {
                        document.getElementById('txtupdcode').value = data.code;
                        document.getElementById('txtupdname').value = data.name;
                        document.getElementById('txtupddesc').value = data.desc;
                        if (data.accstat == 'Accredited')
                            document.getElementById("chkupdacc").checked = true;
                        else
                            document.getElementById("chkupdacc").checked = false;
                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });


            });
        }

    };

}();
