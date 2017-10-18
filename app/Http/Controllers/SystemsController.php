<?php
namespace App\Http\Controllers;

use DB;
use App\Site;
use App\Test;
use App\Photo;
use App\System;
use App\Document;
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

    public function index(Request $request)
    {
        $systems = System::isTestedBySSI()
            ->orderBy('next_test_date')
            ->paginate(25);

        return view('systems.index', compact('systems'));
    }

    public function show(System $system)
    {
        $now = Carbon::now()->setTimezone('America/Los_Angeles')->format('Y-m-d');
        $testTypes = DB::table('test_types')->orderBy('name')->get();
        $testResults = DB::table('test_results')->orderBy('name')->get();
        $technicians = DB::table('users')->orderBy('first_name')->get();
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
            'ssi_install' => 'required',
            'ssi_test_acct' => 'required',
            ]);

        $system = new System;
        $system->site_id = $site->id;
        $system->name = $request->name;
        $system->slug = str_slug($system->name, '-');
        $system->system_type_id = $request->system_type_id;
        $system->install_date = $request->install_date;
        $system->ssi_install = $request->ssi_install;
        $system->ssi_test_acct = $request->ssi_test_acct;
        $system->notes = $request->notes;
        $system->added_by = Auth::id();

        $system->save();

        flash('Success!', 'System created.');

        return redirect($system->path());
    }

    public function update(Request $request, System $system)
    {
        $user = Auth::user();
        if ($user->can('update', $system)) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'system_type_id' => 'required',
                'ssi_install' => 'required',
                'ssi_test_acct' => 'required',
                ]);

            $system->name = $request->name;
            $system->slug = str_slug($system->name, '-');
            $system->system_type_id = $request->system_type_id;
            $system->install_date = $request->install_date;
            $system->ssi_install = $request->ssi_install;
            $system->ssi_test_acct = $request->ssi_test_acct;
            $system->notes = $request->notes;
            $system->updated_by = Auth::id();

            $system->update();
            flash('Success!', 'System updated.', 'Success');
            return redirect($system->path());
        }
        flash('Access Denied.', "You're not authorized to edit systems", 'danger');
        return back();
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
        $user = Auth::user();
        if ($user->can('delete', $system)) {
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
        flash('Access Denied.', "You're not authorized to delete systems", 'danger');
        return back();
    }
}
