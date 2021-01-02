<div>

    @push('scripts')
        @once
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        @endonce
    @endpush

    <input x-data x-ref="input" type="text" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 dateTimePicker" {{$attributes}} >


        @push('scripts')
    <script>
        flatpickr("#{{$attributes['id']}}", {
            enableTime: true,
            dateFormat: "d-m-Y H:i"
        });
    </script>
            @endpush
</div>
