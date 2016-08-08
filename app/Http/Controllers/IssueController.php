<?php

namespace App\Http\Controllers;

use App\Http\Requests\Issue\CreateRequest;
use App\Models\Issue;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::paginate(20);
        return view('issue/index', ['title' => 'Issue', 'issues' => $issues]);
    }

    public function create()
    {
        return view('issue/create', ['title' => 'Report Issue']);
    }

    public function store(CreateRequest $request)
    {

    }
}