<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Choose something
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                     role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="">

                            <table class="table table-auto border-separate shadow">
                                <thead>
                                <tr>
                                    <th class="border px-4 py-2">ccy</th>
                                    <th class="border px-4 py-2">base_ccy</th>
                                    <th class="border px-4 py-2">buy</th>
                                    <th class="border px-4 py-2">sale</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allCurrency as $conv)
                                    <tr>
                                        <td class="border px-4 py-2">{{$conv->ccy}}</td>
                                        <td class="border px-4 py-2">{{$conv->base_ccy}}</td>
                                        <td class="border px-4 py-2">{{$conv->buy}}</td>
                                        <td class="border px-4 py-2">{{$conv->sale}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="mb-4" style="margin-top: 10px;">
                                <label for="exampleFormControlInput1"
                                       class="block text-gray-700 text-sm font-bold mb-2">Sum:</label>
                                <input type="number" wire:change="calculate" style="width: 50%" type="text"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                       id="exampleFormControlInput1" placeholder="Enter Sum" wire:model="sum">
                                @error('sum') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput2"
                                       class="block text-gray-700 text-sm font-bold mb-2">From:</label>
                                <select
                                    class="selectMsg bg-gray-800 py-2 px-4 hover:bg-gray-600 text-white font-normal  rounded my-3"
                                    wire:model="from" wire:change="calculate">
                                    @foreach($currency as $cur)
                                        <option value="{{$cur}}">
                                            {{$cur}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('from') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput2"
                                       class="block text-gray-700 text-sm font-bold mb-2">To:</label>
                                <select
                                    class="selectMsg bg-gray-800 py-2 px-4 hover:bg-gray-600 text-white font-normal  rounded my-3"
                                    wire:model="to" wire:change="calculate">
                                    @foreach($currency as $cur)
                                        <option value="{{$cur}}">
                                            {{$cur}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('to') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput1"
                                       class="block text-gray-700 text-sm font-bold mb-2">Result:</label>
                                <input wire:model="resultSum" style="width: 50%" readonly type="text"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                       id="exampleFormControlInput1">
                                @error('resultSum') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="store()" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                 Save
                            </button>
                        </span>

                    </div>
                </form>

            </div>
                <div style="width: 90%;">
                    <button wire:click="create()"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create Transaction
                    </button>

                </div>
            @if($isOpen)
                @include('livewire.createTransction')
            @endif
            @if($allRules)
                <table class="table-fixed w-full">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">User_id</th>
                        <th class="px-4 py-2">Sum</th>
                        <th class="px-4 py-2">From</th>
                        <th class="px-4 py-2">To</th>
                        <th class="px-4 py-2">ResultSum</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($conversions as $conversion)
                        <tr>
                            <td class="border px-4 py-2">{{ $conversion->id }}</td>
                            <td class="border px-4 py-2">{{ $conversion->user_id }}</td>
                            <td class="border px-4 py-2">{{ $conversion->sum}}</td>
                            <td class="border px-4 py-2">{{ $conversion->from}}</td>
                            <td class="border px-4 py-2">{{ $conversion->to}}</td>
                            <td class="border px-4 py-2">{{ $conversion->resultSum}}</td>

                            <td class="">
                                {{--                            <button wire:click="edit({{ $conversion->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>--}}
                                <button wire:click="delete({{ $conversion->id }})"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
