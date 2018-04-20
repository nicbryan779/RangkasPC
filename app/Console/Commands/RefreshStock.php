<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Codes;
use App\Product;

class RefreshStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RefreshStock:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh stock in product table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
     protected $code;
     protected $product;

    public function __construct(Codes $code, Product $product)
    {
        parent::__construct();
        $this->code = $code;
        $this->product = $product;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $products = $this->product->all();
      foreach($products as $product)
      {
        $code = $this->code->where('product_id',$product->id)->get();
        $product->stock = $code->count();
        $product->save();
      }
    }
}
