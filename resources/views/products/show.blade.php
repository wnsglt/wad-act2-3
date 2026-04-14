<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product: {{ $product->name }}
            </h2>
            <a href="{{ route('products.index') }}" class="text-sm text-indigo-600 hover:underline">← Back</a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Name</h3>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $product->name }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Price</h3>
                    <p class="mt-1 text-gray-700">₱{{ number_format($product->price, 2) }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Linked Orders ({{ $product->orders->count() }})</h3>
                    @if ($product->orders->isNotEmpty())
                        <ul class="mt-2 space-y-1">
                            @foreach ($product->orders as $order)
                                <li class="text-sm text-gray-700">
                                    {{ $order->order_name }}
                                    <span class="text-gray-400">— {{ $order->profile->user->name ?? '?' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-1 text-gray-400">Not yet ordered.</p>
                    @endif
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
