<x-app-layout>
    <x-slot name="header">
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center justify-between">
            {{ __('Faculty') }}
            <a href="{{ route('admin.faculty.create') }}" class="bg-green-800 px-3 py-1 rounded-md text-sm flex items-center justify-center gap-1"><i
                    class="fa fa-plus" aria-hidden="true"></i> Faculty</a>
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
                            @foreach ($faculty as $faculty)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">{{ $faculty->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">{{ $faculty->email }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">{{ $faculty->created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">{{ $faculty->updated_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">
                                        <i class="fa-solid fa-circle {{ $faculty->status == 'inactive' ? 'text-gray-400' : 'text-green-500' }}"></i>
                                        {{ ucwords($faculty->status) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap dark:text-white">
                                        <a href="{{ route('admin.faculty.edit', ['id' => $faculty->id]) }}"
                                            class="text-indigo-600 hover:text-indigo-900 px-3 rounded-xl py-2 bg-indigo-200">Edit</a>

                                        <a href="#"
                                            class="text-rose-600 hover:text-rose-900 px-3 rounded-xl py-2 bg-rose-200">Delete</a>
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
