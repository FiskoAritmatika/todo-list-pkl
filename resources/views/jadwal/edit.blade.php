@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="justify-items-center mb-10">
            <h2 class="text-4xl font-extrabold dark:text-black">Update To Do</h2>
        </div>
        <div class="">
            <a href="{{ route('jadwal.index') }}"
            class="inline-flex items-center border bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border-gray-400 rounded shadow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18">
                </path>
            </svg>
            <span class="ml-1 font-bold text-lg">Back</span>
        </a>
        </div>
        <form class="max-w-md mx-auto" action="{{ route('jadwal.update', [$jadwal->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="relative z-0 w-full mb-5 group">
                <label for="task" class="sr-only">Task</label>
                <select name="task" id="task" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    @foreach (App\Models\Task::all() as $task)
                        <option value="{{ $task->id }}" @if ($task->id==$jadwal->task_id) selected @endif>{{ $task->task }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" value="{{ $jadwal->description }}" name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="date" value="{{ $jadwal->duedate }}" name="duedate" id="duedate" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="duedate" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Due Date</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <label for="status" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Status</label>
                <fieldset>
                    <div class="flex items-center my-4">
                        <input id="selesai" type="radio" name="status" value="selesai" {{ $jadwal->status == 'selesai' ? 'checked' : '' }} class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="selesai" class="block ms-2 text-sm font-medium text-gray-900">
                            Selesai
                        </label>
                    </div>
            
                    <div class="flex items-center mb-4">
                        <input id="belum" type="radio" name="status" value="belum" {{ $jadwal->status == 'belum' ? 'checked' : ''}} class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="belum" class="block ms-2 text-sm font-medium text-gray-900">
                            Belum
                        </label>
                    </div>
            
                    <div class="flex items-center mb-4">
                        <input id="pending" type="radio" name="status" value="pending" {{ $jadwal->status == 'pending' ? 'checked' : ''}} class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="pending" class="block ms-2 text-sm font-medium text-gray-900">
                            Pending
                        </label>
                    </div>
                </fieldset> 
                                  
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
@endsection