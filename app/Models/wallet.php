<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_number',
        'balance',
        'prev_balance',
        'new_balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function credit($amount, $description = 'Manual Credit')
    {
        $prev = $this->balance;
        $this->balance += $amount;
        $this->prev_balance = $prev;
        $this->new_balance = $this->balance;
        $this->save();

        Transaction::create([
            'user_id' => $this->user_id,
            'amount' => $amount,
            'type' => 'credit',
            'description' => $description,
            'status' => 'success',
        ]);
    }

    public function debit($amount, $description = 'Manual Debit')
    {
        $prev = $this->balance;
        $this->balance -= $amount;
        $this->prev_balance = $prev;
        $this->new_balance = $this->balance;
        $this->save();

        Transaction::create([
            'user_id' => $this->user_id,
            'amount' => $amount,
            'type' => 'debit',
            'description' => $description,
            'status' => 'success',
        ]);
    }

}
