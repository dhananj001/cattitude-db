<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-[#9f234a] bg-[#fef2f5] px-6 py-3 rounded-t-md shadow-md">
            Staff Management
        </h2>
    </x-slot>

    <div class="mx-auto mt-6 w-[90%] max-w-[1400px]">
        <div class="bg-[#fff8f0] shadow-lg rounded-lg p-6 border border-[#e7a739]">

            <!-- Search -->
            <div class="mb-4 flex justify-between">
                <form method="GET" action="{{ route('staff.index') }}" class="w-full max-w-lg flex relative">
                    <div class="relative w-full">
                        <input type="text" id="searchInput" name="search" placeholder="Search staff..."
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

                <a href="{{ route('staff.create') }}"
                    class="bg-[#e7a739] text-white px-4 py-2 rounded-md hover:bg-[#d2922d] transition shadow">
                    + Add Staff
                </a>
            </div>
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Staff Table -->
            <div class="overflow-x-auto">
                <table class="w-full border border-[#e7a739] text-sm rounded-md shadow-md">
                    <thead class="bg-[#f0eae3] text-gray-900">
                        <tr class="text-left">
                            <th class="p-3">Name</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Role</th>
                            <th class="p-3">Admin</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($staff as $user)
                            <tr class="border-b border-[#e7a739] text-gray-900 hover:bg-[#fef2f5] transition">
                                <td class="p-3">{{ $user->name }}</td>
                                <td class="p-3">{{ $user->email }}</td>
                                {{-- <td class="p-3">
                                    {{ $user->roles->first()->name ?? 'N/A' }}
                                </td> --}}
                                <td class="p-3">
                                    {{ $user->roles->pluck('name')->map(fn($role) => ucfirst($role))->implode(', ') }}
                                </td>

                                <td class="p-3">
                                    <div class="bg-white shadow-md rounded-lg p-3 flex flex-col space-y-2">
                                        <!-- Assign Role Form -->
                                        <form action="{{ route('users.assignRole', $user->id) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            <select name="role_id" class="border rounded-lg px-3 py-2 w-40 bg-gray-100 text-gray-700 focus:ring focus:ring-green-300">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-3 py-2 rounded-lg shadow">
                                                Assign
                                            </button>
                                        </form>

                                        <!-- Remove Role Form -->
                                        <form action="{{ route('users.removeRole', $user->id) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            <select name="role_id" class="border rounded-lg px-3 py-2 w-40 bg-gray-100 text-gray-700 focus:ring focus:ring-red-300">
                                                @foreach ($user->roles as $role)
                                                    <option value="{{ $role->id }}">
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-2 rounded-lg shadow">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </td>




                                <td class="p-3 flex space-x-3">
                                    <a href="{{ route('staff.edit', $user->id) }}"
                                        class="text-[#9f234a] hover:text-[#871d3e]">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    @auth
                                        @if (auth()->user()->hasRole('admin'))
                                            <form method="POST" action="{{ route('staff.destroy', $user->id) }}">
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
                {{ $staff->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('clearSearch')?.addEventListener('click', function() {
        document.getElementById('searchInput').value = '';
        window.location.href = "{{ route('staff.index') }}";
    });
</script>
