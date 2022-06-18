<x-dashboard.layout title="CineMagic - Carrinho de Compras" :header="$cart && !$cart->isEmpty() ? 'Carrinho de Compras' : ''">
    @if ($cart && !$cart->isEmpty())
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="w-full overflow-x-auto">
                <x-dashboard.cart-table :cart="$cart" />
            </div>
        </div>
        <div class="block w-full mt-4 text-gray-600 dark:text-gray-300">
            <div class="float-left font-semibold text-md">
                Valor total: {{ $cart->count() * ticket_price() }}€
            </div>
            <div class="float-right text-sm">
                <form method="POST" action="/cart">
                    @csrf
                    <x-dashboard.button class="{{ Auth::guest() ? 'button-disabled' : 'button-primary' }}" :disabled="true">
                        <svg class="w-5 h-5 mt-px mr-1" data-darkreader-inline-stroke="" fill="none" stroke="currentColor"
                            style="--darkreader-inline-stroke: currentColor;" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <x-slot:label>Pagamento</x-slot:label>
                        <x-slot:tooltip>Inicie sessão para proceder ao pagamento</x-slot:tooltip>
                    </x-dashboard.button>
                </form>
            </div>
        </div>
    @else
        <x-dashboard.empty-cart />
    @endif
</x-dashboard.layout>
