
<?php 

use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function store(Request $request)
    {
        // Make sure user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'province' => 'required',
        ]);

        Delivery::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'address' => $request->address,
            'province' => $request->province,
        ]);

        return redirect()->back()->with('success', 'Order placed successfully!');
    }
}
