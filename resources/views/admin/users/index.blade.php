<x-dashboard.layout title="CineMagic - Utilizadores" header="Gestão de Utilizadores">
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <form method="get" action="{{ route('admin.users.create') }}">
                @csrf
                <x-dashboard.button label="Criar">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                        </path>
                    </svg>
                </x-dashboard.button>
            </form>
            <x-dashboard.users-table :users="$users" :authUser="$authUser" />
        </div>
        {{ $users->onEachSide(2)->links() }}
    </div>
</x-dashboard.layout>
