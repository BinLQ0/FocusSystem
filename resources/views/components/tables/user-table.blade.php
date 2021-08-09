<table id="user" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            <th>Username</th>
            <th>Last Seen At</th>
            <th>IP Access</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

@push('js')
    <script>
        var dtable = $('#user').DataTable({
            ordering: false,
            paging: false,
            dom: 't',
            ajax: {
                url: '{{ route("api.users") }}',
                type: 'GET',
                dataSrc: 'data',
            },
            columnDefs: [{
                targets: -1,
                defaultContent: "" +
                    '<button id="btn_edit" class="btn btn-warning btn-sm mr-1"><i class="fas fa-edit"></i></button>' +
                    '<button id="btn_delete" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></button>',
            }],
            columns: [{
                data: 'username'
            }, {
                data: 'last_seen_at',
            }, {
                data: 'attempt_ip',
            }, {
                data: 'action',
                width: '5%',
            }]
        });
    </script>
@endpush