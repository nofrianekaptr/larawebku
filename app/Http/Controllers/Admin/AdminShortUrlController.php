<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shorturl;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AdminShortUrlController extends Controller
{
    public function index()
    {
        $su = Shorturl::paginate(10);
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.short-url.index', compact('su'));
    }

    public function post(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        $input['link'] = $request->link;
        $input['code'] = Str::random(6);
        $input['hits'] = 0;

        Shorturl::create($input);

        Alert::success('Succesfully', 'Shorten Link Has Been Created !');
        return to_route('shorturl.index');
    }

    public function shortenLink($code)
    {
        $find = Shorturl::where('code', $code)->first();
        $find->increment('hits');
        return redirect($find->link);
    }

    public function destroy(Shorturl $row)
    {
        $row->delete();
        Alert::success('Succesfully', 'Shorten Link Has Been Deleted !');
        return to_route('shorturl.index');
    }
}
