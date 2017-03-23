<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Customer;
use App\Site;
use App\System;
use App\Test;
use App\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SystemsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show(System $system)
    {
        $now = Carbon::now()
            ->setTimezone('America/Los_Angeles')
            ->format('Y-m-d');
        $test_types = DB::table('test_types')
            ->orderBy('name')
            ->get();
        $test_results = DB::table('test_results')
            ->orderBy('name')
            ->get();
        $technicians = DB::table('users')
            ->orderBy('first_name')
            ->get();
        $manufacturers = DB::table('manufacturers')
            ->orderBy('name', 'asc')
            ->get();
        $system_types = DB::table('system_types')->get();
        $photos = Photo::orderBy('created_at', 'desc')
            ->where('photoable_id', '=', $system->id)
            ->get();
        return view('systems.show', compact(
            'now', 
            'system', 
            'test_types', 
            'test_results', 
            'technicians', 
            'manufacturers', 
            'system_types', 
            'photos'
            )
        );
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
        $system->notes = $request->notes;
        $system->added_by = Auth::id();
        
        $system->save();
        
        flash('Success!', 'System created.');

        return redirect()->route('site_show', ['id' => $site->id]);
    }
    
    public function update(Request $request, System $system)
    {
        $system->name = $request->name;
        $system->system_type_id = $request->type;
        $system->install_date = $request->install_date;
        $system->ssi_install = $request->ssi_install;
        $system->ssi_test_acct = $request->ssi_test_acct;
        $system->notes = $request->notes;
        $system->updated_by = Auth::id();
        
        $system->update();
        
        flash('Success!', 'System updated.', 'Success');

        return redirect()->route('system_show', ['id' => $system->id]);
    }
    
    public function updateNextTestDate(Request $request, System $system) 
    {
        $system->next_test_date = $request->next_test_date;

        $system->save();
        
        flash('Success!', 'Next test date updated.', 'success');

        return redirect()->route('system_show', ['id' => $system->id]);
    }
    
    public function destroy(System $system)
    {
        if(count($system->tests) > 0) {
            flash('Nope!', 'Cannot delete system, it has one or more tests', 'warning');
            return redirect()->route('system_show', ['id' => $system->id]);
        } else {
            $site = Site::find($system->site_id);

            $system->delete();
            
            flash('Success!', 'System deleted.', 'danger');
            
            return redirect()->route('site_show', ['id' => $site->id]);
        }
    }

}
