<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold pl-32 text-[#7c4e18] bg-[#ffffff] px-6 py-3 rounded-t-md">
            Add New Record
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <div class="bg-[#f0eae3] shadow-md rounded-md p-6">
            <form action="{{ route('records.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[#9f234a]">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                            class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">
                        @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-[#9f234a]">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                            class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">
                        @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="text-[#9f234a]">Address 1</label>
                        <input type="text" name="address1" value="{{ old('address1') }}"
                            class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">
                        @error('address1') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-[#9f234a]">Address 2</label>
                        <input type="text" name="address2" value="{{ old('address2') }}"
                            class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">
                        @error('address2') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mt-4">
                    <div>
                        <label class="text-[#9f234a]">City</label>
                        <input type="text" name="city" value="{{ old('city') }}"
                            class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">
                        @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-[#9f234a]">State</label>
                        <input type="text" name="state" value="{{ old('state') }}"
                            class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">
                        @error('state') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-[#9f234a]">ZIP</label>
                        <input type="text" name="zip" value="{{ old('zip') }}"
                            class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">
                        @error('zip') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="text-[#9f234a]">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">
                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-[#9f234a]">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label class="text-[#9f234a]">Reason</label>
                    <textarea name="reason"
                        class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">{{ old('reason') }}</textarea>
                    @error('reason') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <label class="text-[#9f234a]">Charged</label>
                    <select name="charged"
                        class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    @error('charged') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <label class="text-[#9f234a]">Comment</label>
                    <textarea name="comment"
                        class="w-full border-[#e7a739] bg-white rounded-md px-3 py-2 focus:ring-[#9f234a]">{{ old('comment') }}</textarea>
                    @error('comment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="text-[#9f234a]">Added By</label>
                        <input type="text" value="{{ auth()->user()->name }}" readonly
                            class="w-full border-[#e7a739] bg-gray-200 rounded-md px-3 py-2">
                    </div>

                    <div>
                        <label class="text-[#9f234a]">Date</label>
                        <input type="text" value="{{ now()->format('Y-m-d') }}" readonly
                            class="w-full border-[#e7a739] bg-gray-200 rounded-md px-3 py-2">
                    </div>
                </div>

                <button type="submit"
                    class="mt-6 bg-[#9f234a] text-[#f0eae3] px-4 py-2 rounded-md hover:bg-[#7d1a3b] transition">
                    Save Record
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
