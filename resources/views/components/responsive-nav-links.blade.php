{{-- Se le pasa el atributo "active" para determinar las clases --}}
@props(['active'])

@php
$clases = ($active ?? false)
            ? 'block rounded w-full pl-3 pr-4 py-2 text-left text-base font-medium text-white dark:text-white bg-indigo-50 dark:bg-indigo-500 focus:outline-none focus:text-indigo-800 dark:focus:text-indigo-200 hover:bg-indigo-900/50 dark:hover:bg-indigo-400 focus:bg-indigo-900 dark:focus:bg-indigo-900 focus:border-slate-300 dark:focus:border-slate-300 transition duration-150 ease-in-out'
            : 'block rounded w-full pl-3 pr-4 py-2 text-left text-base font-medium text-gray-300 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-indigo-700 dark:hover:bg-indigo-400/50 hover:border-slate-300 dark:hover:border-slate-300 focus:outline-none focus:text-gray-800 dark:focus:text-gray-100 focus:bg-indigo-900 dark:focus:bg-indigo-900 focus:border-slate-300 dark:focus:border-slate-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $clases]) }}>
    {{ $slot }}
</a>