<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table = 'invoice_items';
    protected $primaryKey = 'invItemId';

    protected $fillable = [
        'invId',
        'crsId',
        'invItemQty',
        'invItemPrice',
        'invItemDiscount',
        'invItemTotal',
        'invItemNote',
        'invItemType'
    ];

    protected $casts = [
        'invItemQty' => 'integer',
        'invItemPrice' => 'decimal:2',
        'invItemDiscount' => 'decimal:2',
        'invItemTotal' => 'decimal:2',
        'invItemType' => 'integer'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invId');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'crsId');
    }
}
