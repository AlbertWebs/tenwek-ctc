<?php

namespace App\Http\Controllers;

use App\Models\ContactEnquiry;
use App\Models\HomeStat;
use App\Models\HeroSlide;
use App\Models\ImpactStory;
use App\Models\NewsArticle;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Support\PublicAssetUrl;
use Illuminate\Support\Facades\Storage;
use App\Models\HistoryMilestone;
use App\Models\AboutSection;

class PageController extends Controller
{
    public function home()
    {
        $stats = HomeStat::query()->visible()->ordered()->get(['value', 'label']);
        if ($stats->isEmpty()) {
            $stats = collect([
                ['value' => '5,000+', 'label' => 'Surgeries Performed'],
                ['value' => '15+', 'label' => 'Countries Served'],
                ['value' => '25+', 'label' => 'Years of Experience'],
                ['value' => '50+', 'label' => 'Surgeons Trained'],
            ]);
        }

        $services = Service::visible()->ordered()->take(8)->get();
        $team = TeamMember::visible()->ordered()->take(4)->get();
        $news = NewsArticle::published()->latest()->take(3)->get();

        $heroMode = SiteSetting::getValue('hero.mode', 'video');
        $heroVideoUrl = SiteSetting::getValue('hero.video_url', config('ctc.hero_video'));
        $heroSlides = HeroSlide::query()->visible()->ordered()->get();
        $servicesImagePath = SiteSetting::getValue('home.services_image_path');
        $servicesImageUrl = PublicAssetUrl::toUrl($servicesImagePath);

        $impactImageUrl = ImpactStory::query()
            ->visible()
            ->ordered()
            ->whereNotNull('image')
            ->value('image');

        $impactImageUrl = $impactImageUrl ?: config('ctc.page_banner_image');

        return view('pages.home', compact(
            'stats',
            'services',
            'team',
            'news',
            'heroMode',
            'heroVideoUrl',
            'heroSlides',
            'servicesImageUrl',
            'impactImageUrl'
        ));
    }

    public function about()
    {
        $sections = AboutSection::query()->visible()->ordered()->get();

        $metaDescription = 'Learn about the Cardiothoracic Centre at Tenwek Hospital—our mission, history, and commitment to advanced heart and chest care in East Africa.';

        return view('pages.about', compact('sections', 'metaDescription'));
    }

    public function history()
    {
        $milestones = HistoryMilestone::query()->visible()->ordered()->get();

        $metaDescription = 'The history of Tenwek Cardiothoracic Centre—key milestones, growth, and impact in expanding access to advanced cardiac care in Africa.';

        return view('pages.history', compact('milestones', 'metaDescription'));
    }

    public function specialists()
    {
        $team = TeamMember::visible()->ordered()->get();
        return view('pages.specialists', compact('team'));
    }

    public function specialistShow(TeamMember $teamMember)
    {
        $metaDescription = $teamMember->bio
            ? str($teamMember->bio)->stripTags()->limit(160)
            : (($teamMember->specialization ?: $teamMember->title) ? ("Meet {$teamMember->name} — {$teamMember->title} at Tenwek Cardiothoracic Centre.") : "Meet {$teamMember->name} at Tenwek Cardiothoracic Centre.");

        $related = TeamMember::query()
            ->visible()
            ->where('id', '!=', $teamMember->id)
            ->ordered()
            ->take(6)
            ->get();

        return view('pages.specialist-show', compact('teamMember', 'related', 'metaDescription'));
    }

    public function services()
    {
        $cardiac = Service::visible()->inCategory(Service::CATEGORY_CARDIAC)->ordered()->get();
        $thoracic = Service::visible()->inCategory(Service::CATEGORY_THORACIC)->ordered()->get();
        $diagnostics = Service::visible()->inCategory(Service::CATEGORY_DIAGNOSTICS)->ordered()->get();
        return view('pages.services', compact('cardiac', 'thoracic', 'diagnostics'));
    }

    public function serviceShow(Service $service)
    {
        $related = Service::query()
            ->visible()
            ->inCategory($service->category)
            ->where('id', '!=', $service->id)
            ->ordered()
            ->take(6)
            ->get();

        $metaDescription = $service->description
            ? str($service->description)->stripTags()->limit(160)
            : ('Learn more about ' . $service->name . ' at Tenwek Cardiothoracic Centre.');

        return view('pages.service-show', compact('service', 'related', 'metaDescription'));
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

    public function trainingResearch()
    {
        return view('pages.training-research');
    }

    public function impact()
    {
        $stories = ImpactStory::query()->visible()->ordered()->take(6)->get();
        $latestNews = NewsArticle::published()->latest()->take(3)->get();

        $feature = ImpactStory::query()
            ->visible()
            ->ordered()
            ->where(function ($q) {
                $q->whereNotNull('media_url')->orWhereNotNull('image_path')->orWhereNotNull('image');
            })
            ->first();

        $metaDescription = 'Impact of Tenwek CTC across Africa: patient stories, milestones, training the next generation of surgeons, and expanding access to life-saving care.';

        return view('pages.impact', compact('stories', 'latestNews', 'feature', 'metaDescription'));
    }

    public function support()
    {
        return view('pages.support');
    }

    public function news()
    {
        $articles = NewsArticle::published()->latest()->paginate(9);
        $recent = NewsArticle::query()->published()->latest()->take(8)->get();

        $metaDescription = 'News, events, and announcements from the Cardiothoracic Centre at Tenwek Hospital.';

        return view('pages.news', compact('articles', 'recent', 'metaDescription'));
    }

    public function newsShow(string $slug)
    {
        $article = NewsArticle::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $recent = NewsArticle::query()
            ->published()
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(5)
            ->get();

        $metaDescription = $article->excerpt
            ? str($article->excerpt)->stripTags()->limit(160)
            : str($article->body ?? '')->stripTags()->limit(160);

        return view('pages.news-show', compact('article', 'recent', 'metaDescription'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function internationalPatients()
    {
        return view('pages.international-patients');
    }

    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }

    public function termsOfService()
    {
        return view('pages.terms-of-service');
    }

    public function feedbackAndComplaints()
    {
        $a = random_int(2, 9);
        $b = random_int(1, 9);
        session([
            'feedback_math_a' => $a,
            'feedback_math_b' => $b,
        ]);

        return view('pages.feedback-and-complaints', [
            'mathA' => $a,
            'mathB' => $b,
        ]);
    }

    public function submitFeedbackAndComplaints(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'type' => 'required|string|in:feedback,complaint',
            'message' => 'required|string|max:5000',
            'math_answer' => 'required|integer|min:0|max:100',
        ]);

        $a = (int) session('feedback_math_a');
        $b = (int) session('feedback_math_b');
        $expected = $a + $b;
        if (! $a || ! $b || (int) $request->input('math_answer') !== $expected) {
            return back()
                ->withErrors(['math_answer' => 'Please answer the anti-spam question correctly.'])
                ->withInput();
        }

        ContactEnquiry::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => ucfirst($request->input('type')) . ' submission',
            'message' => $request->input('message'),
            'source' => $request->input('type') === 'complaint' ? 'complaint' : 'feedback',
            'status' => ContactEnquiry::STATUS_NEW,
        ]);

        $request->session()->forget(['feedback_math_a', 'feedback_math_b']);

        return redirect()
            ->route('feedback')
            ->with('success', 'Thank you. Your submission has been received.');
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
        // Honeypot spam protection: if filled, silently accept but ignore.
        if (!empty($request->input('website'))) {
            return redirect()->route('support')->with('success', 'Thank you. We have received your enquiry and will be in touch soon.');
        }

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
