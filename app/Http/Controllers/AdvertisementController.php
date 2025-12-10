<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementStoreRequest;
use App\Http\Requests\AdvertisementUpdateRequest;
use App\Models\Advertisement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvertisementController extends Controller
{
    public function index(Request $request)
    {
        $advertisements = Advertisement::all();

        return view("advertisement.index", [
            'advertisements' => $advertisements,
        ]);
    }

    public function create(Request $request)
    {
        return view('advertisement.create');
    }

    public function store(AdvertisementStoreRequest $request)
    {
        $advertisement = Advertisement::create($request->validated());

        $request->session()->flash('advertisement.id', $advertisement->id);

        return redirect()->route('advertisements.index');
    }

    public function show(Request $request, Advertisement $advertisement)
    {
        return view('advertisement.show', [
            'advertisement' => $advertisement,
        ]);
    }

    public function edit(Request $request, Advertisement $advertisement)
    {
        return view('advertisement.edit', [
            'advertisement' => $advertisement,
        ]);
    }

    public function update(AdvertisementUpdateRequest $request, Advertisement $advertisement)
    {
        $advertisement->update($request->validated());

        $request->session()->flash('advertisement.id', $advertisement->id);

        return redirect()->route('advertisements.index');
    }

    public function destroy(Request $request, Advertisement $advertisement)
    {
        $advertisement->delete();

        return redirect()->route('advertisements.index');
    }
}
