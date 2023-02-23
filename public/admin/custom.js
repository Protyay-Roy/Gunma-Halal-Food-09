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
})
