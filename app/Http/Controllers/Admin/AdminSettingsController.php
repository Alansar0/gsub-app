<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminAnnouncement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SupportCostumer;



class AdminSettingsController extends Controller
{


      public function notify()
    {
        return view('admin.settings.notify'); // Tailwind form we will add
    }

    public function notifystore(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'url' => 'nullable|url',
            'send_to' => 'nullable|in:all,users,admins' // optional filter
        ]);

        // Choose recipients (modify as needed)
        $recipients = match($request->input('send_to')) {
            'admins' => User::where('role','admin')->get(),
            'users'  => User::where('role','user')->get(),
            default  => User::all(),
        };

        Notification::send($recipients, new AdminAnnouncement($request->message, $request->url));

        return back()->with('success','Announcement sent.');
    }

     // ADMIN VIEW
    public function contactView()
    {
        $questions = SupportCostumer::all();
        return view('admin.settings.appContacts', compact('questions'));
    }

    // STORE OR UPDATE QUESTIONS
    public function contactAction(Request $request)
    {
        $data = $request->validate([
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.whatsapp_link' => 'nullable|string',
        ]);

        SupportCostumer::truncate(); // Optional: clear old ones

        foreach ($data['questions'] as $q) {
            SupportCostumer::create($q);
        }

        return back()->with('success', 'Support questions updated successfully!');
    }

}
