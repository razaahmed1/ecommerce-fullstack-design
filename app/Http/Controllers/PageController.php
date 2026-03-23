<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the About Us page.
     */
    public function about()
    {
        return view('pages.static.about');
    }

    /**
     * Display the Delivery Information page.
     */
    public function delivery()
    {
        return view('pages.static.delivery');
    }

    /**
     * Display the Privacy Policy page.
     */
    public function privacy()
    {
        return view('pages.static.privacy');
    }

    /**
     * Display the Terms & Conditions page.
     */
    public function terms()
    {
        return view('pages.static.terms');
    }

    /**
     * Display the Contact Us page.
     */
    public function contact()
    {
        return view('pages.static.contact');
    }
}
