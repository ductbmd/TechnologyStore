<?php

namespace App\Models\Cart;



class Cart 
{
    public $items=null;
    public $laptops=null;
    public $totalQty=0;
    public $totalPrice=0;
    public function __construct($oldCart)
    {
    	if($oldCart){
            if($oldCart->laptops) $this->laptops=$oldCart->laptops;
    		if($oldCart->items) $this->items=$oldCart->items;
    		$this->totalQty=$oldCart->totalQty;
    		$this->totalPrice=$oldCart->totalPrice;
    	} 
    }
    public function addProduct($item,$id,$qty)
    {
    	$storeItem=['qty'=>0,'price'=>$item->price,'item'=>$item];
    	if($this->items){
    		if(array_key_exists($id, $this->items)){
    			$storeItem=$this->items[$id];
    		}
    	}
    	$storeItem['qty']+=$qty;
    	$storeItem['price']=$item->price * $storeItem['qty'];
    	$this->items[$id]=$storeItem;
    	$this->totalQty+=$qty;
    	$this->totalPrice+=$item->price*$qty;
    }
    public function subProduct($id)
    {
            if(array_key_exists($id, $this->items)){
                $this->totalQty-=$this->items[$id]['qty'];
                $this->totalPrice-=$this->items[$id]['price'];
            }
        unset($this->items[$id]);
    }
    public function addLaptop($item,$qty)
    {
        $storeItem=['qty'=>0,'price'=>$item->price,'item'=>$item];
        if($this->laptops){
            if(array_key_exists($item->id, $this->laptops)){
                $storeItem=$this->laptops[$item->id];
            }
        }
        $storeItem['qty']+=$qty;
        $storeItem['price']=$item->price * $storeItem['qty'];
        $this->laptops[$item->id]=$storeItem;
        $this->totalQty+=$qty;
        $this->totalPrice+=$item->price*$qty;
    }
    public function subLaptop($id)
    {
            if(array_key_exists($id, $this->laptops)){
                $this->totalQty-=$this->laptops[$id]['qty'];
                $this->totalPrice-=$this->laptops[$id]['price'];
            }
        unset($this->laptops[$id]);
    }
    
}
