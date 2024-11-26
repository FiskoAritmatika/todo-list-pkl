@extends('layouts.main')

@section('content')
@if(Session::has('message'))
<div class="p-4 my-1 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
    <span class="font-medium">{{ Session::get('message') }}</span>
</div>
@endif
    <div class="container my-10">
        <a href="{{ route('task.create') }}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Add Task</a>
    </div>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Task Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (count($task)>0)
                @foreach ($task as $task)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $task->task }}
                    </th>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('task.destroy', $task->id) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus task ini?');">
                            <a href="{{ route('task.edit', [$task->id]) }}"><button type="button" class="px-5 py-2 text-sm font-medium text-center text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-lg me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Edit</button></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-5 py-2 text-sm font-medium text-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <td class="px-6 py-4 text-left text-gray-900">Tidak ada Task yang dapat ditampilkan</td>
                @endif
            </tbody>
        </table>
    </div>

@endsection