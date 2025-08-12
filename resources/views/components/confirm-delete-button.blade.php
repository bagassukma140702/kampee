<div x-data="{ show: false }" class="inline">

    <!-- Trigger -->
    <div @click="show = true">
        {{ $trigger }}
    </div>

    <!-- Modal (1x x-show & x-cloak only here) -->
    <div x-show="show" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

        <!-- Modal box -->
        <div @click.away="show = false" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white w-full max-w-sm rounded-lg shadow-lg p-6 space-y-4 text-center">

            <h2 class="text-lg font-semibold text-gray-800">{{ $title }}</h2>
            <p class="text-sm text-gray-600">{{ $message }}</p>

            {{ $slot }}

            <div class="flex justify-center gap-4 mt-6">
                <button @click="show = false"
                    class="px-4 py-2 text-sm bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                    Batal
                </button>

                <form method="POST" action="{{ $action }}">
                    @csrf
                    @if ($method !== 'POST')
                        @method($method)
                    @endif
                    <button type="submit"
                        class="px-4 py-2 text-sm bg-{{ $buttonColor }}-600 text-white rounded hover:bg-{{ $buttonColor }}-700">
                        {{ $buttonText }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
