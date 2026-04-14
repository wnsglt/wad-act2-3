<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Order') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 p-4 bg-indigo-50 rounded-lg border border-indigo-100">
                    <h3 class="text-xs font-bold text-indigo-400 uppercase tracking-widest">Customer</h3>
                    <p class="mt-1 text-sm font-semibold text-indigo-900">{{ $order->profile->name ?? '—' }}</p>
                </div>

                <form action="{{ route('orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-5">
                        <x-input-label :value="__('Update Products and Quantity')" />
                        <div class="mt-4 space-y-4">
                            @foreach ($products as $product)
                                @php 
                                    $pivot = $order->products->find($product->id)?->pivot;
                                    $isOrdered = !is_null($pivot);
                                    $qty = $pivot->quantity ?? 1;
                                @endphp
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <label class="flex items-center gap-3">
                                        <input type="checkbox" name="products[]"
                                               value="{{ $product->id }}"
                                               {{ $isOrdered ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm">
                                        <span class="text-sm font-medium text-gray-700">
                                            {{ $product->name }}
                                            <span class="text-xs text-gray-400 ml-1">₱{{ number_format($product->price, 2) }}</span>
                                        </span>
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs text-gray-400">Qty:</span>
                                        <input type="number" name="quantities[{{ $product->id }}]" 
                                               value="{{ old('quantities.'.$product->id, $qty) }}"
                                               min="1"
                                               class="w-16 rounded border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('products')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4 mt-6 pt-6 border-t border-gray-100">
                        <x-primary-button>{{ __('Update Order') }}</x-primary-button>
                        <a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
