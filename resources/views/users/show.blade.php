<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User: {{ $user->name }}
            </h2>
            <a href="{{ route('users.index') }}" class="text-sm text-indigo-600 hover:underline">← Back</a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Name</h3>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Email</h3>
                    <p class="mt-1 text-gray-700">{{ $user->email }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Role</h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

                @if ($user->profile)
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Profile</h3>
                        <p class="mt-1 text-gray-700">{{ $user->profile->address }}</p>
                        <p class="text-sm text-gray-500">{{ $user->profile->phone }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Orders ({{ $user->profile->orders->count() }})</h3>
                        @if ($user->profile->orders->isNotEmpty())
                            <ul class="mt-2 space-y-2">
                                @foreach ($user->profile->orders as $order)
                                    <li class="text-sm text-gray-700">
                                        <span class="font-medium">{{ $order->order_name }}</span>
                                        — {{ $order->products->pluck('name')->join(', ') ?: 'No products' }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mt-1 text-gray-400">No orders placed.</p>
                        @endif
                    </div>
                @else
                    <p class="text-gray-400 text-sm">No profile created yet.</p>
                @endif


            </div>
        </div>
    </div>
</x-app-layout>
