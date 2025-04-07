<div class="mb-4">
    <label for="title" class="block text-gray-700">Tytuł zadania</label>
    <textarea name="title" rows="4"
        class="w-full border rounded px-3 py-2 mt-1 break-words whitespace-normal"
        maxlength="255"
        required>{{ old('title', $task->title ?? '') }}</textarea>
    @error('title')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-gray-700">Opis</label>
    <textarea name="description" rows="6" class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-indigo-500">{{ old('description', $task->description ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label class="block text-gray-700">Priorytet</label>
    <select name="priority" class="w-full border rounded px-3 py-2 mt-1">
        <option value="low" {{ old('priority', $task->priority ?? '') == 'low' ? 'selected' : '' }}>low</option>
        <option value="medium" {{ old('priority', $task->priority ?? '') == 'medium' ? 'selected' : '' }}>medium</option>
        <option value="high" {{ old('priority', $task->priority ?? '') == 'high' ? 'selected' : '' }}>high</option>
    </select>
</div>

<div class="mb-4">
    <label class="block text-gray-700">Status</label>
    <select name="status" class="w-full border rounded px-3 py-2 mt-1">
        <option value="to-do" {{ old('status', $task->status ?? '') == 'to-do' ? 'selected' : '' }}>to-do</option>
        <option value="in progress" {{ old('status', $task->status ?? '') == 'in progress' ? 'selected' : '' }}>in progress</option>
        <option value="done" {{ old('status', $task->status ?? '') == 'done' ? 'selected' : '' }}>done</option>
    </select>
</div>

<div class="mb-4">
    <label class="block text-gray-700">Termin</label>
    <input type="date" name="due_date" value="{{ old('due_date', isset($task) ? \Illuminate\Support\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}" class="w-full border rounded px-3 py-2 mt-1">
    @error('due_date')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
