<div>
    <div>
        <div class="flex flex-row space-x-2 ">
            <div class="flex-auto">
                <x-forms.input label="Name :" placeholder="Name" name="user.name" wire:model="user.name" />
            </div>
            <div class="flex-auto">
                <x-forms.input label="Email :" placeholder="Email" name="user.email" wire:model="user.email" />
            </div>
            <div class="flex-auto">
                <?php $levels = [
                    '' => '',
                    'tao' => 'tao',
                    'manager' => 'manager',
                    'admin' => 'admin',
                ]; ?>
                <x-forms.select label="Account Type :" placeholder="Account Type" wire:model="user.account_type"
                    name="user.account_type" :options="$levels" />
            </div>
        </div>
        <div class="w-full p-2">
            <div class="justify-self-center">
                <button wire:click="saveUser" wire:target="saveUser" wire:loading.class="loading"
                    class="btn btn-primary btn-block">
                    Save User
                </button>


            </div>
        </div>
    </div>
    <div class="my-2 flex sm:flex-row flex-col justify-center bg-gray-100 p-2 shadow-sm">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative">
                <select wire:model="pagination"
                    class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>

            </div>

            <div class="relative">
                <select wire:model="filter"
                    class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                    <option value="null">All</option>

                </select>

            </div>
        </div>
        <div class="block relative">
            <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                    <path
                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                    </path>
                </svg>
            </span>
            <input placeholder="Search" wire:model="search"
                class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
        </div>



    </div>
    <div class="grid justify-items-stretch">
        <div class="justify-self-center">
            <div wire:loading class="bg-green-700 text-white p-1 shadow-sm">
                Loading ...
            </div>
        </div>
    </div>
    <table class="table table-compact table-zebra w-full" wire:loading.class="cursor-wait">
        <thead>
            <tr class="">
                <th class=""></th>
                <th class="">Name</th>
                <th class="">Email</th>
                <th class="">Role</th>
                <th class="">Reset</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @livewire('user.user-item',['user'=>$user],key($user->id))
            @endforeach
        </tbody>
    </table>
    <div class="pt-4">
        {{ $users->links() }}
    </div>
</div>
