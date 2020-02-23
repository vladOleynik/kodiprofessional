<?php

namespace App\Models\Catalog;

use App\Models\Model;
use App\Helpers\Seo;
use App\Http\Controllers\Catalog\IndexController;
use Illuminate\Support\Facades\DB;
//для версии 5.2 и ранее:
//use DB;
use App\Http\Controllers\Controller;
class Feed extends Model
{
    static function getXMLFeedData()
    {
        $siteUrl = vsprintf("%s://%s", [$_SERVER['HTTP_X_FORWARDED_PROTO'], $_SERVER['HTTP_HOST']]);
        $url = \App\Helpers\Catalog\Categories::all();
        $limit = 300;
        $products = Product::take($limit)->get();
        $data = [];
        if($products){
            foreach ($products as $key=>$product){
                $product = Product::with('meta','categories')->find($products[$key]['id'])->toArray();
                if($product['published'] && $product['title'] && $product['images'] && isset($product['images'][0]) && $product['meta']['alias']){
                                    $category = $product['categories'][0];
                $active = $url['urls'][$category['id']];
                    $data[] = [
                        'id' => $product['id'],
                        'title' => $product['title'],
                        'description' => htmlspecialchars(strip_tags (html_entity_decode($product['description']))),
                        'url' => $siteUrl . (\App\Helpers\Catalog\Products::buildUrl($product['meta']['alias'], $active)),
                        'image' => $siteUrl . '/' . $product['images'][0],
                        'status' => 'In stock',
                        'condition' => 'New',
                        'price' => $product['price'],
                        'old_price' => $product['old_price'],
                        'ean'=> $product['ean']
                    ];

                }
            }
        }
        $MetaData = DB::table('globalmeta')->where('url', '/')->first();
        $siteUrl = vsprintf("%s://%s", [$_SERVER['HTTP_X_FORWARDED_PROTO'], $_SERVER['HTTP_HOST']]);
        $siteTitle = $MetaData->meta_title;
        $siteDescription = $MetaData->meta_description;
        if ($products) {

            $dom = new \domDocument("1.0", "utf-8");
            $root = $dom->createElement("rss");
            $root->setAttribute("xmlns:g", "http://base.google.com/ns/1.0");
            $root->setAttribute("version", "2.0");
            $dom->appendChild($root);
            $channel = $dom->createElement("channel");
            $title = $dom->createElement("title", $siteTitle);
            $link = $dom->createElement("link", $siteUrl);
            $description = $dom->createElement("description", $siteDescription);
            $channel->appendChild($title);
            $channel->appendChild($link);
            $channel->appendChild($description);
            $date = date("Y-m-d", time());
            foreach ($data as $product) {
                $item = $dom->createElement("item");
                $gshipping = $dom->createElement('g:shipping');

                $item->appendChild($dom->createElement("g:id", $product['id']));
                $item->appendChild($dom->createElement("g:title", htmlspecialchars($product['title'])));
                $item->appendChild($dom->createElement("g:description", $product['description']));
                $item->appendChild($dom->createElement("g:link",$product['url']));
                $item->appendChild($dom->createElement("g:gtin",$product['ean']));
                $item->appendChild($dom->createElement("g:image_link", $product['image']));
                $item->appendChild($dom->createElement("g:condition", $product['condition']));
                $item->appendChild($dom->createElement("g:availability", $product['status']));
                $gshipping->appendChild($dom->createElement("g:service", 'Banderol'));
                $gshipping->appendChild($dom->createElement("g:price", '0 USD'));
                if($product['old_price']) {
                    $item->appendChild($dom->createElement("g:price", $product['old_price'] . ' USD'));
                    $item->appendChild($dom->createElement("g:sale", $product['price']. ' USD'));
                }else{
                    $item->appendChild($dom->createElement("g:price", $product['price']. ' USD'));
                }
                $item->appendChild($dom->createElement("g:mpn", $product['id']));
                $item->appendChild($gshipping);

                $channel->appendChild($item);
            }
            $root->appendChild($channel);
            $output = $dom->saveXML();
        }
        return $output;
    }
}
