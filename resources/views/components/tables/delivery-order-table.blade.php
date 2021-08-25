<table id="delivery" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>No. Delivery</th>
            <th>Customer</th>
            <th>Vehicle</th>
            <th>Driver</th>
            <th></th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#delivery').DataTable({
            ordering: false,
            paging: false,
            dom: 't',
            ajax: {
                url: '{{ route("api.delivery") }}',
                type: 'GET',
                dataSrc: ''
            },
            columnDefs: [{
                targets: -1,
                defaultContent: "" +
                    '<button id="btn_edit" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>' +
                    '<button id="btn_delete" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></button>',
            }],
            columns: [{
                    data: 'date',
                    width: '10%',
                    className: "text-center"
                },
                {
                    data: 'for',
                    className: "text-left"
                },
                {
                    data: 'company.name',
                    className: "text-left",
                    defaultContent: '-'
                },{
                    data: 'vehicle.name',
                    className: "text-center",
                    defaultContent: '-'
                },
                {
                    data: 'driver.fullname',
                    className: "text-center",
                    defaultContent: '-'
                },
                {
                    data: 'action',
                    width: '5%',
                    className: "text-center dt-body-justify"
                },
            ]
        });

    </script>
    <script src="{{ url::asset('js/datatable/filter.js') }}"></script>
@endpush
