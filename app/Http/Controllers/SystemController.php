<?php
namespace App\Http\Controllers;

use DB;
use App\Site;
use App\Test;
use App\User;
use App\Photo;
use App\System;
use App\Customer;
use App\Document;
use App\Component;
use Carbon\Carbon;
use App\SystemType;
use App\BranchOffice;
use Illuminate\Http\Request;
use App\Filters\SystemFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SystemController extends Controller
{
    public function index(SystemFilter $filters)
    {
        $customers = Customer::orderBy('name')->get();
        $systemTypes = SystemType::orderBy('type')->get();
        $panels = Component::orderBy('manufacturer_id')->where('component_category_id', 1)->with('manufacturer')->get();
        $branchOffices = BranchOffice::orderBy('name')->get();
        $systems = $this->getSystems($filters)
            // ->with('latestTest')
            ->get();
        return view('systems.index', compact('systems', 'customers', 'systemTypes', 'panels', 'branchOffices'));
    }

    public function show(System $system)
    {
        $now = Carbon::now()->setTimezone('America/Los_Angeles')->format('Y-m-d');
        $testTypes = DB::table('test_types')->orderBy('name')->get();
        $testResults = DB::table('test_results')->orderBy('name')->get();
        $technicians = User::isServiceTechnician()->orderBy('last_name')->get();
        $manufacturers = DB::table('manufacturers')->orderBy('name', 'asc')->get();
        $systemTypes = DB::table('system_types')->orderBy('type')->get();
        $photos = Photo::orderBy('created_at', 'desc')->where('photoable_id', '=', $system->id)->get();
        $documents = Document::orderBy('file_name', 'desc')
            ->where('documentable_id', $system->id)
            ->where('documentable_type', 'App\System')
            ->get();

        return view(
            'systems.show',
            compact(
                'now',
                'system',
                'testTypes',
                'testResults',
                'technicians',
                'manufacturers',
                'systemTypes',
                'photos',
                'documents'
            )
        );
    }

    public function store(Request $request, Site $site)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'system_type_id' => 'required',
        ]);

        $system = new System;
        $system->site_id = $site->id;
        $system->name = $request->name;
        $system->slug = str_slug($system->name, '-');
        $system->system_type_id = $request->system_type_id;
        $system->install_date = $request->install_date;
        $system->is_active = $request->is_active ?: 0;
        $system->ssi_test_acct = $request->ssi_test_acct ?: 0;
        $system->ssi_install = $request->ssi_install ?: 0;
        $system->notes = $request->notes;
        $system->added_by = Auth::id();

        $system->save();

        flash('Success!', 'System created.');

        return redirect($system->path());
    }

    public function update(Request $request, System $system)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'system_type_id' => 'required',
        ]);

        $system->name = $request->name;
        $system->slug = str_slug($system->name, '-');
        $system->system_type_id = $request->system_type_id;
        $system->install_date = $request->install_date;
        $system->is_active = $request->is_active ?: 0;
        $system->ssi_test_acct = $request->ssi_test_acct ?: 0;
        $system->ssi_install = $request->ssi_install ?: 0;
        $system->notes = $request->notes;
        $system->updated_by = Auth::id();

        $system->update();
        flash('Success!', 'System updated.', 'Success');
        return redirect($system->path());
    }

    public function updateNextTestDate(Request $request, System $system)
    {
        $system->next_test_date = $request->next_test_date;
        $system->save();
        flash('Success!', 'Next test date updated.', 'success');
        return redirect($system->path());
    }

    public function nullifyNextTestDate(System $system)
    {
        $system->next_test_date = null;
        $system->save();
        flash('Success!', 'Next test date removed.', 'success');
        return redirect($system->path());
    }

    public function destroy(System $system)
    {
        if (count($system->tests) > 0) {
            flash('Nope!', 'Cannot delete system, it has one or more tests', 'warning');
            return redirect($system->path());
        }

        $site = Site::find($system->site_id);
        $system->components()->detach();
        $system->delete();
        flash('Success!', 'System deleted.', 'danger');
        return redirect($site->path());
    }
    
    public function getSystems($filters)
    {
        return System::filter($filters);
    }
}
