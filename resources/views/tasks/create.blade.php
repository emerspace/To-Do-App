<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Dodaj nowe zadanie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    @include('tasks.partials.form')

                    <div class="flex justify-end">
                        <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:underline mr-4">Anuluj</a>
                        <button type="submit"
                                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Dodaj zadanie
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
