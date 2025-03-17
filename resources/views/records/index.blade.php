<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Records List') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">

                <!-- Search Bar -->
                <div class="mb-4 flex justify-between">
                    <form method="GET" action="{{ route('records.index') }}" class="w-full max-w-lg flex relative">
                        <!-- Search Input -->
                        <div class="relative w-full">
                            <input type="text" id="searchInput" name="search" placeholder="Search records..."
                                value="{{ request('search') }}"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md p-2 w-full pr-10">

                            <!-- Clear Button (✖ inside input) -->
                            @if (request('search'))
                                <button type="button" id="clearSearch"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600 dark:text-gray-400 hover:text-red-500 text-xl">
                                    <b>x</b>
                                </button>
                            @endif
                        </div>

                        <!-- Search Button -->
                        <button type="submit" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded-md">Search</button>
                    </form>

                    <!-- Add Record Button -->
                    <a href="{{ route('records.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">+ Add
                        Record</a>
                </div>




                <!-- Records Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 dark:border-gray-700 text-sm">
                        <thead class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            <tr>
                                <th class="p-3">First Name</th>
                                <th class="p-3">Last Name</th>
                                <th class="p-3">Address</th>
                                <th class="p-3">Phone</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">Reason</th>
                                <th class="p-3">Charged</th>
                                <th class="p-3">Added By</th>
                                <th class="p-3">Date</th>
                                <th class="p-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr
                                    class="border-b border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100">
                                    <td class="p-3">{{ $record->first_name }}</td>
                                    <td class="p-3">{{ $record->last_name }}</td>
                                    <td class="p-3">{{ $record->address1 }}, {{ $record->address2 }}</td>
                                    <td class="p-3">{{ $record->phone }}</td>
                                    <td class="p-3">{{ $record->email }}</td>
                                    <td class="p-3">{{ $record->reason }}</td>
                                    <td class="p-3">
                                        <span
                                            class="px-2 py-1 text-xs font-bold rounded
                                            {{ $record->charged ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                            {{ $record->charged ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        {{ $record->user->name ?? 'N/A' }}
                                    </td>

                                    <td class="p-3">{{ $record->created_at->format('Y-m-d') }}</td>
                                    <td class="p-3 flex space-x-2">
                                        <a href="{{ route('records.edit', $record->id) }}"
                                            class="text-blue-500">Edit</a>
                                        {{-- @if (auth()->user()->isAdmin()) --}}
                                        <form method="POST" action="{{ route('records.destroy', $record->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $records->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('clearSearch')?.addEventListener('click', function() {
        document.getElementById('searchInput').value = ''; // Clear the input
        window.location.href = "{{ route('records.index') }}"; // Reload the page without search
    });
</script>
