<?php

namespace App\Http\Controllers;


require_once(dirname(__FILE__).'/simple_html_dom.php');


class LicenceGenerator extends Controller
{
    /**
     * Serve Open Source Licences from https://choosealicense.org
     *
     * @param  int  $id
     * @return Response
     */
    
    protected $licenses = [];
        
    public function list_all($use=1)
    {
        
        $html = file_get_html('https://choosealicense.com/licenses/');


        foreach ($html->find('.license-overview .license-overview-heading .license-overview-name a') as $element){
            $this->licenses [$element->innertext] = 'https://choosealicense.com/'.$element->href; 
        }
        if($use){
            $count=1;
            echo '<h1>List of Open Source Licences<br></h1>';
            foreach ($this->licenses as $key => $value) {
                echo '<a href="'.$count.'" >'.$key.'</a><br>';
                $count+=1;
            }
        }
    }
    
    public function show_licence($id)
    {
        $this->list_all(0);
        if($id <= sizeof($this->licenses)){
            $keys = array_keys($this->licenses);
            $link = $this->licenses[$keys[$id]];
            $html = file_get_html($link,$stripRN=false);
            $e = $html->find('pre',0);
            echo $e->outertext;
        }
        else{
            abort(404);
        }
    }
}