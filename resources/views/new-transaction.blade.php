<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('عملية دفع جديدة') }}
            </h2>
  
        </div>
    </x-slot>

  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <iframe class="w-full" height="500" src="{{$transaction['redirect_url']}}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
  </x-app-layout>
  