<tr class="text-center ftco-animated" data-row="{{ $item->id }}">
    <td class="product-remove"><a href="javascript:void(0)" onClick="removeCart({{ $item->id }})"><span
                class="ion-ios-close"></span></a></td>
    <td class="image-prod">
        <div class="img" style="background-image:url('{{ $item->product->images }}');">
        </div>
    </td>

    <td class="product-name">
        <h3>{{ $item->product->title }}</h3>
    </td>

    <td class="price">{{ Helpers::formatCurrency($item->product->price) }}</td>

    <td class="quantity">
        <div class="input-group mb-3">
            <input type="number" name="quantity" data-id="{{ $item->id }}" onkeyup="updateCart(event, {{ $item->id }})"
                oninput="updateCart(event, {{ $item->id }})" class="quantity form-control input-number"
                value="{{ $item->quantity }}" min="1" max="{{ $item->product->quantity }}">
        </div>
    </td>

    <td class="total" data-price="{{ $item->id }}">
        {{ Helpers::formatCurrency($item->product->price * $item->quantity) }}</td>
</tr>