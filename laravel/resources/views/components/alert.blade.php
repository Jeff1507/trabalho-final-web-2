@php
    $base = "h-14 min-w-14 w-full bg-zinc-800 flex items-center justify-between px-4 rounded-md text-sm font-medium";
    $styles = match ($type) {
        "success" => "text-green-300",
        "error" => "text-red-400",
        default => "text-white",
    };
@endphp
<div x-data="{ show: true }" x-show="show" {{ $attributes->merge(["class" => "$base $styles"]) }} x-transition>
    <div class="flex items-center gap-2">
        @if ($type === "success")
            <x-heroicon-m-check-circle class="w-6 h-6"/>
        @elseif ($type === "error")
            <x-heroicon-c-exclamation-circle class="w-6 h-6"/>
        @endif
        {{ $slot }}
    </div>
    <button type="button" @click="show = false" class="cursor-pointer">
       <x-heroicon-m-x-mark class="text-white w-5 h-5"/>
    </button>
</div>