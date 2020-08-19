<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['kode_transaksi', 'user_id', 'book_id', 'tgl_pinjam', 'tgl_kembali', 'status', 'ket'];
}
