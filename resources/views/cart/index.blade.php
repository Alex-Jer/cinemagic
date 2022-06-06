<x-dashboard.layout title="CineMagic - Carrinho de Compras" header="Carrinho">
    @foreach ($cart as $film)
        <p>{{ $film['id'] . ' - ' . $film['titulo'] }}</p>
    @endforeach
</x-dashboard.layout>
