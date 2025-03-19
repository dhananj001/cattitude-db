<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-[#9f234a] bg-[#fef2f5] px-6 py-3 rounded-t-md shadow-md">
            Records
        </h2>
    </x-slot>




    <div class="mx-auto mt-6 w-[90%] max-w-[1400px]">
        <div class="bg-[#fff8f0] shadow-lg rounded-lg p-6 border border-[#e7a739]">

            <!-- Search & Add Button -->
            <div class="mb-4 flex justify-between">
                <form method="GET" action="{{ route('records.index') }}" class="w-full max-w-lg flex relative">
                    <div class="relative w-full">
                        <input type="text" id="searchInput" name="search" placeholder="Search records..."
                            value="{{ request('search') }}"
                            class="w-full border border-[#e7a739] bg-white text-gray-800 rounded-md px-3 py-2 focus:ring-[#e7a739] focus:border-[#e7a739] shadow-sm">
                        @if (request('search'))
                            <button type="button" id="clearSearch"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-red-500 text-xl">
                                ✖
                            </button>
                        @endif
                    </div>
                    <button type="submit"
                        class="ml-2 px-6 py-2 font-medium text-[#9f234a] border border-[#9f234a] bg-[#fef2f5]
    rounded-full shadow-sm hover:bg-[#f8d9e0] transition-all duration-200 ease-in-out">
                        Search
                    </button>

                </form>

                <a href="{{ route('records.create') }}"
                    class="bg-[#e7a739] text-white px-4 py-2 rounded-md hover:bg-[#d2922d] transition shadow">+ Add
                    Record</a>
            </div>


            {{-- Error message --}}
            {{-- @if ($errors->has('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 my-2">
                    {{ $errors->first('error') }}
                </div>
            @endif --}}

            {{-- Success message --}}
            {{-- @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 my-2">
                    {{ session('success') }}
                </div>
            @endif --}}

            @if (session('success') || session('error') || $errors->has('error'))
                @php
                    $isSuccess = session('success');
                    $bgColor = $isSuccess ? 'bg-green-100' : 'bg-red-100';
                    $progressColor = $isSuccess ? 'bg-green-200' : 'bg-red-200';
                @endphp

                <div id="alertBox"
                    class="relative px-6 py-3 my-3  shadow-lg transition-all duration-500 text-gray-800 overflow-hidden {{ $bgColor }}">

                    <!-- Progress Background -->
                    <div class="absolute inset-0 {{ $progressColor }} animate-progress"></div>

                    <div class="relative flex flex-col items-center text-center">
                        <div class="flex items-center gap-3">
                            <!-- Success Icon -->
                            @if ($isSuccess)
                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            @endif

                            <!-- Error Icon -->
                            @if (!$isSuccess)
                                {{-- <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg> --}}
                            @endif

                            <span class="text-sm relative">
                                {{ session('success') ?? (session('error') ?? $errors->first('error')) }}
                            </span>
                        </div>

                        <!-- Close Button -->
                        {{-- <button onclick="dismissAlert()" class="text-gray-800 hover:text-gray-600 relative">
                            &times;
                        </button> --}}
                    </div>
                </div>


            @endif








            <!-- Records Table -->
            <div class="overflow-x-auto">
                <table class="w-full border border-[#e7a739] text-sm rounded-md shadow-md">
                    <thead class="bg-[#f0eae3] text-gray-900">
                        <tr class="text-left">
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
                    <tbody class="bg-white">
                        @foreach ($records as $record)
                            <tr class="border-b border-[#e7a739] text-gray-900 hover:bg-[#fef2f5] transition">
                                <td class="p-3">{{ $record->first_name }}</td>
                                <td class="p-3">{{ $record->last_name }}</td>
                                <td class="p-3">{{ $record->address1 }}, {{ $record->address2 }}</td>
                                <td class="p-3">{{ $record->phone }}</td>
                                <td class="p-3">{{ $record->email }}</td>
                                <td class="p-3">{{ $record->reason }}</td>
                                <td class="p-3">
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full shadow-sm
                                        {{ $record->charged ? 'bg-green-100 text-green-700 border border-green-400' : 'bg-red-100 text-red-700 border border-red-400' }}">
                                        {{ $record->charged ? 'Yes' : 'No' }}
                                    </span>
                                </td>

                                <td class="p-3">{{ $record->user->name ?? 'N/A' }}</td>
                                <td class="p-3">{{ $record->created_at->format('Y-m-d') }}</td>
                                <td class="p-3 flex space-x-3">
                                    <!-- Edit Button -->
                                    <a href="{{ route('records.edit', $record->id) }}"
                                        class="text-[#9f234a] hover:text-[#871d3e]">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    @auth
                                        @if (auth()->user()->hasRole('admin'))
                                            <form method="POST" action="{{ route('records.destroy', $record->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')"
                                                    class="text-red-500 hover:text-red-600">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endauth

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
</x-app-layout>

<script>
    document.getElementById('clearSearch')?.addEventListener('click', function() {
        document.getElementById('searchInput').value = '';
        window.location.href = "{{ route('records.index') }}";
    });
</script>

<script>
    function dismissAlert() {
        let alertBox = document.getElementById('alertBox');
        alertBox.classList.add('opacity-0', 'translate-y-[-10px]');
        setTimeout(() => alertBox.remove(), 500);
    }

    setTimeout(dismissAlert, 4000);
</script>
