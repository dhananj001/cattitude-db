<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg text-center font-semibold text-[#7c4e18] bg-[#ffffff] px-4 rounded-t-md">
            Add New Record
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto my-3">
        <div class="bg-[#fef2f5] shadow-md rounded-lg p-4 border border-[#e7a739]">
            <form action="{{ route('records.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm text-[#9f234a]">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                            class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">
                        @error('first_name')
                            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-[#9f234a]">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                            class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">
                        @error('last_name')
                            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div>
                        <label class="text-sm text-[#9f234a]">Address 1</label>
                        <input type="text" name="address1" value="{{ old('address1') }}"
                            class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">
                        @error('address1')
                            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-[#9f234a]">Address 2</label>
                        <input type="text" name="address2" value="{{ old('address2') }}"
                            class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">
                        @error('address2')
                            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3 mt-3">
                    <div>
                        <label class="text-sm text-[#9f234a]">City</label>
                        <input type="text" name="city" value="{{ old('city') }}"
                            class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">
                        @error('city')
                            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-[#9f234a]">State</label>
                        <input type="text" name="state" value="{{ old('state') }}"
                            class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">
                        @error('state')
                            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-[#9f234a]">ZIP</label>
                        <input type="text" name="zip" value="{{ old('zip') }}"
                            class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">
                        @error('zip')
                            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div>
                        <label class="text-sm text-[#9f234a]">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">
                        @error('phone')
                            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-[#9f234a]">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">
                        @error('email')
                            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <label class="text-sm text-[#9f234a]">Reason</label>
                    <textarea name="reason" rows="1"
                        class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">{{ old('reason') }}</textarea>
                    @error('reason')
                        <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div>
                        <label class="text-sm text-[#9f234a]">Charged</label>
                        <select name="charged"
                            class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('charged')
                            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-[#9f234a]">Comment</label>
                        <textarea name="comment" rows="1"
                            class="w-full border-[#e7a739] bg-white rounded px-3 py-1.5 focus:ring-[#9f234a]">{{ old('comment') }}</textarea>
                        @error('comment')
                            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div>
                        <label class="text-sm text-[#9f234a]">Added By</label>
                        <input type="text" value="{{ auth()->user()->name }}" readonly
                            class="w-full border-[#e7a739] bg-gray-200 rounded px-3 py-1.5">
                    </div>
                    <div>
                        <label class="text-sm text-[#9f234a]">Date</label>
                        <input type="text" value="{{ now()->format('Y-m-d') }}" readonly
                            class="w-full border-[#e7a739] bg-gray-200 rounded px-3 py-1.5">
                    </div>
                </div>

                <button type="submit"
                    class="mt-4 w-full bg-[#9f234a] text-[#f0eae3] py-2 rounded-lg hover:bg-[#7d1a3b] transition">
                    Save Record
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
