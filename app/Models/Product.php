<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sku',
        'name',
        'type',
        'price',
        'image',
        'description'
    ];

    protected $hidden = [
        'created'
    ];

    public function store(int $type = -1)
    {
        $product = $this;

        if ($type > 0)
            $product = $product->where('type', $type);

        $product = $product->orderBy('name', 'ASC');
        $product = $product->get();
        return $product;
    }

    public function single(int $id = 0)
    {
        $product = $this->where('id', $id)->first();

        return $product;
    }

    public function getAll(int $start, int $limit)
    {
        $product = $this->offset($start)->limit($limit)->get();

        return $product;
    }

}
