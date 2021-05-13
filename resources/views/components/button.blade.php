<!-- component -->
<button {{ $attributes->merge(['class' => 'bg-blue-600 hover:bg-blue-dark text-white font-bold py-2 px-4 rounded h-10']) }}">
   {{$slot}}
</button>