<div id="alert"
    class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-red-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
    <div class="flex items-center">

        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>

        <span class="ml-2">{{ $message }}</span>
    </div>
    <button id="close-alert">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<script>
    const divAlert = document.getElementById("alert");
    const btnClose = document.getElementById("close-alert");
    btnClose.onclick = function() {
        if (divAlert.style.display !== "none") {
            divAlert.style.display = "none";
        } else {
            divAlert.style.display = "block";
        }
    };
</script>
