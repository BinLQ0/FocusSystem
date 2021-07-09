<table id="warehouse" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th class="text-center">Type</th>
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
                url: '{{ route("api.product.types") }}',
                type: 'GET',
                dataSrc: 'data'
            },
            columns: [{
                data: 'name'
            }, {
                data: 'description'
            }, {
                data: null,
                class: 'text-nowrap align-middle text-center',
                render: function(data, type, row) {

                    var badges = '';
                    if (data.isMaterial == "1") {
                        badges += '<small class="badge badge-warning mr-1"> Raw Material </small>';
                    }
                    if (data.isGoods == "1") {
                        badges += '<small class="badge badge-primary"> Finish Goods </small>';
                    }
                    return badges;
                },
            }, {
                data: null,
                width: '5%',
                className: "text-center dt-body-justify",
                render: function(data, type, row, meta) {
                    if (data.id > 3) {
                        return "" +
                            '<button id="btn_rack" class="btn btn-info btn-sm mr-1"><i class="fas fa-layer-group"></i></button>' +
                            '<button id="btn_edit" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>' +
                            '<button id="btn_delete" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></button>'
                    }

                    return '';
                },
            }, ]
        });

        $('.table tbody').on('click', '#btn_rack', function(e) {
            var data = dtable.row($(this).parents('tr')).data();
            window.open(window.location.href + '/' + data['id'] + '/racks');
        });
    </script>
@endpush