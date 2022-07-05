<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use App\Models\User;
use App\Helper\response;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\PaymentMethod;
use App\Models\Card;
use App\Models\Transaction;

class CashierController extends Controller
{
    public function __construct(User $user,Card $card,Transaction $transaction){
        $this->user = $user;
        $this->card = $card;
        $this->transaction = $transaction;
    }

    /**
     * Create customer in DB
     */
    public function createCustomer($name,$email,$password){
        try{
            $createCustomer = $this->user->create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);

            $stripeCreateCustomer = $createCustomer->createAsStripeCustomer();
            return response::returnResponse($message='Customer create success',$status=true,$body=$stripeCreateCustomer);
        }catch (\Throwable $exception){
            Log::error('Customer create fail'.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }

    }

    /**
     * Update customer in DB along with stripe sync
     */
    public function updateCustomer($name,$email,$password,$id){
        try{
            $createCustomer = $this->user->find($id)->update([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
            $updatedUser = $this->user->find($id);

            return response::returnResponse($message='Customer update success',$status=true,$body=$updatedUser);
        }catch (\Throwable $exception){
            Log::error('Customer create fail'.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }

    }

    /**
     * Find customer object
     */
    public function findCustomer($id){
        try{
            $users = $this->user->find($id);
            $findStripeCustomer = Cashier::findBillable($users->stripe_id);
            return response::returnResponse($message='Customer retrive success',$status=true,$body=$findStripeCustomer);
        }catch (\Throwable $exception){
            Log::error('Customer retrive fail'.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * Check customer balance
     */
    public function checkBalance($id){
        try{
            $users = $this->user->find($id);
            $balance = $users->balance();
            return response::returnResponse($message='Customer balance retrive success',$status=true,$body=$balance);
        }catch (\Throwable $exception){
            Log::error('Customer balance retrive fail'.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * To Credit balance to customer
     * 1 = 0.01
     * 10 = 0.10
     * 100 = 1
     */
     public function customerCreditBalance($id,$amount,$description){
         try{
            $users = $this->user->find($id);
            $apply = $users->applyBalance($amount, $description);
            $balance = $users->balance();
            return response::returnResponse($message='Customer balance credit success',$status=true,$body=$balance);
        }catch (\Throwable $exception){
            Log::error('Customer balance credit fail'.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

     /**
     * To debit balance to customer
     * 1 = 0.01
     * 10 = 0.10
     * 100 = 1
     */
    public function customerDebitBalance($id,$amount,$description){
        try{
            $users = $this->user->find($id);
            $apply = $users->applyBalance(-$amount, $description);
            $balance = $users->balance();
            return response::returnResponse($message='Customer balance debit success',$status=true,$body=$balance);
        }catch (\Throwable $exception){
            Log::error('Customer balance debit fail'.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

     /**
      * Transaction usage for a customer
      */
    public function customerBalanceTransaction($id){
        try{
            $users = $this->user->find($id);
            $userTransactions = $users->balanceTransactions();
            $transaction = array();
            foreach($userTransactions as $userTransaction){
                $transactions['name'] = $users->name;
                $transactions['customer'] = $userTransaction->customer;
                $transactions['amount']  = $userTransaction->amount;
                $transactions['ending_balance'] = $userTransaction->ending_balance;
                $transactions['description'] = $userTransaction->description;
                $transactions['currency'] = $userTransaction->currency;
                
                array_push($transaction,$transactions);
            }
            return response::returnResponse($message='Customer balance transaction list success',$status=true,$body=$transaction);
        }catch (\Throwable $exception){
            Log::error('Customer balance transaction list fail'.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * @return to blade file for single payment and add card
     */
    public function paymentForm($id){
        try{
            $users = $this->user->find($id);
            return view('stripe.stripe_payment',compact('users'));
        }catch (\Throwable $exception){
            Log::error('stripe.stripe_payment blade file fail => '.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * Make stripe payment from customer to admin
     */
    public function makePayment(Request $request){
        try{
            $users = $this->user->find($request->userId);
            $paymentMethodAdd = $users->charge($request->amount*100, $request->paymentMethodId);
            return response::returnResponse($message='Payment success',$status=true,$body=$paymentMethodAdd);   
        }catch (\Throwable $exception){
            Log::error('Payment fail'.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * Payment checkout to customer
     */
    public function makeCheckout($id,$amount,$description){
        try{
            $customer = $this->user->where('id',$id)->first();
            $checkout = $customer->checkoutCharge($amount*100,'description');
            $transactions = $this->transaction->create([
                'user_id' => $id,
                'payment_type' => 'checkout',
                'amount' => $amount,
                'currency' => $checkout->currency,
            ]);
            return redirect($checkout->url);
        }catch (\Throwable $exception){
            Log::error('Customer balance transaction list fail'.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
        
    }

    /**
     * Add payment method for adding card 
     * @return blade file
     */
    public function addPaymentMethod($id){
        try{
            $customer = $this->user->find($id);
            $intent = $customer->createSetupIntent();
            return view('stripe.add_payment_method',compact('intent','id'));
        }catch (\Throwable $exception){
            Log::error('stripe.add_payment_method blade file view => '.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * Add payment method by card
     */
    public function postPaymentMethod(Request $request){
        try{
            $customer = $this->user->find($request->userId);
            // Creating Payment method
            $paymentMethod = $customer->addPaymentMethod($request->paymentMethod);
            // Updating default payment method
            $updateDefault = $customer->updateDefaultPaymentMethod($paymentMethod->id);
            $addCard = $this->card->create([
                'user_id' => $customer->id,
                'payment_method_id' => $paymentMethod->id,
                'card_brand' => $paymentMethod->card->brand,
                'exp_month' => $paymentMethod->card->exp_month,
                'exp_year' => $paymentMethod->card->exp_year,
                'last4' => $paymentMethod->card->last4,
                'is_default' => 1,
            ]);

            return response::returnResponse($message='Card added success',$status=true,$body=$addCard);
        }catch (\Throwable $exception){
            Log::error('Card add fail '.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * Getting payment method for a user
     */
    public function getPaymentMethod($id){
        try{
            $customer = $this->user->find($id);
            $getPaymentMethod = $customer->paymentMethods();
            return response::returnResponse($message='Payment method retrived success',$status=true,$body=$getPaymentMethod);
        }catch (\Throwable $exception){
            Log::error('Get payment method for user fail '.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * Create subscription for a customer
     */
    public function createSubscription($id){
        try{
            $customer = $this->user->find($id);
            $card = $this->card->where('user_id',$id)->where('is_default',1)->first();
            $subscribe = $customer->newSubscription('default','price_1LI5nBFNmSynlNIItYrZjKmi')->create($card->card);
            return response::returnResponse($message='Subscribe success',$status=true,$body=$subscribe);
        }catch (\Throwable $exception){
            Log::error('Create subscription fail '.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * Check if the user is subscribed or not
     */
    public function checkSubscription($id){
        try{
            $customer = $this->user->find($id);
            if($customer->subscribed('default')){
                return response::returnResponse($message='Valid Subscribed User',$status=true,$body=$customer);
            }else{
                return response::returnResponse($message='Not a Subscribed User',$status=true,$body=$customer);
            }
        }catch (\Throwable $exception){
            Log::error('Subscription check fail '.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * Change the subscription for a user who is currently on another subscription
     */
    public function changeSubscription($id,$productId){
        try{
            $customer = $this->user->find($id);
            $changeSubscription = $customer->subscription('default')->swap($productId);
            return response::returnResponse($message='Subscription change success',$status=true,$body=$changeSubscription);

        }catch (\Throwable $exception){
            Log::error('Subscription change fail '.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * Amount to be deducted according to the usage
     */
    public function meteredSubscription($id,$productId){
        try{
            $customer = $this->user->find($id);
            $report = $customer->subscription('default')->reportUsage();
            return response::returnResponse($message='Report usage to stripe success',$status=true,$body=$report->quantity);
        }catch (\Throwable $exception){
            Log::error('Report usage to stripe fail '.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * Usage report for metered billing from stripe
     */
    public function usageRecord($id){
        try{
            $customer = $this->user->find($id);
            $usageRecords = $customer->subscription('default')->usageRecords();
            $transaction = array();
            foreach ($usageRecords as $usageRecord){
                $transactions['start'] = $usageRecord['period']['start'];
                $transactions['end']  = $usageRecord['period']['end'];
                $transactions['total_usage'] = $usageRecord['total_usage'];
                array_push($transaction,$transactions);
            }
            return response::returnResponse($message='Total number of times used retrive success',$status=true,$body=$transaction);
        }catch (\Throwable $exception){
            Log::error('Total number of times used retrive fail '.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    /**
     * Checkout for product
     */
    public function productCheckout($id,$productId){
        try{
            $customer = $this->user->find($id);
            $checkout = $customer->checkout($productId);
            return redirect($checkout->url);
        }catch (\Throwable $exception){
            Log::error('Product checkout fail '.$exception->getMessage());
            return response()->json(['message'=>$exception->getMessage(),'status'=>false]);
        }
    }

    public function webhookChargeSuccess(Request $request){
        dd($request->all());
    }


}
