<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Models\TrackingLog;
use App\Models\Url;
use App\Repositories\UrlRepository;
use Illuminate\Http\Request;
use Throwable;

class UrlController extends Controller
{
    /**
     * UrlController constructor.
     *
     * @param  \App\Repositories\Interfaces\UrlRepository $urlRepository
     */
    public function __construct(private UrlRepository $urlRepository)
    {
        $this->authorizeResource(Url::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.urls.index', [
            'pageName' => __('urls.pages.index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.urls.create', [
            'pageName' => __('urls.pages.create')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUrlRequest $request)
    {
        try {
            $this->urlRepository->create($request->validated());

            flashSuccess(__('urls.responses.create.success'));

            return redirect()->route('urls.index');
        } catch (Throwable $th) {
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Url $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        $logs = TrackingLog::where('url_id', $url->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('app.urls.show', [
            'url' => $url,
            'logs' => $logs,
            'pageName' => __('urls.pages.show')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param TrackingLog $log
     * @return \Illuminate\Http\Response
     */
    public function showBody(TrackingLog $log)
    {
        $this->authorize('view', $log);

        return view('app.urls.show_body', [
            'log' => $log,
            'pageName' => __('urls.pages.show_body')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
      * @param Url $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        try {
            $this->urlRepository->delete($url);

            flashSuccess(__('urls.responses.delete.success'));

            return redirect()->route('urls.index');
        } catch (Throwable $th) {
            return back()->withErrors($th->getMessage());
        }
    }
}
