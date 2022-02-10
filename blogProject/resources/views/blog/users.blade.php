@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-6xl">
            All Users
        </h1>
    </div>



    <table class="shadow-2xl text-base border-2 border-gray-200 w-4/5 ml-20 mt-10">
       <thead class="text-white">
           <tr>
               <th class="py-3 bg-gray-800">ID</th>
               <th class="py-3 bg-gray-800">Name</th>
               <th class="py-3 bg-gray-800">Email</th>
               <th class="py-3 bg-gray-800">Trash</th>
           </tr>
       </thead>
       @foreach ($posts as $post)
           <tr>
               <td class="py-3 bg-gray-800 text-white">{{ $post->id }}</td>
               <td class="py-3 bg-gray-800 text-white">{{ $post->name }}</td>
               <td class="py-3 bg-gray-800 text-white">{{ $post->email }}</td>
               <td class="py-3 bg-gray-800 text-white">
                <form 
                        action="{{route('blog.user-delete',['id' => $post->id])}}"
                        method="POST">
                        
                        @csrf
                        @method('delete')
                        <button
                           class="text-red-600 italic hover:text-white pb-1 border-b-2"
                           type="submit">
                                Delete
                        </button>
                    
                    </form></td>
           </tr>
       @endforeach
    </table>


@endsection 

