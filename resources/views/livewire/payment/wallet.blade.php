@section('title', __('Wallet Topup'))
    <div class="">

        <div wire:loading.flex>
            <div class="w-11/12 p-12 mx-auto mt-20 border rounded shadow md:w-6/12 lg:w-4/12">
                <x-heroicon-o-clock class="w-12 h-12 mx-auto text-gray-400 md:h-24 md:w-24" />
                <p class="text-xl font-medium text-center">{{__('Wallet Topup')}}</p>
                <p class="text-sm text-center">{{__('Please wait while we process your payment')}}</p>
            </div>
        </div>

        @if (($selectedPaymentMethod->slug ?? '') != 'offline')
            <div wire:loading.remove
                class="w-11/12 p-4 mx-auto mt-20 border rounded shadow md:w-6/12 lg:w-4/12 md:grid-cols-2">
                <div class="flex my-4">
                    <div class="items-center">
                        <img src="{{ $selectedModel->wallet->user->photo }}"
                            class="w-32 h-32 rounded-full md:w-58 md:h-58" />
                        <p>{{ $selectedModel->wallet->user->name }}</p>
                    </div>
                    <div class="ml-auto text-right">
                        <p class="text-2xl font-bold">{{ setting('currency') . '' . $selectedModel->amount }}</p>
                        {{__('Account Top-up')}}
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @foreach ($paymentMethods as $paymentMethod)
                        <button wire:click='initPayment({{ $paymentMethod->id }})'>
                            <div class="flex items-center p-1 border rounded shadow">
                                <img src="{{ $paymentMethod->photo }}" class="w-2/12 md:w-3/12" />
                                {{ $paymentMethod->name }}
                            </div>
                        </button>
                    @endforeach
                </div>

            </div>
            <p class="w-full p-4 text-sm text-center text-gray-500">{{__('Do not close this window')}}</p>
        @else
            @include('livewire.payment.offline.wallet')
        @endif

