var voucherNo = "";
var OrgCode ="";



$('tbody').on('click', "button[id='btnApprove']", function () {

    var voucherNo = $(this).attr("vouch"),
     OrgCode =  $(this).attr("orgcode");

    swal({ 
            title: "Are you sure?",
            text: voucherNo+" will be approved, please make sure that you are aware on what you doing ;)",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes !',
            cancelButtonText: "No!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) { 
                $.ajax({
                    type: 'post',
                    url: 'Organization/OrganizationVoucher/query.php',
                    data: {
                        approve: 'approve',
                        voucherNo: voucherNo,
                        OrgCode : OrgCode
                    },
                    success: function (response) {  
                        swal({
                            title: voucherNo+" Approved!",
                            text: "The data is successfully added!",
                            type: "success",
                            confirmButtonColor: '#88A755',
                            confirmButtonText: 'Okay',
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            window.location.reload();

                        });
                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });



            } else
                swal("Cancelled", "The transaction is cancelled", "error");

        });
});
