<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminAnnouncement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SupportSubQuestion;
use App\Models\SupportTopic;
use App\Models\wallet;



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
            $topics = SupportTopic::with('subQuestions')->get();
            return view('admin.settings.appContacts', compact('topics'));
    }

    // STORE OR UPDATE QUESTIONS
    public function storeTitleQuestion(Request $request)
    {
            $request->validate(['title' => 'required', 'whatsapp_link' => 'required|url']);
            SupportTopic::create($request->only('title', 'whatsapp_link'));
            return back()->with('success', 'Topic added successfully.');
        }

        public function storeSubQuestion(Request $request)
        {
            $request->validate([
                'support_topic_id' => 'required|exists:support_topics,id',
                'question' => 'required|string'
            ]);

            SupportSubQuestion::create($request->only('support_topic_id', 'question'));
            return back()->with('success', 'Sub-question added successfully.');
        }


                public function createWallet($user)
        {
            // Simulate calling PaymentPoint API to generate account
            $response = Http::post('https://api.paymentpoint.co/create-account', [
                'name' => $user->full_name,
                'email' => $user->email,
                'phone' => $user->phone_number,
            ]);

            if ($response->successful()) {
                $accountNumber = $response->json('account_number');

                // Store on user
                $user->update(['virtual_account' => $accountNumber]);

                // Create wallet
                Wallet::create([
                    'user_id' => $user->id,
                    'account_number' => $accountNumber,
                    'balance' => 0,
                ]);
            }
        }
}
