<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Order;
use App\Models\Product;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Cart::count() <= 0) {
            Session::flash('error', 'Votre panier est vide.');
            return redirect()->route('products.index');
        }

        if(Cart::count() <=0 )
        {
            return redirect()->route('products.index');
        }

        Stripe::setApiKey('sk_test_51IASu2FZEmW6TLriRIfiZWM6H0M3pqYQjG0ioy3sxfKrsHxZef7DJFZm6Ly6F8rB4vxtx4CyULErEy1W7vAYRJEd00xvZtdfXs');

        $intent = PaymentIntent::create([
            'amount' => round(Cart::total()*100),
            'currency' => 'eur',
        ]);

        $clientSecret = Arr::get($intent, 'client_secret');

        return view('checkout.index', [
            'clientSecret' => $clientSecret
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $data = $request->json()->all();
     
        $order = new Order();

        $order->payment_intent_id = $data['paymentIntent']['id'];
        $order->amount = $data['paymentIntent']['amount'];

        $order->payment_created_at = (new DateTime())
            ->setTimestamp($data['paymentIntent']['created'])
            ->format('Y-m-d H:i:s');

        $products = [];
        $i = 0;

        foreach (Cart::content() as $product) {
            $products['product_' . $i][] = $product->title;
            $products['product_' . $i][] = $product->price;
            $products['product_' . $i][] = $product->qty;
            $i++;
        }

        $order->products = serialize($products);
        $order->user_id = Auth()->user()->id;
        $order->save();

        if ($data['paymentIntent']['status'] === 'succeeded') {
            $this->updateStock();
            Cart::destroy();
            Session::flash('success', 'Votre commande a été traitée avec succès.');
            return response()->json(['success' => 'Payment Intent Succeeded']);
        } else {
            return response()->json(['error' => 'Payment Intent Not Succeeded']);
        }
    }


    public function thankyou(){
        return Session::has('success') ? view('checkout.thankYou') : redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function noLongerStock()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);

            if ($item->qty > $product->stock) {
                return true;
            }
        }
        return false;
    }

    private function updateStock()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);
            $product->update(['stock' => $product->stock - $item->qty]);
        }   
    }
}
