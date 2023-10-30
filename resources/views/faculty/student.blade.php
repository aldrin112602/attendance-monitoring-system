<x-app-layout>
    <x-slot name="header">
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center justify-between">
            {{ __('Student') }}
            <a href="{{ route('admin.faculty.create') }}" class="bg-green-800 px-3 py-1 rounded-md text-sm flex items-center justify-center gap-1"><i
                    class="fa fa-plus" aria-hidden="true"></i> Student</a>
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
                            {{-- @foreach ($faculty as $faculty)
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
                                        <form class="flex items-center justify-center gap-3"
                                            action="{{ route('admin.delete.faculty', ['id' => $faculty->id]) }}" method="POST">
                                            @csrf

                                            <a href="{{ Auth::user()->id != $faculty->id ? route('admin.faculty.edit', ['id' => $faculty->id]) : '#' }}"
                                                class="px-3 rounded-xl py-2 {{ Auth::user()->id != $faculty->id ? 'bg-indigo-200 hover:text-indigo-900 text-indigo-600' : 'bg-slate-700 cursor-not-allowed text-slate-400' }}">Edit</a>

                                            <button {{ Auth::user()->id == $faculty->id ? 'disabled' : '' }}
                                                type="button"
                                                class="px-3 rounded-xl py-2 {{ Auth::user()->id == $faculty->id ? 'cursor-not-allowed bg-slate-700 text-slate-400' : 'bg-rose-200 hover:text-rose-900 text-rose-600' }}"
                                                onclick="deleteFaculty({{ $faculty->id }})">Delete</button>
                                        </form>
                                        <form id="delete-form" style="display: none;"
                                            action="{{ route('admin.delete.faculty', ['id' => $faculty->id]) }}" method="POST">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                {{-- end table --}}
            </div>
        </div>
    </div>

    <script>
        function deleteFaculty(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
</x-app-layout>

