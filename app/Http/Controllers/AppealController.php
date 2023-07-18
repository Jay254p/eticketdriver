<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppealController extends Controller
{
    public function appealAction(Request $request, $ticketId)
    {
       
     // Retrieve a random user with the role "Judge"
     $judge = User::role('Judge')->inRandomOrder()->first();

     if ($judge) {
         // Judge found, proceed with appeal record creation
         $randomDigit = mt_rand(1, 4);
 
         // Create a new instance of the Appeal model
         $appeal = new Appeal();
         $appeal->TicketId = $ticketId;
         $appeal->licencenumber = Auth::user()->licencenumber;
         $appeal->badgenumber = $judge->badgenumber;
         $appeal->time = $this->generateRandomTime();
         $appeal->roomnumber = $randomDigit;
 
         // Save the appeal record to the database
         $appeal->save();
 
         // Redirect back to the view with a success message
         return redirect()->route('appeals.show')->with('success', 'Appeal submitted successfully!');
     } else {
         // No judge found with the role "Judge"
         // Handle the error or display a message
         return redirect()->route('appeals.show')->with('error', 'No judge found with the role "Judge".');
     }
    }

    // Helper function to generate random time between 08:00 and 16:00
    private function generateRandomTime()
    {
        $hour = mt_rand(8, 16); // Random hour between 8 and 16 (4 PM)
        $minute = mt_rand(0, 59); // Random minute between 0 and 59
        $second = 0; // We set the seconds to 0

        return date('Y-m-d H:i:s', strtotime("$hour:$minute:$second"));
    }
}
