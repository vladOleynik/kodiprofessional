<?php

namespace App\Repositories\Shop;

use App\Repositories\Contracts\Shop\OrderRepositoryInterface;
use App\Repositories\Contracts\Shop\OrderStorageInterface;
use App\Models\Shop\Order;
use App\Models\Shop\OrderStatus;
use App\Models\Catalog\Categories;
use App\Models\Catalog\Products;
use App\User;
use App\Models\Catalog\ProductsSizes;
use App\Models\Catalog\Sizes;
class OrderRepository implements OrderRepositoryInterface {

    protected $order;
    protected $storage;

    public function __construct(Order $order, OrderStorageRepository $storage) {
        $this->order = $order;
        $this->storage = $storage;
 
       
    }

    public function addItem($data) {
      

        $this->storage->addItem($data);
    }

    public function get() {
       
        $order = $this->storage->get();
        dd($order);
       // dd($order);
      // session()->flush();
        $productId = [];
        $needSizes = [];
        foreach($order as $k => $v) {
            $productId[$k] = $k ;
           $needSizes[$k] = array_keys($v);
        }
    //    dd($needSizes);
    $SizesPrice = \App\Models\Catalog\Sizes::whereIn('size',$needSizes)->pluck('id','size');
       // dd($needSizes);
   //     dd($productId);
  //  dd($SizesPrice);
        $productsList = Products::with(['meta', 'categories' => function($q) {
                        return $q->with('meta')->get();
                    }])->with('sizes')->whereIn('id', array_keys($productId))->get()->toArray();
                   
       
                  // dd($productsList,$order);
        $categoryUrl = [];
                    foreach($productsList as $k => $product) {
                    $category = Categories::where('id',$product['categories'][0]['id'])->with('meta')->first();
                    $categoryUrl = \App\Helpers\Catalog\Categories::buildUrl($category);
                    $productsList[$k]['categoryUrl'] = $categoryUrl;
                    
                    }
                    
        \App\Helpers\Arr::setKeys($productsList);
        //  \App\Helpers\Arr::setKeys($productsList);
       // dd($productsList);
 
        foreach ($order as $k => $sizes) {
           
                $productsList[$k]['details'] = $sizes;
                }
           
               
        return $productsList;     
        
    }
       
    public function removeItem($item) {
      
            $items = $this->storage->get();
           
            unset($items[$item['id']]);
           
            $this->storage->set($items);
      return ['res' => 'success'];
    }
     
    public function save($data) {
        $userId = null;
         
     
   //   dd($data);
        if(isset($data['type']) && $data['type'] == 'one_click') {
     $data['phone'] = preg_replace("/[^0-9]/", '', $data['phone']);
            if (!\Auth::check()) {
                 $checkPhone = User::wherePhone($data['phone'])->first();
              
                 if(isset($checkPhone)) {
            
                $userId = $checkPhone->id;
              
            } else {
                $pass = str_random(8);
            
            $data['user']['password'] = bcrypt($pass);
            $data['user']['name'] = $data['name'];
            $data['user']['phone'] = $data['phone'];
                  
            $user = User::create($data['user']);
             \Auth::loginUsingId($user->id);
            $userId = $user->id;
           // dd($userId);
            }
            }
            else {
            $userId = \Auth::user()->id;
        }
  
           unset($data['user'],$data['phone'],$data['name']);
        $sizeId = Sizes::where('size',$data['size'])->first()->id;
        $priceSize = ProductsSizes::where('product_id',$data['product_id'])->where('sizes_id',$sizeId)->first()->price;
       
        $data['ip_addr'] = request()->server('REMOTE_ADDR');
          // dd($data);
        $products = Products::with(['meta', 'categories' => function($q) {
                        return $q->with('meta')->get();
                    }])->where('id',$data['product_id'])->first()->toArray();
                    
                    
          
        $result = \DB::transaction(function()use ($userId, $data, $products,$priceSize) {
            
            (\App\User::find($userId)->dropshipping == 1) ?  $dropshipping = 1 :  $dropshipping = 0;
            $data['dropshipping'] = $dropshipping;
          
            $price = $data['count'] * ($products['price'] * $data['currency'] +$data['retail'] +$priceSize);
            $maxsum = \App\Models\Exchange::where('alias','UAH')->first()->price_limit;
            if($price > $maxsum || $dropshipping == 1) {
                $data['retail'] = 0;
            }
       
            
         
    
                    try {
                        $order = new Order;
                        $order->user_id = $userId;
                        $order->data = $data;
                        $order->status_id = OrderStatus::whereIsDefault(1)->first()->id;
                       
                        $order->save();
                         
                        $order->details()->insert([
                                    'order_id' => $order->id,
                                    'product_id' => $products['id'],
                                    'qty' => $data['count'],
                                    'price' => $products['price'],
                                    'options' => $data['size'],
                                    'retail'=> $priceSize
                                ]);
                        
                                $order->details()->touch();
                            
                                               \DB::commit();
                                               
                        $this->storage->clear();
                     
                        return ['res' => 'success', 'order_id' => $order->id];
                    } catch (Exception $ex) {
                        return ['res' => 'error', 'order_id' => 'error'];
                        \DB::rollBack();
                    }
                });
                
               
        return $result;
        
            };
        
                 
         if(isset($data['type']) && $data['type'] == 'normal') {
           $data['user']['phone'] = preg_replace("/[^0-9]/", '', $data['user']['phone']);
      
        if (!\Auth::check()) {
                   
            $checkPhone = User::wherePhone($data['user']['phone'])->first();
            $checkEmail = User::whereEmail($data['user']['email'])->first();
          
            if(isset($checkPhone)) {
              $userId = $checkPhone->id;
            };
            if(isset($checkEmail)) {
              $userId = $checkEmail->id;
            };
            if(isset($checkPhone) && isset($checkEmail))  {
                if($checkEmail->id == $checkPhone->id) {
                            $userId = $checkPhone->id;
                            //dd($userId);
                        } else {
                             return response()->json(['res' => 'error', 'errors' => 'errror']);
                        }
         
            }; if(!isset($checkEmail) && !isset($checkPhone)) {
                 // dd($userId);
            $pass = str_random(8);
            
            $data['user']['password'] = bcrypt($pass);
                    
            $user = User::create($data['user']);
             \Auth::loginUsingId($user->id);
            $userId = $user->id;
            };
           // dd($checkPhone);
//->orWhere('email', $data['user']['email'])
        /*    if (isset($data['user']['email'])) {
                $checkEmail = User::whereEmail($data['user']['email'])->first();
            } else {
                $checkEmail = null;
            } */
          /*  $errors = [];
            if (!is_null($checkEmail) && $checkEmail->exists) {
                $errors[] = 'email_exists';
            }
            if (!is_null($checkPhone) && $checkPhone->exists) {
                $errors[] = 'phone_exists';
            }
            if (count($errors)) {
                return response()->json(['res' => 'error', 'errors' => $errors]);
            }
           
            
               
          */ 
        } else {
            $userId = \Auth::user()->id;
        }
         }
         
        unset($data['user'],$data['_token']);
        $data['ip_addr'] = request()->server('REMOTE_ADDR');
      
        $result = \DB::transaction(function()use ($userId, $data) {
            
            if((\App\User::find($userId)->dropshipping == 1)) {
                $data['retail'] = 0;
            }
            foreach($data['count'] as $key => $value) {
                foreach($value as $size => $count) {
                    if($count == 0) {
                    unset($data['count'][$key][$size]);
                    unset($data['sizesRetail'][$key][$size]);
                    
                    }
                }
                if(empty($data['count'][$key])) {
                    unset($data['count'][$key]);
                    unset($data['sizesRetail'][$key]);
                   
                }                
            }
          
   
         if(!empty($data['count'])) {
             
                    try {
                        $order = new Order;
                        $order->user_id = $userId;
                        $order->data = $data;
                        $order->status_id = OrderStatus::whereIsDefault(1)->first()->id;
                        $order->save();
                
                        foreach ($data['count'] as $productId => $items) {
                        
                        foreach($items as $k => $v) {
                      
                       
                                $order->details()->insert([
                                    'order_id' => $order->id,
                                    'product_id' => $productId,
                                    'qty' =>$v,
                                    'price' => $this->get()[$productId]['price'],
                                    'options' => $k,
                                    'retail' => $data['sizesRetail'][$productId][$k],
                                    
                                    
                                    
                                ]);
                                
                                $order->details()->touch();
                        
                            }
                        }
                        \DB::commit();
                        $this->storage->clear();
                        if(isset($data['payment'])) {
                        return ['res' => 'success', 'order_id' => $order->id,'payment' => $data['payment']];
                        } else {
                            return ['res' => 'success', 'order_id' => $order->id];
                        }
                    } catch (Exception $ex) {
                        return ['res' => 'error', 'order_id' => 'error'];
                        \DB::rollBack();
                    }
         } 
                });
                
               
        return $result;
    }

    public function count() {
        $items = $this->get();
        $sum = 0;
        foreach ($items as $item) {
            foreach ($item['details'] as $d) {
                $sum += $d['count'];
            }
        }
        return $sum;
    }

}
