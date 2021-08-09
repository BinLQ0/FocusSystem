<tr>
    @if($canView('product'))
        <td>
            <x-select name='product[]' fgroup-class='mb-0' placeholder='Choose' :option='$productOption' :selected='$product ? [$product->id] : null' select2 />
        </td>
    @endif

    @if($canView('location'))
        <td>
            <x-select name="location[]" fgroup-class='mb-0' :option='$optionRacks()' :selected='$getSelectedLocation()' select2 />
        </td>
    @endif

    @if($canView('quantity'))
        <td>
            <x-input name="quantity[]" fgroup-class='mb-0' type="number" class="text-right sum" margin='mb-0' step='0.001' :value="$getQuantity()" />
        </td>
    @endif

    @if($canView('stock'))
        <td>
            <x-input name="stock[]" fgroup-class='mb-0' type="number" class="text-right stock" margin='mb-0' step='0.001' :value="$getStock()" readonly />
        </td>
    @endif

    <td class="align-middle">
        <button id="btn_delete_list" type='button' class="{{ $createActionButtonClass() }}" {{ $isActionButtonDisabled }}><i class="fas fa-trash"></i></button>
    </td>
</tr>