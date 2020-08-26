<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanProfileController extends Controller
{
    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;
    }

    public function profiles($idPlan)
    {
        $plan = $this->plan->find($idPlan);
        
        if (!$plan) {
            return redirect()->back();
        }

        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles'));
    }

    public function profilesAvailable(Request $request, $idPlan)
    {
        $plan = $this->plan->find($idPlan);
        
        if (!$plan) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $profiles = $plan->profilesAvailable($request->filter);

        return view('admin.pages.plans.profiles.available', compact('plan', 'profiles', 'filters'));
    }

    public function attachPlanProfile(Request $request, $idPlan)
    {
        $plan = $this->plan->find($idPlan);
        
        if (!$plan) {
            return redirect()->back();
        }

        if(!$request->profiles || count($request->profiles) == 0) {
            return redirect()
                    ->back()
                    ->with('error', 'Precisa escolher pelo menos uma permissão');
        }
        
        $plan->profiles()->attach($request->profiles);

        return redirect()->route('plans.profiles', $plan->id);
    }

    public function detachPlanProfile($id, $idProfile)
    {
        $plan = $this->plan->find($id);
        $profile = $this->profile->find($idProfile);

        if(!$plan || !$profile) {
            return redirect()
                    ->back()
                    ->with('error', 'Precisa escolher pelo menos uma permissão');
        }
        
        $plan->profiles()->detach($profile);

        return redirect()->route('plans.profiles', $plan->id);
    }

    public function plans($idProfiles)
    {
        $profile = $this->profile->find($idProfiles);
        
        if (!$profile) {
            return redirect()->back();
        }

        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.plans', compact('profile', 'plans'));
    }
}
