<?php

namespace JonMierke\PaperLink\Http\Controllers;

use Illuminate\Http\Request;
use JonMierke\PaperLink\Models\PaperLink;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Controller as BaseController;


class PaperLinkRedirectController extends BaseController
{
    public function redirect(Request $request, string $slug)
    {
        $paperLink = PaperLink::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$paperLink) {
            abort(404); // or custom "link not found" page
        }

        // Optional: you can add extra tracking here if you want before the redirect

        // Pass the paper_link_id so the middleware can pick it up
        $request->attributes->set('paper_link_id', $paperLink->id);

        // You can also attach other context if useful
        // $request->attributes->set('paperlink', $paperLink);

        return redirect()->away($paperLink->destination_url, 302); // 302 is temporary, 301 for permanent
    }
}