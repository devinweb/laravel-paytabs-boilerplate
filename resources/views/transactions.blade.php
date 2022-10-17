<x-app-layout>
  <x-slot name="header">
      <div class="flex justify-between">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('سجل المدفوعات') }}
          </h2>
          <a href="{{route('transaction-options')}}" class="px-4 py-1 rounded-md border border-gray-900">عملية
              جديدة</a>

      </div>
  </x-slot>

  <div class="py-12" id="app">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                  <div class="flex flex-col">
                      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-4 inline-block min-w-full sm:px-6
                              lg:px-8">
                              <div class="overflow-hidden">
                                  <table class="w-full text-center">
                                      <thead class="border-b bg-gray-800">
                                          <tr class="w-full">
                                              <th scope="col" class="text-md
                                                  w-1/6 font-medium text-white
                                                  px-6 py-4">
                                                  رمز العملية
                                              </th>
                                              <th scope="col" class="text-md
                                                  w-1/6 font-medium text-white
                                                  px-6 py-4">
                                                  مبلغ العملية
                                              </th>
                                              <th scope="col" class="text-md
                                                  w-1/6 font-medium text-white
                                                  px-6 py-4">
                                                  نوع العملية
                                              </th>
                                              <th scope="col" class="text-md
                                                  w-1/6 font-medium text-white
                                                  px-6 py-4">
                                                  التاريخ
                                              </th>
                                              <th scope="col" class="text-md
                                                  w-1/6 font-medium text-white
                                                  px-6 py-4">
                                                  المستخدم
                                              </th>
                                              <th scope="col" class="text-md
                                                  w-1/6 font-medium text-white
                                                  px-6 py-4">
                                                  الحالة
                                              </th>
                                              <th scope="col" class="text-md
                                                  w-1/6 font-medium text-white
                                                  px-6 py-4">
                                                  
                                              </th>
                                          </tr>
                                      </thead class="border-b">
                                      <tbody>
                                        @foreach ($transactions as $transaction)
                                          <tr class="bg-white border-b">
                                              <td class="text-sm text-gray-900
                                                  font-bold px-6 py-4
                                                  whitespace-nowrap">
                                                  {{ $transaction->transaction_ref }}
                                              </td>
                                              <td class="text-sm text-gray-900
                                                  font-light px-6 py-4
                                                  whitespace-nowrap">
                                                  {{ $transaction->amount }}
                                              </td>
                                              <td class="text-sm text-gray-900
                                                  font-light px-6 py-4
                                                  whitespace-nowrap">
                                                  {{ $transaction->type }}
                                              </td>
                                              <td class="text-sm text-gray-900
                                                  font-light px-6 py-4
                                                  whitespace-nowrap">
                                                  {{ $transaction->created_at }}
                                              </td>
                                              <td class="text-sm text-gray-900
                                                  font-light px-6 py-4
                                                  whitespace-nowrap">
                                                  {{ $transaction->user->name }}
                                              </td>
                                              <td class="text-sm text-gray-900
                                                  font-light px-6 py-4
                                                  whitespace-nowrap">
                                                  @if($transaction->status == 'pending')
                                                  <div class="rounded mx-4 text-white bg-yellow-400">في الانتظار</div>
                                                  @else
                                                  <div class="rounded mx-4 text-white bg-green-400">تم الدفع</div>
                                                  @endif
                                              </td>
                                              <td class="text-sm text-gray-900
                                                  font-light px-6 py-4
                                                  whitespace-nowrap">
                                                  @if($transaction->type == 'Sale' && !$transaction->children_count)
                                                  <div class="px-4 py-1 rounded-md border border-gray-900" @click="showConfirmModal('{{$transaction['transaction_ref']}}')">
                                                    إعادة المبغ
                                                  </div>
                                                 
                                                  @endif
                                                  
                                              </td>
                                          </tr class="bg-white border-b">
                                        @endforeach
                                      </tbody>
                                  </table>
                                  {{ $transactions->links() }}
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div v-if="showModal" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-start justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
              <span class="hidden sm:inline-block sm:align-middle sm:h-screen">​</span>
              <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                  <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                      <div class="sm:flex">
                        <div class="mt-3 text-center sm:mt-0">
                          <div class="mt-2">
                            <p class="text-sm text-gray-500" v-if="!error">
                                هل أنت متأكد من رغبتك في إعادة هذا المبغ؟
                            </p>
                            <p class="w-full text-center text-sm text-red-500" v-else>
                              @{{error}} 
                          </p>
                        </div>
                      </div>
                  </div>
              </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex">
                    <button v-if="!error" type="button" @click="refund" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-900 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:ml-3 sm:w-auto sm:text-sm">
                      إعادة المبلغ
                    </button>
                    <button type="button" @click="closeModal" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                      إلغاء
                    </button>
                </div>
            </div>
        </div>
    </div>
  </div>
</x-app-layout>
<script>
  var app = new Vue({
    el: '#app',
    data: {
        showModal: false,
        transRef: null,
        error: null
    },
    methods: {
      showConfirmModal(reference){
       
        this.showModal = true
        this.transRef = reference
      },
      closeModal(){
        this.showModal= false
        this.transRef = null
        this.error = null
      },
      refund(){
        axios.post(`/transactions/${this.transRef}/refund`, {}).then(({data}) => {
          if (data['payment_result']['response_status'] != 'A') {
            this.error = data['payment_result']['response_message'];
            return;
          }
          window.location.href = "/transactions";
        }).catch((error) => {
          console.log(error);
        })
      }
    },
  })
</script>