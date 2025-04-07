<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Udostępnianie zadania') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 hover:underline">← Wróć do listy zadań</a>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Zadanie: {{ $task->title }}</h3>

                <form method="POST" action="{{ route('tasks.share.store', $task) }}">
                    @csrf
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Wygeneruj nowy link udostępniania
                    </button>
                </form>

                <hr class="my-6"/>

                <h4 class="text-md font-semibold mb-2">Aktywne linki udostępniania:</h4>

                @forelse ($task->shareLinks as $link)
                    <div class="border p-4 rounded mb-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-700">{{ url('/share/' . $link->token) }}</p>
                            <p class="text-xs text-gray-500">Ważny do: {{ \Carbon\Carbon::parse($link->expires_at)->format('Y-m-d H:i') }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="navigator.clipboard.writeText('{{ url('/share/' . $link->token) }}')"
                                    class="text-sm text-blue-500 hover:underline">Kopiuj</button>
                            <form method="POST" action="{{ route('tasks.share.destroy', $link) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:underline">
                                    Usuń
                                </button>
                            </form>
                        </div>
                    </div>
                    
                @empty
                    <p class="text-sm text-gray-500">Brak aktywnych linków.</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
