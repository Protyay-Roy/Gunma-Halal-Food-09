// BOOTSTRAP DATATABLE
$(document).ready(function () {
    $('#bootstrap_datatable').DataTable();
});
// CHANGE STATUS ACTIVE OR INACTIVE WITH SWEET ALERT
$(document).on("click", ".change_status", function () {
    // SWEET ALERT START
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to change status!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change this!'
    }).then((result) => {
        if (result.isConfirmed) {

            $('.loader').fadeIn();
            //   Swal.fire(
            //     'Deleted!',
            //     'Your file has been deleted.',
            //     'success'
            //   )

            // CHANGE STATUS CODE START
            var status = $(this).children('i').attr('status');
            var status_id = $(this).attr('status_id');
            var path = $(this).attr('status_path');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: path + '-status',
                type: "post",
                data: {
                    status: status,
                    status_id: status_id
                },
                success: function (data) {
                    // alert(data['status'])
                    $('.loader').fadeOut();
                    if (data['status'] == 0) {
                        $("#" + path + "-" + status_id).html('<i class="fa-regular fa-circle" status="Inactive" title="Change into active"></i>')
                    } else if (data['status'] == 1) {
                        $("#" + path + "-" + status_id).html('<i class="fa-sharp fa-solid fa-circle-check" status="Active"></i>')
                    }
                }, error: function () {
                    alert("Error")
                }
            })
        }
    })
});
// LOADER IMAGE HIDE
$('.loader').hide();
// DELETE WITH SWEET ALERT
$(document).on("click", ".delete_row", function () {
    // DELETE CODE START
    var delete_id = $(this).attr("delete_id");
    var delete_path = $(this).attr("delete_path");

    // SWEET ALERT START
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your ' + delete_path + ' has been deleted.',
                'success'
            )

            // DELETE ROUTE
            window.location = "delete-" + delete_path + "/" + delete_id;
        }
    })

});

// $('#myform').on('submit',function(e){
//     e.preventDefault();
//     alert('');
//     var form = $('#myform')[0];
//     var formData = new FormData(form);
//     // $.ajax({
//     //     headers: {
//     //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     //     },
//     //     url: 'upload-image',
//     //     data: formData,
//     //     type:'POST',
//     //     success:function(data){
//     //         alert(data)
//     //     },error:function(){
//     //         alert('Error');
//     //     }
//     // });
// })
