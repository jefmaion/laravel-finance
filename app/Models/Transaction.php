<?php

namespace App\Models;


class Transaction extends BaseModel {

    public function category() {
        return $this->belongsTo(Category::class);
    }


    public function account() {
        return $this->belongsTo(Account::class);
    }

    public function getTransDateBRAttribute() {
        return date('d/m/Y', strtotime($this->trans_date));
    }
    
    public function getAmountAttribute($value) {
        return number_format($value, 2, ",", ".");
    }

    public function setAmountAttribute($value) {
        $this->attributes['amount'] = str_replace(",", ".", str_replace(".", "", $value));
    }

    public function getAmountTypeTextAttribute() {
        $text = [
            1 => 'Receita',
            2 => 'Despesa'
        ];

        return $text[$this->amount_type];
    }

    public function getAmountTypeClassAttribute() {

        $type = [
            1 => 'success',
            2 => 'danger'
        ];

        return $type[$this->amount_type];
    }

    public function getExecutedStatusAttribute() {
        return ($this->executed) ? 'Pago' : 'Aberto';
    }

    public function getExecutedClassAttribute() {
        return ($this->executed) ? 'info' : 'secondary';
    }
}
