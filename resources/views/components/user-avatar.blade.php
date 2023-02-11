@props(['user' => null, 'src' => 'https://ui-avatars.com/api/?name=' . ($user?->name ?? '')])

<img class="w-10 h-10 rounded-full" src="{{ $src }}" alt="{{ $user?->name ?? '' }}">

<div class="pl-3">
    <div class="text-base font-semibold">
        {{ $user?->name ?? '' }}
        @if (($user?->id ?? -1) == auth()->user()->id)
            <span class="text-xs font-normal text-green-500">(You)</span>
        @endif
    </div>
    <div class="font-normal text-gray-500">{{ $user?->email ?? '' }}</div>
</div>
