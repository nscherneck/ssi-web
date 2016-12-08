<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Customer;
use App\Site;
use App\System;
use App\Test;
use App\Photo;
use DB;

class SystemsController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function show(System $system)
    {
      $test_types = DB::table('test_types')->get();
      $test_results = DB::table('test_results')->get();
      $technicians = DB::table('users')->get();
      $manufacturers = DB::table('manufacturers')->orderBy('name', 'asc')->get();
      $system_types = DB::table('system_types')->get();
      $photos = Photo::orderBy('created_at', 'desc')->where('photoable_id', '=', $system->id)->get();
      return view('systems.show', compact('system', 'test_types', 'test_results', 'technicians', 'manufacturers', 'system_types', 'photos'));
    }

    public function store(Request $request, Site $site)
    {
      $system = new System;
      $system->site_id = $site->id;
      $system->name = $request->name;
      $system->system_type_id = $request->type;
      $system->install_date = $request->install_date;
      $system->ssi_install = $request->ssi_install;
      $system->ssi_test_acct = $request->ssi_test_acct;
      $system->added_by = Auth::id();

      $system->save();

      flash('System created', 'Success');
      return redirect()->route('site_show', ['id' => $site->id]);
    }

    public function update(Request $request, System $system)
    {
        $system->name = $request->name;
        $system->system_type_id = $request->type;
        $system->install_date = $request->install_date;
        $system->ssi_install = $request->ssi_install;
        $system->ssi_test_acct = $request->ssi_test_acct;
        $system->updated_by = Auth::id();

        $system->update();

        flash('System updated', 'Success');
        return redirect()->route('system_show', ['id' => $system->id]);
    }

    public function destroy(System $system)
    {
      if(count($system->tests) > 0) {
        flash('Cannot delete system, it has one or more tests', 'Error');
        return redirect()->route('system_show', ['id' => $system->id]);
      } else {
        $site = Site::find($system->site_id);
        $system->delete();

        flash('System deleted', 'Error');
        return redirect()->route('site_show', ['id' => $site->id]);
      }
    }

}
