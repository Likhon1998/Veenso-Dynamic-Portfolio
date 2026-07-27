<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
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

        $relatedCaseStudies = CaseStudy::query()
            ->where('status', 'published')
            ->where('id', '!=', $caseStudy->id)
            ->orderBy('sort_order')
            ->take(2)
            ->get();

        return view('case-studies.show', [
            'caseStudy' => $caseStudy,
            'relatedCaseStudies' => $relatedCaseStudies,
        ]);
    }
}
