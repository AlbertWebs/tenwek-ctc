<?php

namespace App\Http\Controllers;

use App\Models\ContactEnquiry;
use App\Models\NewsArticle;
use App\Models\Service;
use App\Models\TeamMember;

class PageController extends Controller
{
    public function home()
    {
        $stats = [
            ['value' => '5,000+', 'label' => 'Surgeries Performed'],
            ['value' => '15+', 'label' => 'Countries Served'],
            ['value' => '25+', 'label' => 'Years of Experience'],
            ['value' => '50+', 'label' => 'Surgeons Trained'],
        ];

        $services = Service::visible()->ordered()->take(4)->get();
        $team = TeamMember::visible()->ordered()->take(4)->get();
        $news = NewsArticle::published()->latest()->take(3)->get();

        return view('pages.home', compact('stats', 'services', 'team', 'news'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function team()
    {
        $team = TeamMember::visible()->ordered()->get();
        return view('pages.team', compact('team'));
    }

    public function services()
    {
        $cardiac = Service::visible()->inCategory(Service::CATEGORY_CARDIAC)->ordered()->get();
        $thoracic = Service::visible()->inCategory(Service::CATEGORY_THORACIC)->ordered()->get();
        $diagnostics = Service::visible()->inCategory(Service::CATEGORY_DIAGNOSTICS)->ordered()->get();
        return view('pages.services', compact('cardiac', 'thoracic', 'diagnostics'));
    }

    public function patientInformation()
    {
        return view('pages.patient-information');
    }

    public function training()
    {
        return view('pages.training');
    }

    public function research()
    {
        return view('pages.research');
    }

    public function impact()
    {
        return view('pages.impact');
    }

    public function support()
    {
        return view('pages.support');
    }

    public function news()
    {
        $articles = NewsArticle::published()->latest()->paginate(9);
        return view('pages.news', compact('articles'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:5000',
        ]);
        ContactEnquiry::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => 'Contact form',
            'message' => $request->input('message'),
            'source' => 'contact',
        ]);
        return redirect()->route('contact')->with('success', 'Thank you. We have received your message and will get back to you soon.');
    }

    public function submitSupportEnquiry(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'enquiry_type' => 'required|string|in:sponsor,equipment,partner',
            'message' => 'required|string|max:5000',
        ]);
        ContactEnquiry::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => 'Support: ' . $request->input('enquiry_type'),
            'message' => $request->input('message'),
            'source' => 'support-' . $request->input('enquiry_type'),
        ]);
        return redirect()->route('support')->with('success', 'Thank you. We have received your enquiry and will be in touch soon.');
    }
}
