<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder
extends Seeder
{

public function run(): void
{

for(
$i=1;
$i<=50;
$i++
){

$name=
fake()
->unique()
->words(
rand(2,5),
true
);

$price=
rand(
100000,
50000000
);

DB::table(
'products'
)
->insert([

'productname'=>
ucfirst(
$name
),

'slug'=>
Str::slug(
$name
)
.
'-'
.
$i,

'price'=>
$price,

'pricediscount'=>
rand(
$price*0.7,
$price*0.9
),

'image'=>
'product.jpg',

'description'=>
fake()
->paragraph(),

'status'=>
rand(
0,
1
),

'brandid'=>
rand(
1,
10
),

'cateid'=>
rand(
1,
10
),

'created_at'=>
now(),

'updated_at'=>
now()

]);

}

}

}