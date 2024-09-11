<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
     */
    public function portfolio(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
//        $token = env('GITHUB_TOKEN');
//        $username = env('GITHUB_USERNAME');
//
//        $response = Http::withHeaders([
//            'Authorization' => "token $token",
//        ])->get("https://api.github.com/users/$username/repos");
//
//        if ($response->successful()) {
//            $repos = $response->json();
//
//
//        } else {
//            return redirect()->back(500, 'Failed to fetch repositories');
//        }
        return view('front.portfolio');
    }
}
