<h3 class="text-lg tracking-wide font-extrabold text-center mb-5">
    {{$slot}}
</h3>
<img {{ $attributes->merge(['class' => 'hover:opacity-75 w-full align-middle border-none rounded-md']) }}  src="{{ $src ?? URL::to('/').'/images/no-image-found.png'}}" />
