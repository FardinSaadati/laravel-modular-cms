<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    protected  $redirectPath = 'administrator/pages/list';

    // -------------------------------------------------------------------------------
    public function index()
    {
        $pages = Page::orderBy('created_at')->paginate(20);
        return view('admin.pages.list' , compact('pages'))->with('title' , 'Pages List');
    }
    // -------------------------------------------------------------------------------
    public function add()
    {
        return view('admin.pages.add')->with('title' , 'Page Create');
    }
    // -------------------------------------------------------------------------------
    public function create(Request $request)
    {
        $this->validator($request->all())->validate();

        $request->merge(array('is_publish' , 'y'));
        $data = $request->except(['_token']);

        $request->user('web_admin')->pages()->create($data);
//      Page::create($data);

        $request->session()->flash('Success', trans('notify.CREATE_SUCCESS_NOTIFICATION'));
        return redirect($this->redirectPath);
    }
    // -------------------------------------------------------------------------------
    public function edit(Page $page)
    {
        return view('admin.pages.edit' , compact('page'))->with('title' , 'Edit: '.$page->title);
    }
    // -------------------------------------------------------------------------------
    public function update(Request $request , Page $page)
    {
        $this->validatorUpdate($request->all() , $page)->validate();
        $data = $request->except(['_token']);

        $page->update($data);

        $request->session()->flash('Success', trans('notify.UPDATE_SUCCESS_NOTIFICATION'));
        return redirect($this->redirectPath);
    }
    // -------------------------------------------------------------------------------
    protected function delete(Page $page , Request $request){
        $page->delete();
        $request->session()->flash('success', trans('notify.DELETE_SUCCESS_NOTIFICATION'));
        return redirect($this->redirectPath);
    }
    // -------------------------------------------------------------------------------
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title'  => 'required|max:100|unique:pages,title',
            'slug'   => 'required|max:100|unique:pages,slug',
            'body'   => 'required|min:3',
            'p_body' => 'required|min:3'
        ]);
    }
    // -------------------------------------------------------------------------------
    protected function validatorUpdate(array $data , $page)
    {
        return Validator::make($data, [
            'title'  => 'required|max:100',
            'slug'   => 'required|max:100|unique:pages,slug,'.$page->id,
            'body'   => 'required|min:3',
            'p_body' => 'required|min:3',
            'image'  => 'image|mimes:jpeg,png,jpg|max:1024'

        ]);
    }
    // -------------------------------------------------------------------------------
    protected function PageImageDelete(Page $page){
        $this->imageDelete($page->img , $this->destinationPathOfNews);
        $page->update(array('img' => null));
        return redirect()->back();
    }
    // -------------------------------------------------------------------------------

}
