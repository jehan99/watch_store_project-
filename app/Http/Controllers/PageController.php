<?php

namespace App\Http\Controllers;


class PageController extends controller {

    public function routeContactUsPg()
    {
        return view('ContactUsPage');

}


public function routeAboutUsPg()
    {
        return view('AboutUsPage');

}



public function directDeliveryPg()
    {
        return view('DeliverInfoPg');

}



public function directHomePg()
    {
        return view('HomePage');
}


public function directDeliveryPgToOrderSummery()
    {
        return view('OrderSummeryPg');
}


public function directToChangePasswordPg(){
    return view('changePasswordPg');
}



}

