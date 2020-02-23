<?php


namespace App\Helpers;


class Cart {
    
    public static function cartPrice($product,$keysize,$exchange) {
        
        if($keysize=='null') { 
        return $product['price'] * $exchange;
       }
         else {
        return $product['sizes'][$keysize]['pivot']['price'] * $exchange; 
         }
        
    }
    
    public static function rowPrice($product,$exchange) {
        
        if(count($product['sizes']) == 0) {
            
          return $product['price'] * $exchange * $product['details']['null'];
            
        } else {
            
          $sum = 0;
          foreach($product['details'] as $k=>$v) {
              
              $sum += $product['sizes'][$k]['pivot']['price'] * $exchange * $v;
              
          }
            return $sum;
        }
        
    }
    
    
    
    
}