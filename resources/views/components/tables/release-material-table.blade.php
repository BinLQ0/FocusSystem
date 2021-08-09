<table id="release" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th width='22%'>Date</th>
            <th width='22%'>No. Lot</th>
            <th width='22%'>Product</th>
            <th width='22%'>Status</th>
            <th width='2%'></th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#release').DataTable({
            ordering: false,
            paging: false,
            dom: 't',
            ajax: {
                url: '{{ route("api.release") }}',
                type: 'GET',
                data: function(data) {
                    data.status     = $('select[name="status"]').val();
                    data.startDate  = $('input[name="srcDateStart"]').val();
                    data.endDate    = $('input[name="srcDateEnd"]').val();
                },
                dataSrc: 'data',
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
            }, {
                data: 'lot',
                className: "text-center"
            }, {
                data: 'description',
                className: "text-center",
                defaultContent: "N/A"
            }, {
                data: 'isClosed',
                className: "text-center",
                render: function(data, type, row) {
                    if (data) {
                        return '<span class="badge bg-success"> Finished </span>';
                    }

                    return '<span class="badge bg-warning"> on Process </span>'
                }
            }, {
                data: 'action',
                className: "text-center dt-body-justify"
            }, ]
        });
    </script>
    <script src="{{ url::asset('js/datatable/filter.js') }}"></script>
@endpush