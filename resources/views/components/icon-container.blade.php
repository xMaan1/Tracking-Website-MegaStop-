@props(['color' => 'blue', 'size' => 'base'])

@php
$colorClasses = [
    'blue' => 'bg-blue-100 text-blue-600',
    'green' => 'bg-green-100 text-green-600',
    'yellow' => 'bg-yellow-100 text-yellow-600',
    'purple' => 'bg-purple-100 text-purple-600',
    'red' => 'bg-red-100 text-red-600',
    'gray' => 'bg-gray-100 text-gray-600',
    'indigo' => 'bg-indigo-100 text-indigo-600',
    'pink' => 'bg-pink-100 text-pink-600',
];

$sizeClasses = [
    'sm' => 'p-1.5',
    'base' => 'p-2',
    'lg' => 'p-3',
];

$iconSize = [
    'sm' => 'h-4 w-4',
    'base' => 'h-5 w-5',
    'lg' => 'h-6 w-6',
];

$containerSize = [
    'sm' => 'w-[30px] h-[30px]',
    'base' => 'w-[36px] h-[36px]',
    'lg' => 'w-[44px] h-[44px]',
];
@endphp

<div class="rounded-full flex items-center justify-center mr-4 {{ $colorClasses[$color] ?? 'bg-blue-100 text-blue-600' }} {{ $sizeClasses[$size] ?? 'p-2' }} {{ $containerSize[$size] ?? 'w-[36px] h-[36px]' }}">
    <span {{ $attributes->class([$iconSize[$size] ?? 'h-5 w-5']) }}>
        {{ $slot }}
    </span>
</div>
