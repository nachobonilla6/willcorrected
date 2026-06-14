<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Upload Section --}}
        <x-filament::section>
            <x-slot name="heading">
                Upload Photos
            </x-slot>

            <form wire:submit="uploadPhotos">
                {{ $this->form }}

                <div class="mt-4 flex justify-end">
                    <x-filament::button type="submit" color="success" icon="heroicon-o-cloud-arrow-up">
                        Upload
                    </x-filament::button>
                </div>
            </form>
        </x-filament::section>

        {{-- Gallery Grid --}}
        <x-filament::section>
            <x-slot name="heading">
                Gallery ({{ count($photos) }} photos)
            </x-slot>

            @if(count($photos) > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                    @foreach($photos as $photo)
                        <div class="relative aspect-square rounded-xl overflow-hidden
                                    border border-gray-700/50 bg-gray-800/60
                                    hover:border-emerald-500/50 transition-all duration-300"
                             wire:key="photo-{{ $photo['id'] }}">

                            {{-- Order controls --}}
                            <div class="absolute top-1.5 left-1.5 z-10 flex flex-col gap-0.5">
                                <button type="button"
                                        wire:click="moveUp({{ $photo['id'] }})"
                                        @if($loop->first) disabled @endif
                                        class="w-6 h-6 flex items-center justify-center rounded
                                               bg-black/60 text-gray-300 hover:text-white hover:bg-emerald-600/60
                                               transition-colors text-xs @if($loop->first) opacity-30 cursor-not-allowed @endif">
                                    ▲
                                </button>
                                <button type="button"
                                        wire:click="moveDown({{ $photo['id'] }})"
                                        @if($loop->last) disabled @endif
                                        class="w-6 h-6 flex items-center justify-center rounded
                                               bg-black/60 text-gray-300 hover:text-white hover:bg-emerald-600/60
                                               transition-colors text-xs @if($loop->last) opacity-30 cursor-not-allowed @endif">
                                    ▼
                                </button>
                            </div>

                            {{-- Delete X --}}
                            <button type="button"
                                    wire:click="deletePhoto({{ $photo['id'] }})"
                                    wire:confirm="Delete this photo?"
                                    class="absolute top-1.5 right-1.5 z-10 w-6 h-6 flex items-center justify-center
                                           rounded-full bg-red-500/70 text-white text-xs font-bold
                                           hover:bg-red-600 transition-colors shadow-sm">
                                ✕
                            </button>

                            <img src="{{ $photo['image_path'] }}"
                                 alt="Photo"
                                 class="w-full h-full object-cover pointer-events-none select-none">

                            <div class="absolute bottom-1.5 left-1.5 px-1.5 py-0.5 rounded text-[10px] font-medium
                                        bg-black/60 text-gray-400">
                                #{{ $photo['sort_order'] }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 text-xs text-gray-500">
                    Use ▲ ▼ to reorder photos
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="h-12 w-12 mx-auto text-gray-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="text-gray-500">No photos yet.</p>
                </div>
            @endif
        </x-filament::section>
    </div>
</x-filament-panels::page>
