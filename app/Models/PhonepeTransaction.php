<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class PhonepeTransaction extends Model
{
    use HasFactory;

    #Allow all attributes to be mass assignable
    protected $guarded = [];


    public function storeTransaction($storeData)
    {
        $result = PhonepeTransaction::create($storeData);
        return $result->id;
    }

    public function updateTransaction(array $updateData = [])
    {
        return PhonepeTransaction::where('id', Session::get('phonePePrimaryKey'))->update($updateData);
    }
}
