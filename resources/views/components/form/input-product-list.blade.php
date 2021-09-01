@if($location == 'all')
    <input type="hidden" name="all_location" value="1">
@endif

<table id="material" class="table table-hover text-nowrap datatable" style="width:100%">
    <thead>
        <tr>
            @if($canView('product'))
                <th width='30%'>{{ $title }}</th>
            @endif

            @if($canView('location'))
                <th class='text-center' width='30%'>Location</th>
            @endif

            @if($canView('quantity'))
                <th class='text-center' width='19%'>Quantity</th>
            @endif

            @if($canView('stock'))
                <th class='text-center' width='19%'>Stock</th>
            @endif

            <th width='2%'></th>
        </tr>
    </thead>
    <tbody>

        @if(old('product'))
            @foreach(old('product') as $value)
                <x-product-list :product-option='$productOption' :row='$loop' :views=$views />
            @endforeach
        @else

            @isset($products)
                @foreach($products as $product)
                    <x-product-list :product-option='$productOption' :product='$product' :row='$loop' :views=$views />
                @endforeach
            @endisset

            <x-product-list :product-option='$productOption' :views=$views />
        @endif
    </tbody>
</table>

@push('js')
    <script>
        $(document).ready(function() {
            var $location = $('select[name="location[]"]');
            var $product = $('select[name="product[]"]');

            // Check if has product input and get location option
            if (!$product.length) {
                $(this).setLocationOption($location, {
                    stock: $(this).hasViewStock(),
                });
            }

            $(this).displayTotal();
        });

        /*************************************************
         * @function to check display stock is exist.
         *************************************************/
        $.fn.hasViewStock = function() {
            return $('input[name="stock[]"]').length ? 1 : 0;
        };

        /*************************************************
         * @function to display the total product quantity.
         *************************************************/
        $.fn.displayTotal = function() {
            var $materialUsed = $('input[name="materialUsed"]');

            // Calculation each row
            var total = 0
            $(".sum").each(function() {
                total += parseFloat($(this).val());
            });

            var materialLoss = $materialUsed.val() - total;
            materialLoss = Number.parseFloat(materialLoss.toFixed(3));

            $("span[id='total'").text(' ' + total + ' Kg');
            $("input[name='materialLoss'").val(' ' + materialLoss);
        };

        /*************************************************
         * @function rule validation stock.
         *************************************************/
        $.fn.validationStock = function(index) {

            stock = dtable.row(index).nodes().to$().find('input[name="stock[]"').val();
            stock = Number.parseFloat(stock);

            value = dtable.row(index).nodes().to$().find('input[name="quantity[]"').val();
            value = Number.parseFloat(value);

            if (value > stock) {
                dtable.row(index).nodes().to$().find('.stock').addClass("bg-warning").removeClass("bg-success");
            } else {
                dtable.row(index).nodes().to$().find('.stock').addClass("bg-success").removeClass("bg-warning");
            }
        };

        /*************************************************
         * @function to used set location into select element.
         *************************************************/
        $.fn.setLocationOption = function($location, param) {
            $location.select2({
                placeholder: 'Choose ... ',
                ajax: {
                    url: '{{ route("api.racks") }}',
                    data: param,
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.code,
                                    quantity: obj.quantity
                                };
                            })
                        };
                    }
                }
            });
        };

        /*******************************************************
         * @event Location option base on Product Select Element.
         *******************************************************/
        $('#material tbody').on('select2:select', 'select[name="product[]"]', function(e) {
            var index = $(this).closest("tr");
            var $is_all_location = $('input[name="all_location"]');

            // Set Params to Get Location
            var params = {
                product: $(this).val(),
                stock: $(this).hasViewStock(),
                all_location: $is_all_location.val(),
            };

            // Get Location
            var $location = dtable.row(index).nodes().to$()
                .find('select[name="location[]')
                .val(-1)
                .trigger('change');

            $(this).setLocationOption($location, params);
        });

        /***********************************
         * Setup Datatables.
         ***********************************/
        var dtable = $('#material').DataTable({
            paging: false,
            order: false,
            info: false,
            lengthChange: false,
            searching: false
        });

        dtable.rows().every(function(rowIdx, tableLoop, rowLoop) {
            var $row = dtable.row(this);
            var $product = $row.nodes().to$().find('select[name="product[]"]');

            $(this).validationStock(rowIdx);
        });


        /***********************************
         * @event Button Delete Row Datatable.
         ***********************************/
        $('#material tbody').on('click', 'button[id="btn_delete_list"]', function() {
            dtable.row($(this).parents('tr'))
                .remove()
                .draw();
        });


        /***********************************
         * @event Element on row has change.
         ***********************************/
        $('#material tbody').on('change', 'td', function(e) {
            var $row = dtable.row(this);
            var $value = $row.nodes().to$().find('.sum');
            var $select = $row.nodes().to$().find('.select2');
            var $button = $row.nodes().to$().find('button[id=btn_delete_list]');

            var length = dtable.page.info().recordsTotal;
            var index = $row.index();

            // add row if select element has change and not empty
            if ($select.val()) {

                // Check it at last row 
                if (index == length - 1) {

                    $button.removeAttr('disabled').addClass("btn-danger").removeClass("btn-secondary");

                    // Clone Row
                    var $nextRow = dtable.row.add($row.data()).draw();
                    var $location = $nextRow.nodes().to$().find('select[name="location[]"]');

                    $nextRow.nodes().to$().find(".select2").select2({
                        placeholder: 'Choose...'
                    });

                    $nextRow.nodes().to$().find(".select2").val(-1).trigger('change');
                    $nextRow.nodes().to$().find("input[name='quantity[]']").val(0);

                    $(this).setLocationOption($location);
                }
            } else if (index != length - 1) {
                $row.remove().draw();
            }

            // Check is empty and put default number
            if ($value.val() == '') {
                $row.nodes().to$().find('.sum').val(0);
            }

            $(this).displayTotal();
        });

        /*******************************************************
         * @event Display Stock option base on Product and Location Select Element.
         *******************************************************/
        $('#material tbody').on('select2:select', 'select[name="location[]"]', function(evt) {
            var index = $(this).closest("tr");

            // Get Stock
            var $stock = dtable.row(index).nodes().to$()
                .find('input[name="stock[]');

            // Set Stock Value
            var quantity = Number.parseFloat((evt.params.data.quantity || 0).toFixed(3));
            $stock.val(quantity);

            $(this).validationStock(index);
        });

        /*******************************************************
         * @event Element Quantity has Change and run validation rule.
         *******************************************************/
        $('#material tbody').on('keyup', 'input[name="quantity[]"]', function(e) {
            var index = $(this).closest("tr");

            $(this).validationStock(index);
        });
    </script>
@endpush