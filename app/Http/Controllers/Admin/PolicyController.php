<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    //



    public function DevlomatixSolutionsPrivacy(){
        return view('client.pages.privacy');
    }


    public function DevlomatixSolutionsTerms(){
        return view('client.pages.terms');
    }


    public function DevlomatixGamesPrivacy(){
        //return "Devlomatix Games Privacy Policy";

        return view("client.policyterms.gameprivacypolicy");

    }

    public function DevlomatixGamesTerms(){
        return "Devlomatix Games Terms & Conditions";
    }


    public function DevlomatixShoppeePrivacy(){

        return view('privacy.shoppee');
    }

}
