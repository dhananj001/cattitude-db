@if(Auth::user()->hasRole('admin'))

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
            {{-- @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    {{ session('error') }}
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

            <!-- Staff Table -->
            <div class="overflow-x-auto">
                <table class="w-full border border-[#e7a739] text-sm rounded-md shadow-md">
                    <thead class="bg-[#f0eae3] text-gray-900">
                        <tr class="text-left">
                            <th class="p-3">Name</th>
                            <th class="p-3">Email</th>
                            @if(Auth::user()->hasRole('admin'))
                                <th class="p-3">Role</th>

                            @endif
                            @if(Auth::user()->hasRole('admin'))
                            <th class="p-3">Assign Roles</th>
                            <th class="p-3">Actions</th>
                            @endif


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

                                @if(Auth::user()->hasRole('admin'))
                                <td class="p-3" id="roles-column-{{ $user->id }}">
                                    {{ $user->roles->pluck('name')->map(fn($role) => ucfirst($role))->implode(', ') }}
                                </td>

                                <td class="p-3">

                                    <div class="flex flex-col gap-3">
                                        @foreach ($roles as $role)
                                            <label class="flex items-center gap-2 text-gray-800">
                                                <input type="checkbox" class="toggle-role accent-[#e7a739] w-5 h-5"
                                                    data-user-id="{{ $user->id }}"
                                                    data-role-id="{{ $role->id }}"
                                                    {{ $user->roles->contains('id', $role->id) ? 'checked' : '' }}>
                                                <span>{{ ucfirst($role->name) }}</span>
                                            </label>
                                        @endforeach
                                    </div>

                            </td>
                                @endif



                                @if(Auth::user()->hasRole('admin'))
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
                                @endif

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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".toggle-role").forEach(checkbox => {
            checkbox.addEventListener("change", function() {
                let userId = this.dataset.userId;
                let roleId = this.dataset.roleId;
                let isChecked = this.checked;
                let url = isChecked ? `/users/${userId}/assignRole` :
                    `/users/${userId}/removeRole`;

                fetch(url, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            role_id: roleId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.message); // Debugging message
                        updateRolesColumn(userId); // Update left column dynamically
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    });

    function updateRolesColumn(userId) {
        fetch(`/users/${userId}/getRoles`) // Fetch updated roles
            .then(response => response.json())
            .then(data => {
                let rolesText = data.roles.length > 0 ? data.roles.join(", ") : "N/A";
                document.getElementById(`roles-column-${userId}`).innerText = rolesText;
            })
            .catch(error => console.error("Error updating roles column:", error));
    }
</script>

<script>
    function dismissAlert() {
        let alertBox = document.getElementById('alertBox');
        alertBox.classList.add('opacity-0', 'translate-y-[-10px]');
        setTimeout(() => alertBox.remove(), 500);
    }

    setTimeout(dismissAlert, 4000);
</script>


@else
    <p class="text-red-500">Unauthorized access.</p>
@endif
