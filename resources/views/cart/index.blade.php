<x-dashboard.layout title="CineMagic - Carrinho de Compras" :header="$cart && !$cart->isEmpty() ? 'Carrinho de Compras' : ''">
    @if ($cart && !$cart->isEmpty())
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="w-full overflow-x-auto">
                <x-dashboard.cart-table :cart="$cart" :price="$price" />
            </div>
        </div>
        <div class="block w-full mt-4 text-gray-600 dark:text-gray-300">
            <div class="float-left font-semibold text-md">
                Valor total: {{ $cart->count() * $price }}€
            </div>
            <div class="float-right text-sm">
                <form method="POST" action="/cart">
                    @csrf
                    <x-dashboard.button label="Pagamento">
                        <svg class="w-5 h-5 mt-px mr-1" data-darkreader-inline-stroke="" fill="none" stroke="currentColor"
                            style="--darkreader-inline-stroke: currentColor;" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </x-dashboard.button>
                </form>
            </div>
        </div>
    @else
        <x-dashboard.empty-cart />
    @endif
</x-dashboard.layout>
