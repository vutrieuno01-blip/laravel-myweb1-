<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
public function run(): void
{

for(
$i=1;
$i<=10;
$i++
){

$name=
fake()
->unique()
->word();

DB::table(
'categories'
)
->insert([

'catename'=>$name,

'slug'=>
Str::slug(
$name
),

'image'=>
'cate.jpg',

'status'=>
1,

'sort_order'=>
$i,

'description'=>
fake()
->sentence(),

'created_at'=>
now(),

'updated_at'=>
now()

]);

}

}
}