<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <x-input-label for="profile_id" :value="__('Select Customer')" />
                        <select id="profile_id" name="profile_id" 
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">-- Choose a Customer --</option>
                            @foreach ($profiles as $profile)
                                <option value="{{ $profile->id }}" {{ old('profile_id') == $profile->id ? 'selected' : '' }}>
                                    {{ $profile->name }} ({{ $profile->email }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('profile_id')" class="mt-2" />
                    </div>

                    <div class="mb-5">
                        <x-input-label :value="__('Select Products and Quantity')" />
                        <div class="mt-4 space-y-4">
                            @foreach ($products as $product)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <label class="flex items-center gap-3">
                                        <input type="checkbox" name="products[]"
                                               value="{{ $product->id }}"
                                               {{ is_array(old('products')) && in_array($product->id, old('products')) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm">
                                        <span class="text-sm font-medium text-gray-700">
                                            {{ $product->name }}
                                            <span class="text-xs text-gray-400 ml-1">₱{{ number_format($product->price, 2) }}</span>
                                        </span>
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs text-gray-400">Qty:</span>
                                        <input type="number" name="quantities[{{ $product->id }}]" 
                                               value="{{ old('quantities.'.$product->id, 1) }}"
                                               min="1"
                                               class="w-16 rounded border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('products')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4 mt-6 pt-6 border-t border-gray-100">
                        <x-primary-button>{{ __('Create Order') }}</x-primary-button>
                        <a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
