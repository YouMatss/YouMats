@extends('front.layouts.master')
@section('metaTags')
    <title>{{env('APP_NAME')}} | {{__('general.success_payment')}}</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/v-mask/dist/v-mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Tajawal&display=swap" rel="stylesheet">
@endsection
@section('content')
<div id="app" class="my-6 flex-col w-screen container mx-auto flex items-center justify-center">
    <div class="w-full max-w-lg rounded-lg shadow">
        <div class="w-full items-center justify-center flex p-8">
                <span class="text-2xl text-gray-700 mr-4" style="font-family: Cairo, sans-serif;">
                    Success transaction
                </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 fill-current text-green-500" viewBox="0 0 24 24">
                <g data-name="Layer 2">
                    <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm4.3 7.61l-4.57 6a1 1 0 01-.79.39 1 1 0 01-.79-.38l-2.44-3.11a1 1 0 011.58-1.23l1.63 2.08 3.78-5a1 1 0 111.6 1.22z" data-name="checkmark-circle-2" />
                </g>
            </svg>
        </div>
        <div class="bg-gray-100 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-t-lg">
            <dt class="text-sm leading-5 font-medium text-gray-500">
                Hold Name
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2 uppercase">
                {{ Request::get('customer_name') }}
            </dd>
        </div>
        <div class="bg-gray-100 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm leading-5 font-medium text-gray-500">
                Card Number
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                {{ Request::get('card_number') }}
            </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm leading-5 font-medium text-gray-500">
                Amount
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                {{__('general.sar')}} {{ Request::get('amount')/100 }}
            </dd>
        </div>
        <div class="bg-gray-100 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm leading-5 font-medium text-gray-500">
                Status
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2" style="font-family: Cairo, sans-serif;">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-200 text-green-800">
                    {{ Request::get('response_message') }}
                </span>
            </dd>
        </div>


        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-b-lg">
            <dt class="text-sm leading-5 font-medium text-gray-500">
                Shopping Cart
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                <ul class="border border-gray-200 rounded-md">
                    @foreach($cartItems as $item)
                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5">
                            <div class="w-0 flex-1 flex items-center">
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-2 flex-1 w-0 truncate">
                                    {{$item->name}} <b>({{$item->qty}}x{{$item->price}})</b>
                                </span>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <span class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                                    {{__('general.sar')}} {{$item->qty*$item->price}}
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </dd>
        </div>

        <div class="bg-gray-100 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm leading-5 font-medium text-gray-500">
                Merchant reference
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2" style="font-family: Cairo, sans-serif;">
                {{ Request::get('merchant_reference') }}
            </dd>
        </div>
    </div>
</div>
@endsection
