<table id="dt-table" class="table style-3  table-hover">
    <thead>
        <tr>
            <th class="checkbox-column text-center">ID</th>
            <th>name</th>
            <th>slug</th>
            <th>status</th>
            <th class="text-center dt-no-sorting">{{ __('general.common.actions') }}</th>
        </tr>
    </thead>
</table>

@push('script')
    <script>
        let drawDT = 0;

        c3 = $('#dt-table').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sEmptyTable": "{{ __('general.common.empty_table_message') }}",
                "sInfo": "{{ __('general.common.showing_page', ['page' => '_PAGE_', 'pages' => '_PAGES_']) }}",
                "sInfoEmpty": "{{ __('general.common.showing_page', ['page' => '_PAGE_', 'pages' => '_PAGES_']) }}",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "{{ __('general.common.search') }}",
                "sLengthMenu": "{{ __('general.common.result') }} :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 25, 50, 100],
            "pageLength": 50,
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [0, 'desc']
            ],
            "ajax": {
                "url": "{{ route('admin.category.index') }}",
                "data": function(d) {
                    drawDT = d.draw;
                    d.limit = d.length;
                    d.page = d.start / d.length + 1;
                    // d.example_code = $('#sExampleCode').val();
                },
                "dataSrc": function(res) {
                    res.draw = drawDT;
                    res.recordsTotal = res.meta.total;
                    res.recordsFiltered = res.meta.total;
                    return res.data;
                }
            },
            "columns": [{
                    "data": "id",
                    "orderable": true,
                    "class":"text-center"
                },
                {
                    "data": "name",
                    "orderable": true,
                },
                {
                    "data": "slug",
                    "orderable": true
                },
                {
                    "data": "status",
                    "orderable": true,
                },
                {
                    "data": "id",
                    "class": "text-center",
                    "orderable": false,
                    "render": function(data, type, full) {
                        let detailUrl = "{{ route('admin.category.edit', ':id') }}";
                        detailUrl = detailUrl.replace(':id', data);
                        return `
                            <ul class="table-controls">
                                <li>
                                    <a href="${detailUrl}" class="bs-tooltip"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="{{ __('general.tooltip.edit') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-edit-2 p-1 br-6 mb-1">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        `
                    }
                }
            ],
        });
    </script>
@endpush
