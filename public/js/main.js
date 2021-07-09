/**
 * Variables
 */
var ModalDeleteSuccess = Swal.mixin({
    title: 'Deleted!',
    text: 'Your file has been deleted.',
    icon: 'success'
});

/**
 * Configuration App's
 */
$(document).ready(function() {
    $('input').attr('autocomplete', 'off');
    $('input[type=number]').attr('step', 'any');
});

$('.table tbody').on('click', '#btn_view', function(e) {
    var data = dtable.row($(this).parents('tr')).data();
    window.open(window.location.href + '/' + data['id']);
});

$('.table tbody').on('click', '#btn_edit', function(e) {
    var data = dtable.row($(this).parents('tr')).data();
    window.open(window.location.href + '/' + data['id'] + '/edit');
});

$('.table tbody').on('click', '#btn_history', function(e) {
    var data = dtable.row($(this).parents('tr')).data();
    window.open(window.location.href + '/' + data['id'] + '/history');
});

$('.table tbody').on('click', '#btn_delete', function(e) {
    var data = dtable.row($(this).parents('tr')).data();
    var uri = window.location.pathname + '/' + data['id'];

    $(this).deleteRow(uri);
});

$.fn.deleteRow = function(uri) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: uri,
                type: 'DELETE',
                success: function success(response, textStatus, xhr) {
                    console.log(xhr.status);
                    if (response.status != 701 && xhr.status == 201) {
                        ModalDeleteSuccess.fire();
                    } else {
                        Swal.fire({
                            title: "Delete Failed",
                            text: response.message,
                            icon: 'warning',
                        });
                    }

                    $('.table').DataTable().ajax.reload();
                },
                error: function error(xhr, status, _error) {
                    if (xhr.status != '405') {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        console.log('Error - ' + errorMessage);

                        Swal.fire({
                            title: "Something Happend",
                            text: "Please Contact Your Admnistrator",
                            icon: 'question',
                        });
                    }
                }
            });
        }
    });
};


/**
 * Rack Function
 */
$('.table tbody').on('click', '#btn_edit_rack', function(e) {
    var data = dtable.row($(this).parents('tr')).data();
    window.open('/master/racks/' + data['id'] + '/edit');
});

$('.table tbody').on('click', '#btn_delete_rack', function(e) {
    var data = dtable.row($(this).parents('tr')).data();
    var uri = '/master/racks/' + data['id'];

    $(this).deleteRow(uri);
});


$('input[name="search"]').keyup(function() {
    dtable.search($(this).val()).draw();
});