@extends('layouts.main')

@section('container')
<div class="flex flex-col sm:ml-64 p-8">
    <div class="h-full">
 
        <div class="border-b-2 block md:flex">
      
          <div class="w-full md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md">
            <span class="text-gray-600">This information is secret so be careful</span>
            <div class="w-full p-8 mx-2 flex justify-center">
                <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGZhY2V8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60"
                alt="Bordered avatar">
              </div>
          </div>
          
          <div class="w-full md:w-3/5 p-8 bg-white lg:ml-4 shadow-md">
            <form action="">
                <div class="rounded  shadow p-6">
                <div class="pb-6">
                    <label for="name" class="font-semibold text-gray-700 block pb-1">Name</label>
                    <div class="flex">
                        <input id="username" class="border-1  rounded-r px-4 py-2 w-full" type="text" value="Jane Name" />
                    </div>
                </div>
                <div class="pb-4">
                    <label for="about" class="font-semibold text-gray-700 block pb-1">Email</label>
                    <input id="email" class="border-1  rounded-r px-4 py-2 w-full" type="email" value="example@example.com" />
                </div>
                <button type="submit" class="text-white bg-gray-800 hover:bg-black focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Save</button>
                </div>
            </form>
          </div>
      
        </div>
       
      </div>
</div>
@endsection