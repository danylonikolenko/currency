<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Choose something
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            @if(Auth::user()->name == 'admin')
                <table class="table-fixed w-full">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">User_id</th>
                        <th class="px-4 py-2">Sum</th>
                        <th class="px-4 py-2">ResultSum</th>
                        <th class="px-4 py-2">Card</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td class="border px-4 py-2">{{ $transaction->id }}</td>
                            <td class="border px-4 py-2">{{ $transaction->user_id }}</td>
                            <td class="border px-4 py-2">{{ $transaction->sum}}</td>
                            <td class="border px-4 py-2">{{ $transaction->resultSum}}</td>
                            <td class="border px-4 py-2">{{ $transaction->card}}</td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
