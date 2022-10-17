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

                    <div class="font-bold text-xl m-3">خيارات إنشاء صفحة الدفع</div>
                    <form name="options-form" method="post" action="{{route('new-transaction')}}">
                    @csrf
                        <div class="flex flex-wrap">
                            <div class="flex items-center mb-4 w-full">
                                <input disabled checked type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <input type="hidden" value="true" name="framed">
                                <label class="mr-2 font-medium text-gray-700">وضع iframe</label>
                            </div>
                            <div class="flex items-center mb-4 w-1/2">
                                <input checked type="checkbox" name="add_billing" value="true" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label class="mr-2 font-medium text-gray-700">إنشاء بيانات الفاتورة تلقائيًا</label>
                            </div>
                            <div class="flex items-center mb-4 w-1/2">
                                <input checked type="checkbox" name="hide_billing" value="true" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label class="mr-2 font-medium text-gray-700">إخفاء بيانات الفاتورة</label>
                            </div>
                            <div class="flex items-center mb-4 w-1/2">
                                <input type="checkbox" name="add_shipping" value="true" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label class="mr-2 font-medium text-gray-700">إنشاء بيانات الشحن تلقائيًا</label>
                            </div>
                            <div class="flex items-center mb-4 w-1/2">
                                <input checked type="checkbox" value="true" name="hide_shipping" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label class="mr-2 font-medium text-gray-700">إخفاء بيانات الشحن</label>
                            </div>
                            <div class="w-full px-12">
                                <button type="submit" class="px-4 py-1 rounded-md bg-gray-800 text-white float-left ">إنشاء الصفحة</button>
                            </div>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </x-app-layout>
  