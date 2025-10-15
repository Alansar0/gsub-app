<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportCategory;
use App\Models\SupportQuestion;

class SupportAdminController extends Controller
{
    public function index()
    {
        $categories = SupportCategory::with('questions')->get();
        return view('admin.support.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'default_whatsapp_link' => 'nullable|url',
            'questions' => 'required|array|min:1',
            'questions.*' => 'required|string|max:255',
        ]);

        $category = SupportCategory::create([
            'title' => $request->title,
            'default_whatsapp_link' => $request->default_whatsapp_link,
        ]);

        foreach ($request->questions as $question) {
            SupportQuestion::create([
                'category_id' => $category->id,
                'question' => $question,
            ]);
        }

        return back()->with('success', 'Support category and questions added successfully.');
    }
}

