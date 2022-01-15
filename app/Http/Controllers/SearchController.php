<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\topic;
use App\Models\Categories;
use App\Models\User;

class SearchController extends Controller
{
    //
    public function Search(Request $request, $thing = null, $word = null, $sort = null, $cat = null){
        

        if($thing == 1)
        {
            $categories = Categories::All();
        
            if($cat < 1)
            {
                $total_results = topic::orderBy('created_at', 'desc')->where('title', $word)->orWhere('title', 'like', '%' . $word . '%')->count();
            }
            else
            {
                $total_results = topic::orderBy('created_at', 'desc')->where('cat_id', $cat)->where('title', 'like', '%' . $word . '%')->count();
            }
  
            $searchArr = ['thing' => (($thing >= 1) ? $thing : 1),
                          'word' => ($word ? $word : ''),
                          'sort' => (($sort >= 1) ? $sort : 4),
                          'cat' => (($cat >= 1) ? $cat : ''),
                          'count' => $total_results,
                          'cats' => $categories
                        ];
        
            if($cat >= 1)
            {

                if($sort == '1')
                {   
                    //ID Accending
                    $data = topic::orderBy('id', 'asc')->where('cat_id', $cat)->where('title', 'like', '%' . $word . '%')->paginate(sys_info('max_searchperpage'));
                }
                elseif($sort == '2')
                {   
                    //ID Decending
                    $data = topic::orderBy('id', 'desc')->where('cat_id', $cat)->where('title', 'like', '%' . $word . '%')->paginate(sys_info('max_searchperpage'));
                }
                elseif($sort == '3')
                {   
                    //Date Accending
                    $data = topic::orderBy('created_at', 'asc')->where('cat_id', $cat)->where('title', 'like', '%' . $word . '%')->paginate(sys_info('max_searchperpage'));
                }
                else
                {  
                    //Date Decending / Default
                    $data = topic::orderBy('created_at', 'desc')->where('cat_id', $cat)->where('title', 'like', '%' . $word . '%')->paginate(sys_info('max_searchperpage'));
                }
            }
            else
            {

                if($sort == '1')
                {   
                    //ID Accending
                    $data = topic::orderBy('id', 'asc')->where('title', 'like', '%' . $word . '%')->paginate(sys_info('max_searchperpage'));
                }
                elseif($sort == '2')
                {   
                    //ID Decending
                    $data = topic::orderBy('id', 'desc')->where('title', 'like', '%' . $word . '%')->paginate(sys_info('max_searchperpage'));
                }
                elseif($sort == '3')
                {   
                    //Date Accending
                    $data = topic::orderBy('created_at', 'asc')->where('title', 'like', '%' . $word . '%')->paginate(sys_info('max_searchperpage'));
                }
                else
                {  
                    //Date Decending / Default
                    $data = topic::orderBy('created_at', 'desc')->where('title', 'like', '%' . $word . '%')->paginate(sys_info('max_searchperpage'));
                }
            }
        
        }
        else
        {   
            
            //search users
            $total_results = User::orderBy('id', 'asc')->where('name', 'like', '%' . $word . '%')->count();

            $categories = [];

            $searchArr = ['thing' => 2,
                          'word' => ($word ? $word : ''),
                          'sort' => (($sort >= 1) ? $sort : 2),
                          'cat' => 0,
                          'count' => $total_results,
                          'cats' => $categories
                        ];
                           
            
            if($sort == '1')
            {   
                //ID Accending
                $data = topic::orderBy('id', 'asc')->where('title', 'like', '%' . $word . '%')->paginate(sys_info('maxt_main'));
            }
            else
            {   
                //ID Decending
                $data = User::orderBy('id', 'desc')->where('name', 'like', '%' . $word . '%')->paginate(20);
            }
           
        }
        return view('search', ['data' => $data, 'search' => $searchArr]);

    }

}
