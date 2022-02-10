@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-6xl">
            Trash Posts
        </h1>
    </div>
    @if (Auth::check())
    <div class="pt-15 w-4/5 m-auto">
        
        <a 
            href="{{route('blog.panel')}}"
            class="bg-blue-500 uppercase bg-transparent text-gray-100  px-5 ml-5 text-xs font-extrabold py-3 rounded-3xl"
        >
        Go To Post Details
        </a>
        
    </div>
@endif


    <table class="shadow-2xl text-base border-2 border-gray-200 w-4/5 ml-20 mt-10">
       <thead class="text-white">
           <tr>
               <th class="py-3 bg-gray-800">ID</th>
               <th class="py-3 bg-gray-800">Name</th>
               <th class="py-3 bg-gray-800">Title</th>
               <th class="py-3 bg-gray-800">Description</th>
               <th class="py-3 bg-gray-800">Image_Path</th>
               <th class="py-3 bg-gray-800">Trash</th>
           </tr>
       </thead>
       @foreach ($posts as $post)
           <tr>
               <td class="py-3 bg-gray-800 text-white">{{ $post->id }}</td>
               <td class="py-3 bg-gray-800 text-white">{{ $post->user->name }}</td>
               <td class="py-3 bg-gray-800 text-white">{{ $post->title }}</td>
               <td class="py-3 bg-gray-800 text-white">{{ $post->description }}</td>
               <td class="py-3 bg-gray-800 text-white">{{ $post->image_path }}</td>
               <td class="py-3 bg-gray-800 text-white"><a 
                href="{{route('blog.restore',['id' => $post->id])}}"
                class="text-green-600 italic hover:text-white pb-1 border-b-2">
                Restore
                </a></td>
           </tr>
       @endforeach
    </table>


@endsection 

