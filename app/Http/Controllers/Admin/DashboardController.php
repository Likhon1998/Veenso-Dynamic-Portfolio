<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\CaseStudy;
use App\Models\ClientLogo;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Page;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\WhyChooseItem;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $now = Carbon::now();

        $messagesTotal = ContactMessage::query()->count();
        $messagesThisMonth = ContactMessage::query()
            ->where('created_at', '>=', $now->copy()->startOfMonth())
            ->count();
        $messagesLastMonth = ContactMessage::query()
            ->whereBetween('created_at', [
                $now->copy()->subMonth()->startOfMonth(),
                $now->copy()->subMonth()->endOfMonth(),
            ])
            ->count();
        $unread = ContactMessage::query()->where('status', 'unread')->count();

        $published = fn (string $model) => $model::query()->where('status', 'published')->count();

        $services = $published(Service::class);
        $portfolio = $published(PortfolioItem::class);
        $caseStudies = $published(CaseStudy::class);
        $blogPosts = $published(BlogPost::class);
        $testimonials = $published(Testimonial::class);
        $pages = $published(Page::class);
        $faqs = $published(Faq::class);
        $team = $published(TeamMember::class);
        $logos = $published(ClientLogo::class);
        $whyChoose = $published(WhyChooseItem::class);

        $messageSpark = $this->dailyCounts(ContactMessage::class, 12);
        $messageChange = $this->percentChange($messagesThisMonth, $messagesLastMonth);

        $metricCards = [
            [
                'label' => 'Unread Messages',
                'value' => number_format($unread),
                'change' => $messageChange,
                'change_label' => 'vs last month',
                'icon' => 'mail',
                'color' => '#818cf8',
                'spark' => $messageSpark,
                'href' => route('admin.contact-messages.index'),
            ],
            [
                'label' => 'Messages This Month',
                'value' => number_format($messagesThisMonth),
                'change' => $messageChange,
                'change_label' => 'vs last month',
                'icon' => 'mail',
                'color' => '#a78bfa',
                'spark' => $messageSpark,
                'href' => route('admin.contact-messages.index'),
            ],
            [
                'label' => 'Total Messages',
                'value' => number_format($messagesTotal),
                'change' => null,
                'change_label' => 'all time',
                'icon' => 'mail',
                'color' => '#c084fc',
                'spark' => $messageSpark,
                'href' => route('admin.contact-messages.index'),
            ],
            [
                'label' => 'Published Services',
                'value' => number_format($services),
                'change' => null,
                'change_label' => 'live on site',
                'icon' => 'cube',
                'color' => '#60a5fa',
                'spark' => $this->flatSpark($services),
                'href' => route('admin.services.index'),
            ],
            [
                'label' => 'Portfolio Projects',
                'value' => number_format($portfolio),
                'change' => null,
                'change_label' => 'published',
                'icon' => 'folder',
                'color' => '#34d399',
                'spark' => $this->flatSpark($portfolio),
                'href' => route('admin.portfolio-items.index'),
            ],
            [
                'label' => 'Blog Posts',
                'value' => number_format($blogPosts),
                'change' => null,
                'change_label' => 'published',
                'icon' => 'doc',
                'color' => '#f472b6',
                'spark' => $this->flatSpark($blogPosts),
                'href' => route('admin.blog-posts.index'),
            ],
        ];

        [$activityLabels, $messagesSeries, $contentSeries] = $this->buildActivitySeries($now);

        return view('admin.dashboard', [
            'user' => auth()->user(),
            'unreadMessages' => $unread,
            'metricCards' => $metricCards,
            'activityLabels' => $activityLabels,
            'messagesSeries' => $messagesSeries,
            'contentSeries' => $contentSeries,
            'activitySummary' => [
                'messages_month' => number_format($messagesThisMonth),
                'messages_change' => $messageChange,
                'unread' => number_format($unread),
                'published_total' => number_format($services + $portfolio + $caseStudies + $blogPosts + $pages + $testimonials),
                'team' => number_format($team),
                'faqs' => number_format($faqs),
            ],
            'recentMessages' => ContactMessage::query()->latest()->limit(5)->get(),
            'contentOverview' => [
                ['label' => 'Pages', 'count' => $pages, 'color' => '#60a5fa', 'icon' => 'doc', 'route' => 'admin.pages.index'],
                ['label' => 'Services', 'count' => $services, 'color' => '#a78bfa', 'icon' => 'cube', 'route' => 'admin.services.index'],
                ['label' => 'Portfolio', 'count' => $portfolio, 'color' => '#34d399', 'icon' => 'folder', 'route' => 'admin.portfolio-items.index'],
                ['label' => 'Case Studies', 'count' => $caseStudies, 'color' => '#fbbf24', 'icon' => 'chart', 'route' => 'admin.case-studies.index'],
                ['label' => 'Blog Posts', 'count' => $blogPosts, 'color' => '#fb923c', 'icon' => 'edit', 'route' => 'admin.blog-posts.index'],
                ['label' => 'Testimonials', 'count' => $testimonials, 'color' => '#f472b6', 'icon' => 'star', 'route' => 'admin.testimonials.index'],
                ['label' => 'FAQs', 'count' => $faqs, 'color' => '#818cf8', 'icon' => 'faq', 'route' => 'admin.faqs.index'],
                ['label' => 'Team', 'count' => $team, 'color' => '#c4b5fd', 'icon' => 'users', 'route' => 'admin.team-members.index'],
                ['label' => 'Client Logos', 'count' => $logos, 'color' => '#67e8f9', 'icon' => 'media', 'route' => 'admin.client-logos.index'],
                ['label' => 'Why Choose', 'count' => $whyChoose, 'color' => '#fcd34d', 'icon' => 'star', 'route' => 'admin.why-choose-items.index'],
            ],
            'quickLinks' => [
                ['name' => 'Home', 'slug' => '/', 'route' => null, 'url' => url('/')],
                ['name' => 'Services', 'slug' => '/services', 'route' => 'admin.services.index', 'url' => url('/services')],
                ['name' => 'Portfolio', 'slug' => '/portfolio', 'route' => 'admin.portfolio-items.index', 'url' => url('/portfolio')],
                ['name' => 'Case Studies', 'slug' => '/case-studies', 'route' => 'admin.case-studies.index', 'url' => url('/case-studies')],
                ['name' => 'Blog', 'slug' => '/blog', 'route' => 'admin.blog-posts.index', 'url' => url('/blog')],
                ['name' => 'Contact', 'slug' => '/contact', 'route' => 'admin.contact-messages.index', 'url' => url('/contact')],
                ['name' => 'Site Settings', 'slug' => '/admin/settings', 'route' => 'admin.settings.edit', 'url' => route('admin.settings.edit')],
            ],
        ]);
    }

    private function buildActivitySeries(Carbon $now): array
    {
        $labels = [];
        $messages = [];
        $content = [];

        for ($i = 0; $i < 31; $i++) {
            $day = $now->copy()->startOfMonth()->addDays($i);
            if ($day->gt($now)) {
                break;
            }

            $labels[] = $day->format('M j');
            $start = $day->copy()->startOfDay();
            $end = $day->copy()->endOfDay();

            $messages[] = ContactMessage::query()
                ->whereBetween('created_at', [$start, $end])
                ->count();

            $content[] = Service::query()->whereBetween('updated_at', [$start, $end])->count()
                + PortfolioItem::query()->whereBetween('updated_at', [$start, $end])->count()
                + BlogPost::query()->whereBetween('updated_at', [$start, $end])->count()
                + CaseStudy::query()->whereBetween('updated_at', [$start, $end])->count()
                + Page::query()->whereBetween('updated_at', [$start, $end])->count();
        }

        return [$labels, $messages, $content];
    }

    private function dailyCounts(string $model, int $days): array
    {
        $out = [];
        for ($i = 0; $i < $days; $i++) {
            $day = Carbon::now()->subDays($days - 1 - $i);
            $out[] = $model::query()
                ->whereDate('created_at', $day->toDateString())
                ->count();
        }

        return $out;
    }

    private function flatSpark(int $value): array
    {
        $base = max(1, $value);

        return array_map(fn ($i) => max(1, (int) round($base * (0.7 + ($i * 0.025)))), range(0, 11));
    }

    private function percentChange(int $current, int $previous): ?float
    {
        if ($previous <= 0) {
            return $current > 0 ? 100.0 : null;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }
}
