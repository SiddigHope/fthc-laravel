<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'invId';

    protected $fillable = [
        'invIdNum',
        'invUser',
        'invType',
        'invStatus',
        'invNote',
        'invTotalPrice',
        'invDiscount',
        'invFinalPrice',
        'invPayMethod',
        'invDate',
        'invCreatedBy',
        'invPaymentId',
        'invInvoiceId',
        'invPaymentMethodId',
        'invRcvName',
        'invRcvEmail',
        'invRcvMobile',
        'invPaymentStatus'
    ];

    protected $casts = [
        'invStatus' => 'integer',
        'invTotalPrice' => 'decimal:2',
        'invDiscount' => 'decimal:2',
        'invFinalPrice' => 'decimal:2',
        'invDate' => 'datetime',
        'invPaymentStatus' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'invUser');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'invCreatedBy');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invId');
    }
}
