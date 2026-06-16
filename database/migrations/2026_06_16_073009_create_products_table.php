<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
Schema::create(
'products',

function(
Blueprint $table
){

$table->id();

$table
->string(
'productname',
150
);

$table
->string(
'slug'
)
->unique();

$table
->integer(
'price'
);

$table
->integer(
'pricediscount'
);

$table
->string(
'image'
)
->nullable();

$table
->text(
'description'
)
->nullable();

$table
->tinyInteger(
'status'
)
->default(
1
);

$table
->unsignedBigInteger(
'brandid'
)
->nullable();

$table
->unsignedBigInteger(
'cateid'
);

$table
->timestamps();

$table
->foreign(
'brandid'
)
->references(
'id'
)
->on(
'brands'
)
->nullOnDelete();

$table
->foreign(
'cateid'
)
->references(
'id'
)
->on(
'categories'
)
->restrictOnDelete();

});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
