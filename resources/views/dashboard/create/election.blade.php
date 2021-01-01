<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Election') }}
        </h2>
    </x-slot>
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">--}}
{{--    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>--}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div>
                        <livewire:election />
                    </div>

                </div>

            </div>
        </div>
    </div>
{{--    <script>--}}
{{--            var simplemde = new SimpleMDE({--}}
{{--                forceSync: true,--}}
{{--                element: document.getElementById("electionDescription")--}}
{{--            });--}}
{{--    </script>--}}
</x-app-layout>
