<x-admin-layout>
    <x-slot name="pageheader">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($users as $user)
                    <li class="flex justify-between p-2">
                        <p class="font-semibold text-gray-900">{{$user->name}}</p>
                        <p class="font-semibold text-gray-900">{{$user->email}}</p>
                        <div class="sm:flex sm:flex-col sm:items-end">
                            <div class="flex justify-end space-x-2">
                                <a href="{{route('admin.users.show', $user->id)}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-md text-white">Roles</a>
                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-md text-white" method="POST" action="{{route('admin.users.destroy', $user->id)}}" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-admin-layout>
