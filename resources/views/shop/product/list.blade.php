@foreach ($products as $product)
    <x-Shop.Product.Item :product="$product" />
@endforeach
