<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Support\CaseStudyContent;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    public function index(): View
    {
        $caseStudies = CaseStudy::query()
            ->where('status', 'published')
            ->orderByDesc('featured')
            ->orderBy('sort_order')
            ->get();

        return view('case-studies.index', [
            'page' => \App\Models\Page::query()->where('slug', 'case-studies')->where('status', 'published')->first(),
            'caseStudies' => $caseStudies,
        ]);
    }

    public function show(CaseStudy $caseStudy): View
    {
        abort_unless($caseStudy->status === 'published', 404);

        $caseStudy->load('images');

        $relatedCaseStudies = CaseStudy::query()
            ->where('status', 'published')
            ->where('id', '!=', $caseStudy->id)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        $challenge = CaseStudyContent::parseChallenge($caseStudy->challenge);
        $strategyCards = CaseStudyContent::parseStrategyCards($caseStudy->strategy);
        $meta = CaseStudyContent::parseMetaFromExcerpt($caseStudy->excerpt);
        $primaryStat = ! empty($caseStudy->stats) ? $caseStudy->stats[0] : null;

        return view('case-studies.show', [
            'caseStudy' => $caseStudy,
            'relatedCaseStudies' => $relatedCaseStudies,
            'challengeIntro' => $challenge['intro'],
            'challengeBlockers' => $challenge['blockers'],
            'strategyCards' => $strategyCards,
            'caseMeta' => $meta,
            'primaryStat' => $primaryStat,
        ]);
    }
}
