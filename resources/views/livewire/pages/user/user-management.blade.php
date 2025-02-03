<div>
    <div wire:key="user-management" class="flex flex-col space-y-6" wire:poll.5s="fetchUsers">
        <x-slot name="header">
            {{ __('User Management') }}
        </x-slot>

        <!-- Tabs -->
        <div class="flex flex-row w-auto justify-between space-x-6">

            <div class="flex flex-row space-x-2 w-auto h-10">
                <a href="{{ route('user.add') }}"
                    class="flex flex-row items-center space-x-2 py-1 px-2 bg-black text-white rounded-md h-full">
                    <x-hugeicons-add-circle class="w-[1.1rem] h-[1.1rem]" />
                    <span class="font-bold text-sm">Add Officers</span>
                </a>
            </div>
        </div>

        <!-- Users Table -->
        <div class="w-full">
            <x-card class="w-full flex flex-col space-y-6">
                <div class="flex flex-col">
                    <h1 class="font-extrabold pt-2 text-3xl">User List</h1>
                    <p class="text-[0.8rem] pt-0.5 text-gray-500">A list of all users on this awesome system!</p>
                </div>
                <div wire:ignore>
                    <table id="userTable" class="min-w-full text-sm align-middle bg-white">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>
                                        @if($user->is_online)
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                Online
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                                Offline
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex flex-row space-x-2">
                                            <a href="{{ route('user.edit', $user['id']) }}" 
                                                class="font-bold rounded  p-2 flex items-center space-x-2">
                                                <x-hugeicons-pencil-edit-02 style="width:1.5rem; height:1.5rem;" />
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
    $('#userTable').DataTable();
    $('#dt-length-0').removeClass('px-3').addClass('px-6');

    Livewire.on('userDeleted', (id) => {
        let userTable = $('#userTable').DataTable();
        userTable.row($(`button[data-user-id="${id}"]`).closest('tr')).remove().draw();
    });
});

    </script>

</div>
