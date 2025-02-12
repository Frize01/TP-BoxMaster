@props(['title' => null, 'type' => null])


<div class="@if($type == 'error') bg-red-600 text-white @else bg-white @endif rounded-lg border-gray-300 border p-3 shadow-lg fixed top-3 right-3 ml-2 max-w-96 sm:min-w-64 animate-fade-in z-50" id="deleted-card">
    <button type="button" id="buttonCloseCard" class="box-content rounded opacity-50 hover:opacity-100 absolute top-2 right-2">
        <svg class="fill-current @if($type != 'error') text-gray-600 @endif" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" height="25">
            <path class="heroicon-ui" d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"/>
        </svg>
    </button>
    <div class="ml-2 mr-6 @if($type != 'error') text-gray-500 @endif">
        @if($title)
            @if($type)
                <div class="inline-flex gap-2 items-center">
                    @if($type == 'success')
                        <div class="absolute -top-1 -left-1 rounded-full bg-[#0e9b6b] w-2 h-2 animate-ping"></div>
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#0e9b6b" width="16" height="16" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="sr-only">{{ __('word.check_icon') }}</span>
                    @elseif($type == 'warn' || $type == 'warning')
                        <div class="absolute -top-1 -left-1 rounded-full bg-[#ff5c21] w-2 h-2 animate-ping"></div>
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#ff5c21" width="16" height="16" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                        </svg>
                        <span class="sr-only">{{ __('word.warning_icon') }}</span>
                    @endif
            @endif
            <p class="font-semibold @if($type != 'error') text-black @endif²">{{ $title }}</p>
            @if($type)
                </div>
            @endif
        @endif
        {{ $slot }}

    </div>
    <script>
        buttonCloseCard.onclick = function() {
            document.getElementById('deleted-card').remove();
        }
    </script>
</div>