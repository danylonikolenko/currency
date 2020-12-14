<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>?
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">

                        <table class="table table-auto border-separate shadow">
                            <thead>
                                <tr>
                                    <th  class="border px-4 py-2">ccy</th>
                                    <th  class="border px-4 py-2">base_ccy</th>
                                    <th  class="border px-4 py-2">buy</th>
                                    <th  class="border px-4 py-2">sale</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allCurrency as $conv)
                                <tr>
                                    <td  class="border px-4 py-2">{{$conv->ccy}}</td>
                                    <td  class="border px-4 py-2">{{$conv->base_ccy}}</td>
                                    <td  class="border px-4 py-2">{{$conv->buy}}</td>
                                    <td  class="border px-4 py-2">{{$conv->sale}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mb-4" style="margin-top: 10px;">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Sum:</label>
                            <input type="number" wire:change="calculate" style="width: 50%" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Sum" wire:model="sum">
                            @error('sum') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">From:</label>
                            <select  class="selectMsg bg-gray-800 py-2 px-4 hover:bg-gray-600 text-white font-normal  rounded my-3"
                                     wire:model="from" wire:change="calculate">
                                    @foreach($currency as $cur)
                                        <option  value="{{$cur}}">
                                            {{$cur}}
                                        </option>
                                    @endforeach
                            </select>
                            @error('from') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">To:</label>
                            <select  class="selectMsg bg-gray-800 py-2 px-4 hover:bg-gray-600 text-white font-normal  rounded my-3"
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
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Result:</label>
                            <input  wire:model="resultSum"   style="width: 50%" readonly type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" >
                            @error('resultSum') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                Save
                </button>
                </span>
                                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                Cancel
                </button>
                </span>
                </div>
            </form>
        </div>
    </div>
</div>
