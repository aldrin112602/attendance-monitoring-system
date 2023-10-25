<x-app-layout>
    <x-slot name="header">
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center justify-between">
            {{ __('Administrator') }}
            <a href="{{ route('admin.admin.create') }}"
                class="bg-green-800 px-3 py-1 rounded-md text-sm flex items-center justify-center gap-1"><i
                    class="fa fa-plus" aria-hidden="true"></i> Admin</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                {{-- start table --}}
                <div class="p-0">
                    <table class="min-w-full">
                        <thead class=" bg-slate-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    NAME</th>
                                <th
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    EMAIL ADDRESS</th>
                                <th
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    CREATED AT</th>
                                <th
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    UPDATED AT</th>
                                <th
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    STATUS</th>
                                <th
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">{{ $admin->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">{{ $admin->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">
                                        {{ $admin->created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">
                                        {{ $admin->updated_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">
                                        <i
                                            class="fa-solid fa-circle {{ $admin->status == 'inactive' ? 'text-gray-400' : 'text-green-500' }}"></i>
                                        {{ ucwords($admin->status) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">
                                        <a href="{{ Auth::user()->id != $admin->id ? route('admin.admin.edit', ['id' => $admin->id]) : '#' }}"
                                            class="px-3 rounded-xl py-2 {{ Auth::user()->id != $admin->id ? 'bg-indigo-200 hover:text-indigo-900 text-indigo-600' : 'bg-slate-700 cursor-not-allowed text-slate-400' }}">Edit</a>

                                        <a href="{{ Auth::user()->id != $admin->id ? route('admin.admin.edit', ['id' => $admin->id]) : '#' }}"
                                            class="text-rose-600  px-3 rounded-xl py-2 bg-rose-200 {{ Auth::user()->id != $admin->id ? 'hover:text-rose-900' : 'bg-slate-700 cursor-not-allowed text-slate-400' }}">Delete</a>
                                        <!-- Add edit link or button here -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- end table --}}

            </div>
        </div>
    </div>
</x-app-layout>
