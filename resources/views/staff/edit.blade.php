<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-[#fef2f5]">
        <div class="w-full max-w-md bg-white shadow-xl rounded-xl p-8 border border-[#e7a739]">

            <!-- Title -->
            <h2 class="text-2xl font-semibold text-[#9f234a] text-center mb-6">Edit Staff Details</h2>

            <!-- Success & Error Messages -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded-md shadow-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 rounded-md shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded-md shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('staff.update', $staff->id) }}" class="space-y-5" x-data="{ showPasswordFields: false }">
                @csrf
                @method('PUT')

                <!-- Name & Email -->
                <div>
                    <label for="name" class="block text-[#9f234a] font-medium mb-1">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $staff->name) }}" required
                        placeholder="Enter full name"
                        class="w-full border border-[#e7a739] bg-white text-gray-800 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e7a739] focus:border-[#e7a739] shadow-sm transition-all">
                </div>

                <div>
                    <label for="email" class="block text-[#9f234a] font-medium mb-1">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $staff->email) }}" required
                        placeholder="Enter email"
                        class="w-full border border-[#e7a739] bg-white text-gray-800 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e7a739] focus:border-[#e7a739] shadow-sm transition-all">
                </div>

                <!-- Change Password Link -->
                <div class="mt-3">
                    <button type="button" @click="showPasswordFields = !showPasswordFields"
                        class="text-[#9f234a] hover:text-[#871d3e] text-sm font-medium transition-all">
                        Change Password
                    </button>
                </div>

                <!-- Password Fields (Hidden Initially) -->
                <div x-show="showPasswordFields" x-cloak>
                    <div class="mt-4">
                        <label for="password" class="block text-[#9f234a] font-medium mb-1">New Password</label>
                        <input type="password" id="password" name="password"
                            placeholder="Enter new password"
                            class="w-full border border-[#e7a739] bg-white text-gray-800 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e7a739] focus:border-[#e7a739] shadow-sm transition-all">
                    </div>

                    <div class="mt-4">
                        <label for="password_confirmation" class="block text-[#9f234a] font-medium mb-1">
                            Confirm New Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Re-enter new password"
                            class="w-full border border-[#e7a739] bg-white text-gray-800 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e7a739] focus:border-[#e7a739] shadow-sm transition-all">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex justify-between items-center">
                    <a href="{{ route('staff.index') }}"
                        class="text-[#9f234a] hover:text-[#871d3e] text-sm font-medium transition-all">
                        Cancel
                    </a>

                    <button type="submit"
                        class="bg-[#e7a739] text-white px-5 py-2 rounded-lg hover:bg-[#d2922d] transition-all shadow-md">
                        Update Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
