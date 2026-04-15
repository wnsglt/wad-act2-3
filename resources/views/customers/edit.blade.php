<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Profile: {{ $profile->user->name ?? '' }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('customers.update', $profile) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-5">
                        <x-input-label for="name" :value="__('Full Name')" />
                        <x-text-input id="name" name="name" type="text"
                            class="mt-1 block w-full"
                            value="{{ old('name', $profile->name) }}" placeholder="Juan Dela Cruz" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-5">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email"
                            class="mt-1 block w-full"
                            value="{{ old('email', $profile->email) }}" placeholder="juan.delacruz@example.com" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-5">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" name="address" type="text"
                            class="mt-1 block w-full"
                            value="{{ old('address', $profile->address) }}" placeholder="123 Street, City" required />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="mb-5">
                        <x-input-label for="phone" :value="__('Phone Number')" />
                        <x-text-input id="phone" name="phone" type="text"
                            class="mt-1 block w-full"
                            value="{{ old('phone', $profile->phone) }}" placeholder="0912 345 6789" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Update Profile') }}</x-primary-button>
                        <a href="{{ route('customers.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
