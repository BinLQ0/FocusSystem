<table id="warehouse" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Code</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#warehouse').DataTable({
            ordering: false,
            paging: false,
            dom: 't',
            ajax: {
                url: '{{ route("api.racks") }}',
                data:{
                    warehouse: $("input[id='warehouse_id']").val()
                },
                type: 'GET',
                dataSrc: 'data'
            },
            columnDefs: [{
                targets: -1,
                width: '5%',
                className: "text-center dt-body-justify",
                defaultContent: "" +
                    '<button id="btn_edit_rack" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>' +
                    '<button id="btn_delete_rack" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></button>',
            }],
            columns: [{
                data: 'code'
            }, {
                data: 'note'
            }, {
                data: 'action'
            }, ]
        });
    </script>
@endpush