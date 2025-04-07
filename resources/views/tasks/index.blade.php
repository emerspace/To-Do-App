<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Twoje zadania') }}
        </h2>
    </x-slot>
    @if(!auth()->user()->googleToken)
        <div class="mb-4">
            <a href="{{ route('google.redirect') }}"
            class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Połącz z Google Calendar
            </a>
        </div>
    @else
        <div class="mb-4">
            Google Calendar (Połaczony)
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('tasks.create') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Dodaj nowe zadanie
                    </a>
                </div>

                <form id="filter-form" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <select name="priority" class="border rounded p-2" onchange="submitFilters()">
                        <option value="">Wszystkie priorytety</option>
                        <option value="low">low</option>
                        <option value="medium">medium</option>
                        <option value="high">high</option>
                    </select>

                    <select name="status" class="border rounded p-2" onchange="submitFilters()">
                        <option value="">Wszystkie statusy</option>
                        <option value="to-do">to-do</option>
                        <option value="in progress">in progress</option>
                        <option value="done">done</option>
                    </select>

                    <input type="date" name="due_date" class="border rounded p-2" onchange="submitFilters()">
                </form>

                <div id="tasks-list">
                    @include('tasks.partials.list', ['tasks' => $tasks])
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitFilters() {
            const form = document.getElementById('filter-form');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);

            fetch(`/tasks?${params.toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('tasks-list').innerHTML = html;
            });
        }
    </script>
</x-app-layout>
