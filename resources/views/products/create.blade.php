<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="productForm">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input style="color:black" type="text" id="name" name="name"
                                class="form-input mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input style="color:black" type="number" id="price" name="price"
                                class="form-input mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input style="color:black" type="number" id="quantity" name="quantity"
                                class="form-input mt-1 block w-full" required>
                        </div>


                        <div class="mb-4">
                            <button type="submit" id="submitBtn"
                                class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md shadow-md">
                                Add Product
                            </button>
                        </div>
                    </form>

                    <!-- Response Message -->
                    <div id="responseMessage" class="hidden mt-4 p-4 text-sm text-white bg-green-500 rounded-md"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#productForm').submit(function(e) {
            e.preventDefault(); //prevent default submission
            //disable submit btn
            $('#submitBtn').prop('disabled', true).text('Processing...');
            //get form data
            var form_data = new FormData(this);
            //send request
            console.log(form_data);
            $.ajax({
                url: "{{ route('products.store') }}",
                type: "POST",
                data: form_data,
                processData: false,
                contentType: false,
                success: function(response) {
                    //enable submit btn
                    $('#submitBtn').prop('disabled', false).text('Add Product');
                    //success msg
                    $('#responseMessage').removeClass('hidden').addClass('bg-green-500')
                        .text('Product added successfully!');
                    //clear form
                    $('#productForm')[0].reset();

                },
                error: function(xhr) {
                    $('#submitBtn').prop('disabled', false).text('Add Product');

                    // Show error message
                    $('#responseMessage').removeClass('hidden').addClass('bg-red-500').text(
                        'There was an error while  adding the product.');
                }
            })

        })
    })
</script>
