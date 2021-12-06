<?php

namespace App\Http\Controllers;

use App\Facades\TinyLink\TinyLinkFacade;
use App\Models\TinyLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TinyLinkController extends Controller
{
    /**
     * Create tiny link
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request, TinyLink $tinyLink)
    {
        // Validate url
        $validated = $request->validate([
            'url' => 'required|url',
        ]);

        // Create slug
        $slug = TinyLinkFacade::creator();

        if($slug)
        {
            // Store new tiny link
            $tinyLink->url = $validated['url'];
            $tinyLink->slug = $slug;
            $tinyLink->save();

            // Store url and slug in session for show result to user
            Session::flash('url', $validated['url']);
            Session::flash('tinylink', $slug);

            return back();
        }
        else
        {
            Session::flash('error', 'خطایی رخ داده است، لطفا بعدا تلاش کنید.');

            return back();
        }
    }

    /**
     * Show real url
     *
     * @param [type] $slug
     * @return void
     */
    public function show($slug)
    {
        // Get url through slug
        $tinyLink = TinyLink::where('slug', $slug)->first();

        // If url not exist show 404 page
        if(empty($tinyLink))
        {
            abort(404);
        }
        else
        {
            // Is it expire ?
            $isExpire = TinyLinkFacade::isExpire($tinyLink, 5);

            if($isExpire)
            {
                // If expired redirect to home page and show the message
                Session::flash('expiredLink', 'انقضا لینک کوتاه شما به اتمام رسیده است.');
                return redirect('/');
            }
            else
            {
                return redirect($tinyLink->url);
            }
        }
    }
}
