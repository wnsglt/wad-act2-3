<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Order #{{ $order->id }}
            </h2>
            <a href="{{ route('orders.index') }}" class="text-sm text-indigo-600 hover:underline">← Back</a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-8 border border-gray-100">

                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Customer Information</h3>
                        <p class="mt-2 text-lg font-bold text-gray-900">{{ $order->profile->name ?? '—' }}</p>
                        <p class="text-sm text-gray-500">{{ $order->profile->email ?? 'No email provided' }}</p>
                    </div>

                    <div class="text-right">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Order Timeline</h3>
                        <p class="mt-2 text-sm text-gray-700">Created: {{ $order->created_at->format('M d, Y') }}</p>
                        <p class="text-xs text-gray-400 font-mono">{{ $order->created_at->format('h:i A') }}</p>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-8">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Ordered Items</h3>
                    @if ($order->products->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-100">
                                <thead>
                                    <tr>
                                        <th class="text-left py-2 text-xs text-gray-400">Product</th>
                                        <th class="text-center py-2 text-xs text-gray-400">Quantity</th>
                                        <th class="text-right py-2 text-xs text-gray-400">Price</th>
                                        <th class="text-right py-2 text-xs text-gray-400">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @php $total = 0; @endphp
                                    @foreach ($order->products as $product)
                                        @php 
                                            $subtotal = $product->price * $product->pivot->quantity;
                                            $total += $subtotal;
                                        @endphp
                                        <tr>
                                            <td class="py-3 text-sm font-medium text-gray-800">{{ $product->name }}</td>
                                            <td class="py-3 text-sm text-center text-gray-600">x{{ $product->pivot->quantity }}</td>
                                            <td class="py-3 text-sm text-right text-gray-600">₱{{ number_format($product->price, 2) }}</td>
                                            <td class="py-3 text-sm text-right font-bold text-gray-900">₱{{ number_format($subtotal, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="pt-4 text-right text-base font-medium text-gray-500">Grand Total</td>
                                        <td class="pt-4 text-right text-xl font-black text-indigo-600">₱{{ number_format($total, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <p class="mt-1 text-gray-400">No products linked.</p>
                    @endif
                </div>

                {{-- Removed Edit/Delete buttons for view-only mode --}}
            </div>

            </div>
        </div>
    </div>
</x-app-layout>
