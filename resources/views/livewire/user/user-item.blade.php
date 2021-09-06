@if($state == false)
<tr>
    <td wire:click="toggleEdit">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
          </svg>
    </td>
    <td class="p-3 border border-r border-gray-50 ">{{$user->name}}</td>
    <td class="p-3 border border-r border-gray-50 ">{{$user->email}}</td>
    <td class="p-3 border border-r border-gray-50 ">{{$user->account_type}}</td>
    <td wire:click="resetPassword" class="p-3 border border-r border-gray-50 cursor-pointer">Reset Password</td>

    </tr>
    @else
    <tr>
        <td wire:click="toggleEdit">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
        </td>
        <td class="p-3 border border-r border-gray-50 ">
            <x-forms.input label="" placeholder="Username" name="user.name" wire:model="user.name" />


        </td>
        <td class="p-3 border border-r border-gray-50 ">
            <x-forms.input label="" placeholder="Email" name="user.email" wire:model="user.email" />
        </td>
        <td class="p-3 border border-r border-gray-50 ">
            <?php $levels = [
                'osh' => 'osh',
                'manager' => 'manager',
                'raiser' => 'raiser',
                ]; ?>
                <x-forms.select label="" placeholder="Account Type" name="user.account_type" wire:model="user.account_type"
                    :options="$levels" />
        </td>

        </tr>

    @endif
