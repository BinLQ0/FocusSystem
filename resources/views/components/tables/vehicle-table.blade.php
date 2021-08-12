<table id="vehicle" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Plate Number</th>
            <th>Load Capacity</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#vehicle').DataTable({
            ordering: false,
            paging: false,
            dom: 't',
            ajax: {
                url: '{{ route("api.vehicle") }}',
                type: 'GET',
                dataSrc: ''
            },
            columnDefs: [{
                targets: -1,
                width: '5%',
                className: "text-center dt-body-justify",
                defaultContent: "" +
                    '<button id="btn_edit" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>' +
                    '<button id="btn_delete" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></button>',
            }],
            columns: [{
                data: 'name'
            }, {
                data: 'plateNumber'
            },{
                data: 'loadCapacity'
            }, {
                data: 'action'
            }, ]
        });
    </script>
@endpush