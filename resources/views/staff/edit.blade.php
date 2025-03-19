<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-[#9f234a] bg-[#fef2f5] px-6 py-3 rounded-t-md shadow-md">
            Edit Staff Details
        </h2>
    </x-slot>

    <div class="mx-auto mt-6 w-[90%] max-w-[1400px]">
        <div class="bg-[#fff8f0] shadow-lg rounded-lg p-6 border border-[#e7a739]">
            <form method="POST" action="{{ route('staff.update', $staff->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-[#9f234a] font-medium mb-1">Name</label>
                        <input type="text" id="name" name="name" value="{{ $staff->name }}"
                            class="w-full border border-[#e7a739] bg-white text-gray-800 rounded-md px-3 py-2 focus:ring-[#e7a739] focus:border-[#e7a739] shadow-sm"
                            required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-[#9f234a] font-medium mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ $staff->email }}"
                            class="w-full border border-[#e7a739] bg-white text-gray-800 rounded-md px-3 py-2 focus:ring-[#e7a739] focus:border-[#e7a739] shadow-sm"
                            required>
                    </div>

                    <!-- Role -->
                    {{-- <div>
                        <label for="role" class="block text-[#9f234a] font-medium mb-1">Role</label>
                        <select id="role" name="role"
                            class="w-full border border-[#e7a739] bg-white text-gray-800 rounded-md px-3 py-2 focus:ring-[#e7a739] focus:border-[#e7a739] shadow-sm">
                            <option value="Admin" {{ $staff->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Staff" {{ $staff->role == 'Staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                    </div> --}}
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('staff.index') }}"
                        class="bg-[#9f234a] text-white px-4 py-2 rounded-md hover:bg-[#871d3e] transition shadow">
                        Cancel
                    </a>

                    <button type="submit"
                        class="bg-[#e7a739] text-white px-4 py-2 rounded-md hover:bg-[#d2922d] transition shadow">
                        Update Staff
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
