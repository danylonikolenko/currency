<?php

namespace App\Http\Livewire;

use App\Models\Conversion;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class Conversions extends Component
{
    public $conversions, $user_id, $sum, $from, $to, $currencyRate, $conversion_id;
    public $isOpen = 0;
    public $currency = [];
    public $resultSum;
    public $allCurrency;
    public $allRules = false;
    public $card;


    public function render()
    {


        if(Auth::user()->name == 'admin')
            $this->allRules = true;

        $this->conversions = Conversion::all();
        $this->allCurrency = DB::table('currency')->get();
        foreach ($this->allCurrency as $currency){

            if(!in_array( $currency->ccy, $this->currency))
            array_push($this->currency, $currency->ccy);
            if(!in_array( $currency->base_ccy, $this->currency))
            array_push($this->currency, $currency->base_ccy);
        }
        array_unique($this->currency);
        return view('livewire.conversions');
    }

    public function calculate(){

        if($this->to == '')
            $this->to = 'USD';
        if($this->from == '')
            $this->to = 'USD';


       // session()->flash('message', 'from: '.$this->from.' to: '.$this->to);

        $allCurrency = DB::table('currency')->get();

        if($this->sum != ''){
            foreach ($allCurrency as $cur){

                if($cur->ccy==$this->from && $cur->base_ccy == $this->to){
                    $this->resultSum = $this->sum*$cur->buy;
                    //
                }
                if($cur->ccy==$this->to && $cur->base_ccy == $this->from){
                    $this->resultSum = $this->sum/$cur->sale;
                }
            }

        }

        if($this->to == $this->from)
        $this->resultSum = $this->sum;

    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }


    public function openModal()
    {
        $this->isOpen = true;
    }


    public function closeModal()
    {
        $this->isOpen = false;
    }


    private function resetInputFields(){
//        $this->sum = '';
//        $this->from = '';
//        $this->to = '';
    }


    public function storeTransaction()
    {

        $user_id = Auth::id();

//        $this->validate([
//            'card' => 'require',
//            'sum' => 'required',
//            'resultSum' => 'required',
//        ]);

        Transaction::updateOrCreate( [
            'user_id' => $user_id,
            'sum' => $this->sum,
            'resultSum'=>$this->resultSum,
            'card' =>$this->card

        ]);

        session()->flash('message',
            $this->conversion_id ? 'Transaction Updated Successfully.' : 'Transaction Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }
    public function store()
    {

        $user_id = Auth::id();

        $this->validate([
            'sum' => 'required',
            'from' => 'required',
            'to' => 'required',
            'resultSum' => 'required',
        ]);

        Conversion::updateOrCreate(['id' => $this->conversion_id], [
            'user_id' => $user_id,
            'sum' => $this->sum,
            'from' => $this->from,
            'to' => $this->to,
            'resultSum'=>$this->resultSum,

        ]);

        session()->flash('message',
            $this->conversion_id ? 'Conversion Updated Successfully.' : 'Conversion Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $Conversion = Conversion::findOrFail($id);
        $this->conversion_id = $id;
        $this->sum = $Conversion->sum;
        $this->from = $Conversion->from;
        $this->to = $Conversion->to;
        $this->currencyRate = $Conversion->currencyRate;

        $this->openModal();
    }


    public function delete($id)
    {
        Conversion::find($id)->delete();
        session()->flash('message', 'Conversion Deleted Successfully.');
    }
}
