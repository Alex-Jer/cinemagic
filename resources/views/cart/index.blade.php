<x-dashboard.layout title="CineMagic - Carrinho de Compras" :header="$cart && !$cart->isEmpty() ? 'Carrinho de Compras' : ''">
    @if ($cart && !$cart->isEmpty())
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="w-full overflow-x-auto">
                <x-dashboard.cart-table :cart="$cart" />
            </div>
        </div>
    @else
        <x-dashboard.empty-cart />
    @endif
</x-dashboard.layout>
