<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table-auto w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">{{ __('ID') }}</th>
                                <th class="px-4 py-2 border">{{ __('Name') }}</th>
                                <th class="px-4 py-2 border">{{ __('Price') }}</th>
                                <th class="px-4 py-2 border">{{ __('Quantity') }}</th>
                                <th class = "pz-4 py-2 border">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $product->id }}</td>
                                    <td class="px-4 py-2 border">{{ $product->name }}</td>
                                    <td class="px-4 py-2 border">${{ number_format($product->price / 100, 2) }}</td>
                                    <td class="px-4 py-2 border">{{ $product->quantity }}</td>
                                    <td class="px-4 py-2 border">
                                        <div class="flex space-x-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('product.edit', $product->id) }}"
                                                class="text-white bg-blue-500 hover:bg-blue-600 px-2 py-1 rounded text-xs font-semibold transition duration-300">
                                                Edit
                                            </a>

                                            <!-- Buy Button -->
                                            <a href="{{ route('checkout') }}"
                                                class="text-white bg-green-500 hover:bg-green-600 px-2 py-1 rounded text-xs font-semibold transition duration-300">
                                                Buy
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white bg-red-500 hover:bg-red-600 px-2 py-1 rounded text-xs font-semibold transition duration-300">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
