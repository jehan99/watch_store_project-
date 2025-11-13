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



}