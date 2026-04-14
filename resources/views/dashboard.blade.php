<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Quick Nav Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-5">

                <a href="{{ route('customers.index') }}"
                   class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition group border border-gray-100">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 flex items-center justify-center rounded-lg mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 group-hover:text-indigo-600 transition">
                        {{ __('Customers') }}
                    </h3>
                    <p class="text-sm text-gray-400 mt-1">
                        {{ __('Manage customer profiles') }}
                    </p>
                </a>

                <a href="{{ route('orders.index') }}"
                   class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition group border border-gray-100">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 flex items-center justify-center rounded-lg mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 group-hover:text-indigo-600 transition">
                        {{ __('Orders') }}
                    </h3>
                    <p class="text-sm text-gray-400 mt-1">
                        {{ __('View and manage orders') }}
                    </p>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
