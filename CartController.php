<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;

class CartController extends Controller {

  public function add(Request $request) {
    $pid = $request->pid;
    $qty = $request->qty;

    $spdtid = $request->session()->get('pdtid');
    $sqtyid = $request->session()->get('qtyid');
    $stitle = $request->session()->get('stitle');
    $spicture = $request->session()->get('spicture');
    $totalprice = $request->session()->get('totalprice');

    $pdt = product::where('id', $pid)->first();
    $title = $pdt->title;
    if (file_exists("images/product/product-1-{$pdt->id}.{$pdt->picture1}")) {
      $picture = "product-1-{$pdt->id}.{$pdt->picture1}";
    } else if (file_exists("images/product/product-2-{$pdt->id}.{$pdt->picture2}")) {
      $picture = "product-2-{$pdt->id}.{$pdt->picture2}";
    } else if (file_exists("images/product/product-3-{$pdt->id}.{$pdt->picture3}")) {
      $picture = "product-3-{$pdt->id}.{$pdt->picture3}";
    } else {
      $picture = "noimage.gif";
    }

    $price = $pdt->price;
    $vat = $pdt->vat;
    $discount = $pdt->discount;

    if ($spdtid) {
      $index = array_search($pid, $spdtid);
      if ($index !== false) {
        $jdata['Total'] = $totalprice + (PriceCal($price, $vat, $discount) * $qty) - (PriceCal($price, $vat, $discount) * $sqtyid[$index]);
        $request->session()->put('totalprice', $jdata['Total']);

        $sqtyid[$index] = $qty;
        $request->session()->put('qtyid', $sqtyid);
        $jdata['msg'] = "Cart Update Successful";
        $jdata['status'] = 2;
      } else {
        $spdtid[] = $pid;
        $sqtyid[] = $qty;
        $stitle[] = $title;
        $spicture[] = $picture;

        $request->session()->put('pdtid', $spdtid);
        $request->session()->put('qtyid', $sqtyid);
        $request->session()->put('stitle', $stitle);
        $request->session()->put('spicture', $spicture);

        $jdata['msg'] = "Cart Added Successful";
        $jdata['status'] = 1;

        $jdata['Total'] = $totalprice + (PriceCal($price, $vat, $discount) * $qty);
        $request->session()->put('totalprice', $jdata['Total']);
        $jdata['title'] = $title;
        $jdata['picture'] = $picture;
      }
    } else {
      $request->session()->put('pdtid', array($pid));
      $request->session()->put('qtyid', array($qty));
      $request->session()->put('stitle', array($title));
      $request->session()->put('spicture', array($picture));

      $jdata['msg'] = "Cart Add Seccessful";
      $jdata['Total'] = PriceCal($price, $vat, $discount) * $qty;
      $request->session()->put('totalprice', $jdata['Total']);
      $jdata['title'] = $title;
      $jdata['picture'] = $picture;

      $jdata['status'] = 1;
    }

    return response()->json($jdata);
  }

}
