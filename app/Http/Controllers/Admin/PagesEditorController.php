<?php

namespace App\Http\Controllers\Admin;
use App\Model\Admin\AdminSettings;
use App\Model\Faq;
use App\Model\HomePage;
use App\Model\SitePage;
use App\Model\Inquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Model\Admin\WebsiteContents;


class PagesEditorController extends Controller
{
    //

    public function index()
    {
      
        //static pages
        $pages= \DataGrid::source(new SitePage);  //same source types of DataSet
        $pages->link('/editor/home/new',"New static page", "TR");

        $pages->add('title','Page Title', true);
        $pages->add('created_at','Created At', true);
        $pages->add('updated_at','Updated At', true);


        $pages->add('<a class="text-right" href="editor/edit/{{ $id }}">Edit Page</a>','Edit');



        //homepage
        $home= \DataGrid::source(new HomePage());  //same source types of DataSet
        $home->link('/editor/home/new',"New Section", "TR");
        $home->add('title','Page Title', true);
        $home->add('created_at','Created At', true);
        $home->add('updated_at','Updated At', true);


        // $pages->add('<a class="text-right" href="http://3.20.72.9/funding_joint/public/editor/home/edit/{{ $id }}">Edit Home Section</a>','Edit');





        //faqs
        $faqs= \DataGrid::source(new Faq());  //same source types of DataSet
        $faqs->link('/editor/faq/new',"New Faq", "TR");

        $faqs->add('title','Page Title', true);
        $faqs->add('created_at','Created At', true);
        $faqs->add('updated_at','Updated At', true);


        $faqs->add('<a class="text-right btn btn-primary btn-sm" href="{{route("faqs.edit_id",$id)}}">Edit</a>','Edit');
       // $faqs->add('<a class="text-right btn btn-primary btn-sm" href="/editor/faq/edit/{{ $id }}">Edit</a>','Edit');
        $faqs->add('<a class="text-right btn btn-darkred text-white btn-sm" href="{{route("faqs.delete",$id)}}">Delete</a>','Delete');


        return view('admin.pages.index', compact('pages', 'faqs', 'home'));
    }

    /**
     * @method edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $edit = \DataEdit::source(SitePage::find($id));

        $edit->link("editor","Back to pages", "TR")->back();
        $edit->add('title','Title', 'text')->rule('required|min:5');
        $edit->add('content','Content', 'redactor');

        return view('admin.pages.edit', compact('edit'));
    }
    /**
     * @method editFaqs
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editFaq($id)
    {
        $edit = \DataEdit::source(Faq::find($id));

        $edit->link("editor","Back", "TR")->back();

        $edit->add('title','Title', 'text')->rule('required|min:1');

        $edit->add('content','Content', 'redactor')->rule('required|min:1');

        return view('admin.pages.edit', compact('edit'));
    }



    /**
     * @method editFaqs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newFaq()
    {
        $edit = \DataEdit::source(new Faq());

        $edit->link("editor","Back", "TR")->back();

        $edit->add('title','Title', 'text')->rule('required|min:1');

        $edit->add('content','Content', 'redactor')->rule('required');

        return view('admin.pages.edit', compact('edit'));
    }


    /**
     * @method editFaqs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newHomeSection()
    {
        $edit = \DataEdit::source(new HomePage());

        $edit->link("editor","Back", "TR")->back();

        $edit->add('title','Title', 'text')->rule('required|min:5');

        $edit->add('content','Content', 'redactor')->rule('required');

        return view('admin.pages.edit', compact('edit'));
    }


    /**
     * @method deleteFaq
     * @description Deletes the faq from the database
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteFaq($id)
    {
        if(Faq::destroy($id)){

            return redirect()->back()->with('msg', 'Deleted');

        }
    }


    public function getAuthPages(){
        return view('admin.pages.auth');
    }

    public function postAuthPages(Request $request){

        $this->validate($request, [
            'login_image' => 'mimes:png|max:4096',
            'register_image' => 'mimes:png|max:4096',
        ],
            $messages = [
                'required' => 'The :attribute field is required.',
                'mimes' => 'Only png are allowed.'
            ]
        );

        if($request->file('login_image')){
            $imageName = 'login_image.'.$request->file('login_image')->getClientOriginalExtension();
            Storage::disk('public_uploads')->put($imageName, file_get_contents($request->file('login_image')));
        }
        if($request->register_image){
            $imageName = 'register_image.'.$request->register_image->getClientOriginalExtension();
            Storage::disk('public_uploads')->put($imageName, file_get_contents($request->file('register_image')));
        }

        return view('admin.pages.auth');
    }

    function loadPageBySlug($slug){

        $page = SitePage::where('slug',$slug)->first();

        if($page==null){
            abort(404);
        }

        $page = $page->toArray();
        return view('homepage.site_pages',compact('page'));


    }

    public function websitecontent()
    {
        //$user = WebsiteContents::all();

        $pages= \DataGrid::source(new WebsiteContents);  //same source types of DataSet
        
        $pages->add('title','Title', true);
        $pages->add('created_at','Created At', true);
        $pages->add('updated_at','Updated At', true);

        $p='<a class="text-right" href="websitecontent/edit/{{ $id }}">Edit</a>';
       $pages->add($p,'Edit');
        // $pages->add('<a class="text-right" href="http://3.20.72.9/funding_joint/public/websitecontent/edit/{{ $id }}">Edit</a>','Edit');
        // print_r($pages);
        // exit;
        return view('admin.pages.website_content', compact('pages'));
            
    }

    public function inquiry()
    {
        //$user = WebsiteContents::all();

        $pages= \DataGrid::source(new Inquiry);  //same source types of DataSet
        
        $pages->add('name','Name', true);
        $pages->add('email','Email', true);
        $pages->add('type','Type', true);
        $pages->add('created_at','Created At', true);
        $pages->add('updated_at','Updated At', true);


        //$pages->add('<a class="text-right" href="http://3.20.72.9/funding_joint/public/websitecontent/edit/{{ $id }}">Edit</a>','Edit');
        // print_r($pages);
        // exit;
        return view('admin.pages.website_content', compact('pages'));
            
    }

    public function editwebsitecontent($id)
    {
        $edit = WebsiteContents::find($id);

        return view('admin.pages.website_content_edit', compact('edit','id'));
    }

    public function updatewebsitecontent(Request $request,$id)
    {
        
        $update_data = array();
        $image = $request->file;
        if(!empty($image)){
            $destinationPath = 'assets/img';
            $extension = $image->getClientOriginalExtension();
            $filename = time().rand(5, 15).'.'.$extension;
            $image->move($destinationPath, $filename); 
            $update_data['content'] = $filename;
        }else{
            $update_data['content'] = $request->content;
        }

        $update = WebsiteContents::where('id',$id)->update($update_data);
        return redirect()->route('websitecontent')->with('success', 'Details updated successfully.');
    }
}
