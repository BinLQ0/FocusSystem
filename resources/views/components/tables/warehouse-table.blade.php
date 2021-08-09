<table id="warehouse" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Warehouse</th>
            <th>Address</th>
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
                url: '{{ route("api.warehouses") }}',
                type: 'GET',
                dataSrc: 'data'
            },
            columnDefs: [{
                targets: -1,
                width: '5%',
                className: "text-center dt-body-justify",
                defaultContent: "" +
                    '<button id="btn_rack" class="btn btn-info btn-sm mr-1"><i class="fas fa-layer-group"></i></button>' +
                    '<button id="btn_edit" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>' +
                    '<button id="btn_delete" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></button>',
            }],
            columns: [{
                data: 'name'
            }, {
                data: 'address'
            }, {
                data: 'action'
            }, ]
        });

        $('.table tbody').on('click', '#btn_rack', function(e) {
            var data = dtable.row($(this).parents('tr')).data();
            window.open(window.location.href + '/' + data['id'] + '/racks');
        });
    </script>
@endpush