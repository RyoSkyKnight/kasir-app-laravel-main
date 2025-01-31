<div>
    <div wire:key="user-management" class="flex flex-col space-y-6">
        <x-slot name="header">
            {{ __('User Management') }}
        </x-slot>

        <!-- Tabs -->
        <div class="flex flex-row w-auto justify-between space-x-6">

            <div class="flex flex-row space-x-2 w-auto h-10">
                <a href="{{ route('transaction.add') }}"
                    class="flex flex-row items-center space-x-2 py-1 px-2 bg-black text-white rounded-md h-full">
                    <x-hugeicons-add-circle class="w-[1.1rem] h-[1.1rem]" />
                    <span class="font-bold text-sm">Make a Transaction</span>
                </a>
            </div>
        </div>

        <!-- Users Table -->
        <div class="w-full">
            <x-card class="w-full flex flex-col space-y-6">
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">Transaction List</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">A list of all transactions in the system</p>
                </div>
                <div wire:ignore>
                    <table id="transactionTable" class="min-w-full text-sm align-middle bg-white">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Total Price</th>
                                <th>Officer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr class="border-b">
                                    <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                    <td>{{ $transaction->customer_name }}</td>
                                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>
                                        <div class="flex flex-row space-x-2">
                                            <a href="{{ route('transaction.view', $transaction->id) }}" 
                                                class="font-bold rounded p-2 flex items-center hover:bg-gray-100">
                                                <x-hugeicons-eye class="w-5 h-5" />
                                            </a>
                                         
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
    <script>
        
document.addEventListener('livewire:navigated', function () {
    $('#transactionTable').DataTable();
    $('#dt-length-0').removeClass('px-3').addClass('px-6');
});

    </script>

</div>
