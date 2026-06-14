<x-filament::page>
    {{ $this->form }}

    @if(property_exists($this, 'heroPreviewUrl') && $this->heroPreviewUrl)
    <div class="mt-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Current Image</p>
        <img src="{{ $this->heroPreviewUrl }}" class="rounded-lg shadow-md max-h-64 w-auto" alt="Hero preview" />
    </div>
    @endif

    @if(property_exists($this, 'detailsPreviewUrl') && $this->detailsPreviewUrl)
    <div class="mt-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Current Image</p>
        <img src="{{ $this->detailsPreviewUrl }}" class="rounded-lg shadow-md max-h-64 w-auto" alt="Details preview" />
    </div>
    @endif

    @if(property_exists($this, 'beachPreviewUrl1') && $this->beachPreviewUrl1)
    <div class="mt-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg relative">
        <button type="button"
                wire:click="deleteBeach1"
                wire:confirm="Remove Beach Photo 1?"
                class="absolute top-2 right-2 z-10 w-7 h-7 flex items-center justify-center
                       rounded-full bg-red-500/70 text-white text-sm font-bold
                       hover:bg-red-600 transition-colors shadow-sm">
            ✕
        </button>
        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Beach Photo 1</p>
        <img src="{{ $this->beachPreviewUrl1 }}" class="rounded-lg shadow-md max-h-64 w-auto" alt="Beach photo 1" />
    </div>
    @endif

    @if(property_exists($this, 'beachPreviewUrl2') && $this->beachPreviewUrl2)
    <div class="mt-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg relative">
        <button type="button"
                wire:click="deleteBeach2"
                wire:confirm="Remove Beach Photo 2?"
                class="absolute top-2 right-2 z-10 w-7 h-7 flex items-center justify-center
                       rounded-full bg-red-500/70 text-white text-sm font-bold
                       hover:bg-red-600 transition-colors shadow-sm">
            ✕
        </button>
        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Beach Photo 2</p>
        <img src="{{ $this->beachPreviewUrl2 }}" class="rounded-lg shadow-md max-h-64 w-auto" alt="Beach photo 2" />
    </div>
    @endif

    @php $hasVideo1 = property_exists($this, 'videoPreviewUrl1') && $this->videoPreviewUrl1; @endphp
    @php $hasVideo2 = property_exists($this, 'videoPreviewUrl2') && $this->videoPreviewUrl2; @endphp
    @if($hasVideo1 || $hasVideo2)
    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        @if($hasVideo1)
        <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg relative">
            <button type="button"
                    wire:click="deleteVideo1"
                    wire:confirm="Remove Video 1?"
                    class="absolute top-2 right-2 z-10 w-7 h-7 flex items-center justify-center
                           rounded-full bg-red-500/70 text-white text-sm font-bold
                           hover:bg-red-600 transition-colors shadow-sm">
                ✕
            </button>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Video 1</p>
            <video controls class="rounded-lg shadow-md max-h-48 w-full">
                <source src="{{ $this->videoPreviewUrl1 }}" type="video/mp4" />
            </video>
        </div>
        @endif
        @if($hasVideo2)
        <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg relative">
            <button type="button"
                    wire:click="deleteVideo2"
                    wire:confirm="Remove Video 2?"
                    class="absolute top-2 right-2 z-10 w-7 h-7 flex items-center justify-center
                           rounded-full bg-red-500/70 text-white text-sm font-bold
                           hover:bg-red-600 transition-colors shadow-sm">
                ✕
            </button>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Video 2</p>
            <video controls class="rounded-lg shadow-md max-h-48 w-full">
                <source src="{{ $this->videoPreviewUrl2 }}" type="video/mp4" />
            </video>
        </div>
        @endif
    </div>
    @endif

    <div class="flex justify-end mt-6">
        <x-filament::button wire:click="save" color="primary">
            Save
        </x-filament::button>
    </div>
</x-filament::page>
