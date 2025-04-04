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

            <div class="w-full overflow-x-auto custom-scrollbar">
                <table class="min-w-full border border-[#e7a739] text-sm rounded-md shadow-md">
                    <thead class="bg-[#f0eae3] text-gray-900">
                        <tr class="text-left">
                            <th class="p-2 min-w-[80px] max-w-[120px]">First Name</th>
                            <th class="p-2 min-w-[80px] max-w-[120px]">Last Name</th>
                            <th class="p-2 min-w-[80px] max-w-[120px]">City</th>
                            <th class="p-2 min-w-[50px] max-w-[80px]">State</th>
                            <th class="p-2 min-w-[70px] max-w-[90px]">ZIP</th>
                            <th class="p-2 min-w-[100px] max-w-[150px]">Phone</th>
                            <th class="p-2 min-w-[180px] max-w-[300px]">Email</th>
                            <th class="p-2 min-w-[80px] max-w-[100px]">Charged</th>
                            <th class="p-2 min-w-[150px] max-w-[200px]">Added By</th>
                            <th class="p-2 min-w-[120px] max-w-[150px]">Date</th>
                            <th class="p-2 min-w-[100px] max-w-[120px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($records as $record)
                            <tr class="border-b border-[#e7a739] text-gray-900 hover:bg-[#fef2f5] transition cursor-pointer"
                                onclick="showPopup('{{ e($record->id) }}', '{{ e($record->first_name) }}', '{{ e($record->last_name) }}', '{{ e($record->address1 . ', ' . $record->address2) }}', '{{ e($record->city) }}', '{{ e($record->state) }}', '{{ e($record->zip) }}', '{{ e($record->phone) }}', '{{ e($record->email) }}', `{{ e($record->reason) }}`, '{{ $record->charged ? 'Yes' : 'No' }}', `{{ e($record->comment) }}`, '{{ $record->user->name ?? 'N/A' }}', '{{ $record->created_at->format('d-m-Y') }}')">
                                <td
                                    class="p-2 min-w-[80px] max-w-[120px] whitespace-normal break-words align-top text-justify">
                                    {{ $record->first_name }}</td>
                                <td
                                    class="p-2 min-w-[80px] max-w-[120px] whitespace-normal break-words align-top text-justify">
                                    {{ $record->last_name }}</td>
                                <td
                                    class="p-2 min-w-[80px] max-w-[120px] whitespace-normal break-words align-top text-justify">
                                    {{ $record->city }}</td>
                                <td
                                    class="p-2 min-w-[50px] max-w-[80px] whitespace-normal break-words align-top text-justify">
                                    {{ $record->state }}</td>
                                <td
                                    class="p-2 min-w-[70px] max-w-[90px] whitespace-normal break-words align-top text-justify">
                                    {{ $record->zip }}</td>
                                <td
                                    class="p-2 min-w-[100px] max-w-[150px] whitespace-normal break-words align-top text-justify">
                                    {{ $record->phone }}</td>
                                <td
                                    class="p-2 min-w-[180px] max-w-[300px] whitespace-normal break-words align-top text-justify">
                                    {{ $record->email }}</td>
                                <td class="p-2 min-w-[80px] max-w-[100px] align-top text-center">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full shadow-sm {{ $record->charged ? 'bg-green-100 text-green-700 border border-green-400' : 'bg-red-100 text-red-700 border border-red-400' }}">
                                        {{ $record->charged ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td
                                    class="p-2 min-w-[150px] max-w-[200px] whitespace-normal break-words align-top text-justify">
                                    {{ $record->user->name ?? 'N/A' }}</td>
                                <td
                                    class="p-2 min-w-[120px] max-w-[150px] whitespace-normal break-words align-top text-justify">
                                    {{ $record->created_at->format('d-m-Y') }}</td>
                                <td class="p-2 min-w-[100px] max-w-[120px] flex space-x-3">

                                    <!-- Edit Button -->
                                    <a href="{{ route('records.edit', $record->id) }}"
                                        class="text-[#9f234a] hover:text-[#871d3e]" onclick="event.stopPropagation()">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Delete Button -->
                                    @auth
                                        @if (auth()->user()->hasRole('admin'))
                                            <form method="POST" action="{{ route('records.destroy', $record->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')"
                                                    class="text-red-500 hover:text-red-600"
                                                    onclick="event.stopPropagation()">
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

        <!-- Popup Modal -->
        <div id="recordPopup"
            class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 transition-opacity duration-300">
            <div
                class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-2xl border-t-4 border-[#e7a739] transform transition-all duration-300 scale-95 max-h-[100vh] overflow-hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 id="popupFullName" class="text-3xl font-bold text-gray-900 tracking-tight"></h2>
                    <button onclick="closePopup()"
                        class="text-[#9f234a] hover:text-[#871d3e] text-3xl font-semibold transition-colors duration-200">×</button>
                </div>
                <div id="popupContent"
                    class="space-y-6 text-gray-900 overflow-y-auto pr-3 max-h-[75vh] scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-transparent rounded-b-2xl py-3">
                    <!-- Dynamic content injected here -->
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

<script>
    function showPopup(id, firstName, lastName, address, city, state, zip, phone, email, reason, charged, comment,
        addedBy, date) {
        const popup = document.getElementById('recordPopup');
        const popupFullName = document.getElementById('popupFullName');
        const popupContent = document.getElementById('popupContent');

        // Set full name as heading
        popupFullName.textContent = `${firstName} ${lastName}`;

        // Clear previous content
        popupContent.innerHTML = "";

        // Function to decode HTML entities
        function decodeHTML(text) {
            const doc = new DOMParser().parseFromString(text, "text/html");
            return doc.documentElement.textContent;
        }

        // Function to create and append text-based elements
        function createInfoBlock(label, value) {
            const div = document.createElement("div");
            div.classList.add("bg-[#f0eae3]", "p-4", "rounded-lg", "shadow-sm");

            const heading = document.createElement("h3");
            heading.classList.add("text-sm", "font-semibold", "text-[#9f234a]", "uppercase", "tracking-wide", "mb-2");
            heading.textContent = label;

            const paragraph = document.createElement("p");
            paragraph.classList.add("text-gray-800");
            // paragraph.textContent = decodeHTML(value);
            paragraph.innerHTML = decodeHTML(value).replace(/\r\n|\r|\n/g, "<br>");

            div.appendChild(heading);
            div.appendChild(paragraph);
            popupContent.appendChild(div);
        }

        // Function to create and append inline text-based elements
        function createInlineInfo(label, value) {
            const p = document.createElement("p");
            p.innerHTML = `<strong>${label}:</strong> <span class="font-medium text-gray-900">${value}</span>`;
            return p;
        }

        // Add Email and Phone
        const contactDiv = document.createElement("div");
        contactDiv.classList.add("flex", "flex-col", "space-y-2");

        contactDiv.appendChild(createInlineInfo("Email", email));
        contactDiv.appendChild(createInlineInfo("Phone", phone));
        popupContent.appendChild(contactDiv);

        // Add Address, Reason, and Comment
        createInfoBlock("Address", `${address}, ${city}, ${state} ${zip}`);
        createInfoBlock("Reason", reason);
        createInfoBlock("Comment", comment);

        // Add Added By and Date at the bottom
        const extraInfoDiv = document.createElement("div");
        extraInfoDiv.classList.add("flex", "justify-between", "text-sm", "text-gray-600");
        extraInfoDiv.appendChild(createInlineInfo("Added By", addedBy));
        extraInfoDiv.appendChild(createInlineInfo("Date", date));

        popupContent.appendChild(extraInfoDiv);

        // Show popup
        popup.classList.remove('hidden');

        // Smooth futuristic animation
        popup.style.opacity = "0";
        popup.style.transform = "scale(0.9)";
        setTimeout(() => {
            popup.style.transition = "opacity 0.2s ease-out, transform 0.2s ease-out";
            popup.style.opacity = "1";
            popup.style.transform = "scale(1)";
        }, 10);
    }

    function closePopup() {
        const popup = document.getElementById('recordPopup');

        // Apply closing animation
        popup.style.transition = "opacity 0.15s ease-in, transform 0.15s ease-in";
        popup.style.opacity = "0";
        popup.style.transform = "scale(0.9)";

        // Hide after animation completes
        setTimeout(() => {
            popup.classList.add('hidden');
            popup.style.transition = ""; // Reset transition
        }, 250);
    }

    // Close popup when clicking outside
    document.getElementById('recordPopup').addEventListener('click', function(e) {
        if (e.target === this) {
            closePopup();
        }
    });
</script>

