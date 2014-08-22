<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Creativetable{

    var $sql_query;             // SQL query for all the data
    var $table_key;             // primary key of the table (must be an integer)
    var $data;                  // data to build the table (data gathering)
    var $search;                // search selected (data gathering)
    var $multiple_search;       // multi search selected (data gathering)
    var $items_per_page;        // items per page selected (data gathering)
    var $sort;                  // selected column 1a_2d_t_t (data gathering)
    var $page;                  // selected page (for the sql query)
    var $total_items;           // total items (got from sql query or the 2D array)

    var $id;                    // id of the table
    var $class;                 // class of the table
    var $form_init;             // true, false show or not to show the form
    var $form_url;              // form url
    var $header;                // text for the header i.e. 'ID,Movie Title,Any Text,...'
    var $width;                 // ''; '15,100,200,50'
    var $search_init;           // false, true, ttftt
    var $search_html;           // html with search configuration
    var $multiple_search_init;  // hide, true, false, ttftt, ttftt hide
    var $items_per_page_init;   // false; 10,20,50,100; ($i+1)*10
    var $items_per_page_all;    // text for the show all option: All; false; #TOTAL_ITEMS#
    var $items_per_page_url;    // index.php or javascript: myFunc();
    var $sort_init;             // true, false ttftt
    var $sort_order;            // 'adt';'ad';'da';'dat'; (ascending, descending, true)
    var $sort_url;              // index.php or javascript: myFunc();
    var $extra_cols;            // array containing the the information about extra columns array(array(col,header,width,html),array(...),...)
    var $odd_even;              // true, false
    var $no_results;            // false; html for the no results
    var $actions;               // array containing the value and the text of the select box array(array($value,$text),...)
    var $actions_url;           // text function when the select box of actions is changed
    var $pager;                 // external html pager
    var $pager_ids;             // pager ids (if more than one pager for the same table)
    var $ajax_url;              // url to call then ajax event occurs
    var $display_cols;          // ttftt (display columns 1,2,4,5

    var $sql_fields;            // sql fields (got from sql query)
    var $out;                   // output of the table

    function table($params){
        global $tpl;

        // Default Values
        $this->sql_query            = isset($params['sql_query']) ? $params['sql_query'] : '';
        $this->table_key            = isset($params['table_key']) ? $params['table_key'] : '';
        $this->data                 = isset($params['data']) ? $params['data'] : '';
        $this->search               = isset($params['search']) ? $params['search'] : '';
        $this->multiple_search      = isset($params['multiple_search']) ? $params['multiple_search'] : '';
        $this->items_per_page       = isset($params['items_per_page']) ? $params['items_per_page'] : '';
        $this->sort                 = isset($params['sort']) ? $params['sort'] : false;
        $this->page                 = isset($params['page']) ? $params['page'] : 1;
        $this->total_items          = isset($params['total_items']) ? ($params['total_items']>=0 ? $params['total_items'] : '') : '';

        $this->id                   = isset($params['id']) ? $params['id'] : 'ct';
        $this->class                = isset($params['class']) ? $params['class'] : '';
        $this->form_init            = isset($params['form_init']) ? $params['form_init'] : true;
        $this->form_url             = isset($params['form_url']) ? $params['form_url'] : '';
        $this->header               = isset($params['header']) ? $params['header'] : false;
        $this->width                = isset($params['width']) ? $params['width'] : '';
        $this->search_init          = isset($params['search_init']) ? $params['search_init'] : true;
        $this->search_html          = isset($params['search_html']) ? $params['search_html'] : '<span id="#ID#_search_value">Search...</span><a id="#ID#_advanced_search" href="javascript: ctShowAdvancedSearch(\'#ID#\');" title="Advanced Search"><img src="images/advanced_search.png" /></a><div id="#ID#_loader"></div>';
        $this->multiple_search_init = isset($params['multiple_search_init']) ? $params['multiple_search_init'] : 'hide';
        $this->items_per_page_init  = isset($params['items_per_page_init']) ? $params['items_per_page_init'] : '10*$i';
        $this->items_per_page_all   = isset($params['items_per_page_all']) ? (($params['items_per_page_all']!='' or $params['items_per_page_all']===false) ? $params['items_per_page_all'] : '#TOTAL_ITEMS#') : '#TOTAL_ITEMS#';
        $this->items_per_page_url   = isset($params['items_per_page_url']) ? $params['items_per_page_url'] : 'ctItemsPerPage(\'#ID#\')';
        $this->sort_init            = isset($params['sort_init']) ? $params['sort_init'] : true;
        $this->sort_order           = isset($params['sort_order']) ? $params['sort_order'] : 'adt';
        $this->sort_url             = isset($params['sort_url']) ? $params['sort_url'] : 'ctSort(\'#ID#\',\'#COLUMN_ID#\')';
        $this->extra_cols           = isset($params['extra_cols']) ? $params['extra_cols'] : array();
        $this->odd_even             = isset($params['odd_even']) ? $params['odd_even'] : true;
        $this->no_results           = isset($params['no_results']) ? $params['no_results'] : 'No results found.';
        $this->actions              = isset($params['actions']) ? $params['actions'] : array();
        $this->actions_url          = isset($params['actions_url']) ? $params['actions_url'] : 'ctActions(\'#ID#\')';
        $this->pager                = isset($params['pager']) ? $params['pager'] : '';
        $this->pager_ids            = isset($params['pager_ids']) ? $params['pager_ids'] : '';
        $this->ajax_url             = isset($params['ajax_url']) ? $params['ajax_url'] : $_SERVER['PHP_SELF'];
        $this->display_cols         = isset($params['display_cols']) ? $params['display_cols'] : '';

        $this->sql_fields           = '';
        $this->out                  = '';

        $this->init_data();

        if($this->sql_query!='')
            $this->init_data_sql();
        else
            $this->init_data_array();

    }

    // Makes somes necessary initializations
    function init_data(){

        // default value of items per page
        if($this->items_per_page==''){
            // formula $i*10; pow(10,$i)
            if(strpos($this->items_per_page_init,'$')!==false){
                $i=1;
                eval('$items_per_page='.$this->items_per_page_init.';');
            }else{
                $items_per_page=explode(',',$this->items_per_page_init);
                $items_per_page=$items_per_page[0];
            }

            $this->items_per_page=$items_per_page;
        }

    }

    // Gets the data from the database and makes somes necessary initializations
    function init_data_sql(){

        // adds the new extra columns to the data
        for($i=0; $i<count($this->extra_cols); $i++)
            $this->add_col($this->extra_cols[$i][0],$this->extra_cols[$i][1],$this->extra_cols[$i][2],$this->extra_cols[$i][3],'init');

        $bd_fields=substr($this->sql_query,7,stripos($this->sql_query,' FROM ')-7);
        $this->sql_fields=explode(',',$bd_fields);

        $multiple_search_empty=1;
        for($i=0; $i<count($this->multiple_search); $i++){
            if(!empty($this->multiple_search[$i]))
                $multiple_search_empty=0;
        }

        $sort_empty=1;
        if(strpos($this->sort,'a'))
            $sort_empty=0;
        if(strpos($this->sort,'d'))
            $sort_empty=0;

        // gets the data from the DB
        if($this->table_key!='' and $this->search=='' and $multiple_search_empty==1 and $sort_empty==1)
            $result = mysql_query($this->get_sql(true));
        else
            $result = mysql_query($this->get_sql());

        if($result) {

            while ($row = mysql_fetch_array($result, MYSQL_NUM))
                $this->data[]=$row;

            mysql_free_result($result);

        }

        // total of items
        if($this->total_items<=0){
            if($this->table_key)
                $result=mysql_query(str_replace($bd_fields,'count('.$this->table_key.')',$this->get_sql_select()).$this->get_sql_where(false));
            else
                $result=mysql_query(str_replace($bd_fields,'count('.$this->sql_fields[0].')',$this->get_sql_select()).$this->get_sql_where(false));
            $this->total_items=mysql_fetch_row($result);
            $this->total_items=$this->total_items[0];

            mysql_free_result($result);
        }

        // adds the new extra columns to the data
        for($i=0; $i<count($this->extra_cols); $i++)
            $this->add_col($this->extra_cols[$i][0],$this->extra_cols[$i][1],$this->extra_cols[$i][2],$this->extra_cols[$i][3],'data');

    }

    // Gets the data from an array and makes somes necessary initializations
    function init_data_array(){

        // where
        $removed_row=0;
        $total_multiple_search=0;

        foreach ($this->data as $key => $row) {

            $flag_found=0;
            $flag_found_part=0;

            for($i=0; $i<count($row); $i++){

                if($this->search!='' and $this->search_init[$i]!='f' and stripos($row[$i],$this->search)!==false)
                    $flag_found=1;

                if(empty($this->multiple_search[$i]))
                    $this->multiple_search[$i]='';
                else
                    if($key==0)
                        $total_multiple_search++;

                if(count($this->multiple_search)>0 and $this->multiple_search[$i]!='' and $this->multiple_search_init[$i]!='f' and stripos($row[$i],$this->multiple_search[$i])!==false)
                    $flag_found_part++;

                if($i==(count($row)-1)){
                    if($flag_found_part==$total_multiple_search and $total_multiple_search>0){
                        if(($this->search!='' and $this->search_init[$i]!='f' and $flag_found==1) or $this->search=='')
                            $flag_found=1;
                    }else{
                        if($flag_found==1 and $total_multiple_search>0)
                            $flag_found=0;
                    }
                }

            }

            if(($this->search!='' or $total_multiple_search>0) and !$flag_found){
                array_splice($this->data, $key-$removed_row, 1);
                $removed_row++;
            }

        }

        $this->total_items=count($this->data);

        // sort
        $arr_sort=explode('_',$this->sort);
        asort($arr_sort);

        foreach($arr_sort as $key => $value){
            if(substr($arr_sort[$key],-1)=='a')
                $order_str.='$arr_field'.$key.', SORT_ASC, ';

            if(substr($arr_sort[$key],-1)=='d')
                $order_str.='$arr_field'.$key.', SORT_DESC, ';
        }

        foreach ($this->data as $key => $row) {
            for($i=0; $i<count($row); $i++)
                ${'arr_field'.$i}[]=$row[$i];
        }

        eval('array_multisort('.$order_str.' $this->data);');

        // items per page
        if($this->items_per_page!='all' and $this->items_per_page!='')
            $this->data=array_splice($this->data, ($this->page-1)*$this->items_per_page, 10);

    }

    // Adds a new row i.e. $ct->add_row(array(69,69,'ola',69),3);
    function add_row($arr_html,$row){
        array_splice($this->data, $row-1, 0, array($arr_html));
    }

    // Adds a new column i.e. $ct->add_col(1,'Check','<input type="checkbox" name="check" />','50');
    function add_col($col,$header,$width,$html,$op='init_data'){

        if($op=='init_data')
            $this->extra_cols[]=array($col,$header,$width,$html);

        if(strpos($op,'init')!==false){

            // adds the new header
            $arr_header=explode(',',$this->header);

            if($col>count($arr_header)+1)
                $col=count($arr_header)+1;

            array_splice($arr_header, $col-1, 0, $header);
            $this->header=implode(',',$arr_header);

            // adds the new column width
            $arr_width=explode(',',$this->width);
            array_splice($arr_width, $col-1, 0, $width);
            $this->width=implode(',',$arr_width);

            // rearrange the sort string
            if($this->sort_init===true){
                $this->sort_init=str_repeat('t',count($arr_header));
                $this->sort_init[$col-1]='f';
            }else if($this->sort_init!==true and $this->sort_init!==false){
                $this->sort_init=substr_replace($this->sort_init,'f',$col-1,0);
            }

            // rearrange the search_init string
            if($this->search_init===true){
                $this->search_init=str_repeat('t',count($arr_header));
                $this->search_init[$col-1]='f';
            }elseif($this->search_init!==true and $this->search_init!==false){
                $this->search_init=substr_replace($this->search_init,'f',$col-1,0);
            }

            // rearrange the multiple_search_init string
            if($this->multiple_search_init===true){
                $this->multiple_search_init=str_repeat('t',count($arr_header));
                $this->multiple_search_init[$col-1]='f';
            }else if($this->multiple_search_init=='hide'){
                $this->multiple_search_init=str_repeat('t',count($arr_header));
                $this->multiple_search_init[$col-1]='f';
                $this->multiple_search_init.='hide';
            }else if($this->multiple_search_init!==true and $this->multiple_search_init!==false){
                $this->multiple_search_init=substr_replace($this->multiple_search_init,'f',$col-1,0);
            }

        }

        if(strpos($op,'data')!==false){
            // add the new column in all rows
            if($this->total_items>0){
                for($i=0; $i<count($this->data); $i++)
                    array_splice($this->data[$i], $col-1, 0, array($html));
            }
        }

    }

    // Rearrange the sort string
    function init_sort(){
        $out='';
        if($this->sort===true or $this->sort==''){
            for($i=0; $i<count($this->data[0]); $i++)
                $out.=($out ? '_' : '').'t';
            $this->sort=$out;
        }
    }

    // Gets final composed sql query
    function get_sql($check_table_key=false){
        $sql='';
        if($check_table_key)
            $sql=$this->get_sql_select().$this->get_sql_where(true).$this->get_sql_order();
        else
            $sql=$this->get_sql_select().$this->get_sql_where(false).$this->get_sql_order().$this->get_sql_limit();

        return $sql;
    }

    // Gets the sql query corresponding to selecting fields and tables parameters
    function get_sql_select(){
        if(stripos($this->sql_query,' WHERE ')!==false)
            $select_str=substr($this->sql_query,0,stripos($this->sql_query,' WHERE '));
        elseif(stripos($this->sql_query,' WHERE ')===false and stripos($this->sql_query,' ORDER BY ')!==false)
            $select_str=substr($this->sql_query,0,stripos($this->sql_query,' ORDER BY '));
        else
            $select_str=$this->sql_query;

        return $select_str;
    }

    // Gets the sql query corresponding to conditions parameters
    function get_sql_where($check_table_key=true){
        $where_str='';
        $multiple_search_str='';

        if(stripos($this->sql_query,' WHERE ')!==false){
            if(stripos($this->sql_query,' ORDER BY ')!==false)
                $where_str_ini='('.substr($this->sql_query,stripos($this->sql_query,' WHERE ')+7,stripos($this->sql_query,' ORDER BY ')-stripos($this->sql_query,' WHERE ')-7).')';
            elseif(stripos($this->sql_query,' LIMIT ')!==false)
                $where_str_ini='('.substr($this->sql_query,stripos($this->sql_query,' WHERE ')+7,stripos($this->sql_query,' LIMIT ')-stripos($this->sql_query,' WHERE ')-7).')';
            else
                $where_str_ini='('.substr($this->sql_query,stripos($this->sql_query,' WHERE ')+7).')';
        }else{
            $where_str_ini='';
        }

        // adds the extra columns in consideration
        $arr_sql_fields=$this->sql_fields;
        for($i=0; $i<count($this->extra_cols); $i++)
            array_splice($arr_sql_fields, $this->extra_cols[$i][0]-1, 0, '');

        for($i=0; $i<count($arr_sql_fields); $i++){
            if(empty($this->multiple_search[$i]))
                $this->multiple_search[$i]='';

            if($this->search!='' and $this->search_init[$i]!='f')
                $where_str.=($where_str ? ' OR ' : '(').$arr_sql_fields[$i]." LIKE '%".$this->search."%'";

            if(count($this->multiple_search)>0 and $this->multiple_search[$i]!='' and $this->multiple_search_init[$i]!='f')
                $multiple_search_str.=(($where_str_ini or $where_str or $multiple_search_str) ? ' AND ' : '').$arr_sql_fields[$i]." LIKE '%".$this->multiple_search[$i]."%'";
        }

        if($where_str!='')
            $where_str.=')';

        if($this->table_key!='' and $check_table_key)
            $where_str.=($where_str ? ' AND ' : '').$this->table_key.">'".(($this->page-1)*$this->items_per_page)."' AND ".$this->table_key."<='".(($this->page-1)*$this->items_per_page+$this->items_per_page)."'";

        return  (($where_str_ini or $where_str or $multiple_search_str) ? ' WHERE ' : '').$where_str_ini.(($where_str_ini and $where_str) ? ' AND ' : '').$where_str.$multiple_search_str;
    }

    // Gets the sql query corresponding to order parameters
    function get_sql_order(){

        if(stripos($this->sql_query,' ORDER BY ')!==false){
            if(stripos($this->sql_query,' LIMIT ')!==false)
                $order_str_ini=substr($this->sql_query,stripos($this->sql_query,' ORDER BY '),stripos($this->sql_query,' LIMIT ')-stripos($this->sql_query,' ORDER BY '));
            else
                $order_str_ini=substr($this->sql_query,stripos($this->sql_query,' ORDER BY '));
        }else{
            $order_str_ini='';
        }

        $order_str='';
        $arr_new_cols=array();

        // adds the extra columns in consideration
        $arr_sql_fields=$this->sql_fields;
        for($i=0; $i<count($this->extra_cols); $i++){
            array_splice($arr_sql_fields, $this->extra_cols[$i][0]-1, 0, '');
            $arr_new_cols[]=$this->extra_cols[$i][0];
        }

        $arr_sort=explode('_',$this->sort);
        asort($arr_sort);

        foreach($arr_sort as $key => $value){
            if(!in_array($key+1,$arr_new_cols)){
                if(substr($arr_sort[$key],-1)=='a')
                    $order_str.=(($order_str_ini or $order_str) ? ', ' : ' ORDER BY ').$arr_sql_fields[$key].' ASC';

                if(substr($arr_sort[$key],-1)=='d')
                    $order_str.=(($order_str_ini or $order_str) ? ', ' : ' ORDER BY ').$arr_sql_fields[$key].' DESC';
            }
        }

        return $order_str_ini.$order_str;
    }

    // Gets the sql query corresponding to limit parameters
    function get_sql_limit(){
        $limit_str='';

        if($this->items_per_page!='all' and $this->items_per_page!='')
            $limit_str=' LIMIT '.($this->page-1)*$this->items_per_page.','.$this->items_per_page;

        return $limit_str;
    }

    // Analises the url passed, if it has the tag #COLUMN_ID# it substitues for the true value of the page,
    // otherwise puts ?pag=1 or &pag=1 in the end of url
    function get_url($column){
        if(strpos($this->sort_url,'#COLUMN_ID#')!==false)
            return str_replace('#COLUMN_ID#',$column,$this->sort_url);
        else
            return $this->sort_url.(strpos($this->sort_url,'?')!==false ? '&' : '?').'sort='.$this->sort;
    }

    // Change some specific tags to their corresponding value
    function change_tags($str){
        $str=str_replace('#ID#',$this->id,$str);
        $str=str_replace('#PAGE#',$this->page,$str);
        $str=str_replace('#ITEMS_PER_PAGE#',$this->items_per_page,$str);
        $str=str_replace('#TOTAL_ITEMS#',$this->total_items,$str);

        return $str;
    }

    // Change the column tags for their value #COL1#, #COL2#, ...
    function change_tag_col($str,$arr_cols){
        preg_match_all('/#COL(\d+)#/i', $str, $matches, PREG_SET_ORDER);

        for($i=0; $i<count($matches); $i++)
            $str=str_replace($matches[$i][0], addslashes($arr_cols[$matches[$i][1]-1]), $str);

        return $str;
    }

    // Draw the form
    function draw_form(){
        $out='';

        if($this->form_init)
            $out='<form id="'.$this->id.'_form" name="'.$this->id.'_form" method="get" action="'.$this->form_url.'">
            <input type="hidden" id="'.$this->id.'_items_per_page" name="'.$this->id.'_items_per_page" value="'.$this->items_per_page.'" />
            <input type="hidden" id="'.$this->id.'_sort" name="'.$this->id.'_sort" value="'.$this->sort.'" />
            <input type="hidden" id="'.$this->id.'_page" name="'.$this->id.'_page" value="'.$this->page.'" />
            <input type="hidden" id="'.$this->id.'_total_items" name="'.$this->id.'_total_items" value="'.$this->total_items.'" />';

        return $out;
    }

    // Draw the search component
    function draw_search(){
        $out='';

        if($this->search_init)
            $out.='<input type="text" id="'.$this->id.'_search" name="'.$this->id.'_search" value="'.$this->search.'" onfocus="ctSearchFocus(\''.$this->id.'\');" onblur="ctSearchBlur(\''.$this->id.'\');" onkeypress="ctSearchKeypress(\''.$this->id.'\');" onkeyup="ctSearch(\''.$this->id.'\');" />'.$this->change_tags($this->search_html);

        return $out;
    }

    // Draw the items_per_page component
    function draw_items_per_page(){
        $out='';

        if($this->items_per_page_init!==false and $this->total_items>0){

            $out='<select id="'.$this->id.'_items_per_page_change" name="'.$this->id.'_items_per_page_change" onchange="'.$this->change_tags($this->items_per_page_url).'">';

            // formula $i*10; pow(10,$i)
            if(strpos($this->items_per_page_init,'$')!==false){

                $i=1;

                eval('$value='.$this->items_per_page_init.';');

                while ($value<$this->total_items) {

                    $out.='<option value="'.$value.'"'.($value==$this->items_per_page ? ' selected="selected"' : '').'>'.$value.'</option>';

                    $i++;

                    eval('$value='.$this->items_per_page_init.';');

                }

            }else{

                $i=0;

                $arr_items_per_page=explode(',',$this->items_per_page_init);

                while ($i<count($arr_items_per_page) and $arr_items_per_page[$i]<$this->total_items) {

                    $out.='<option value="'.$arr_items_per_page[$i].'"'.($arr_items_per_page[$i]==$this->items_per_page ? ' selected="selected"' : '').'>'.$arr_items_per_page[$i].'</option>';

                    $i++;

                }

            }

            if($this->items_per_page_all!='')
                $out.='<option value="all"'.('all'==$this->items_per_page ? ' selected="selected"' : '').'>'.$this->change_tags($this->items_per_page_all).'</option>';

            $out.='</select>';
        }

        return $out;
    }

    // Draw the header of the table
    function draw_header(){
        $out_multiple_search='';

        $arr_width=explode(',',$this->width);
        $out='<tr id="'.$this->id.'_sort">';

        $arr_sort=explode('_',$this->sort);
        $arr_header=explode(',',$this->header);

        $column=1;
        for($i=0; $i<count($arr_header);$i++){

            if($this->display_cols[$i]!='f'){
                if($this->sort_init!==false and $this->sort_init[$i]!='f')
                    $out.='<th'.(($this->width!='' and $arr_width[$i]>0) ? ' width="'.$arr_width[$i].'"' : '').' onclick="'.$this->change_tags($this->get_url($i+1)).'"><span'.($arr_sort[$i]=='f' ? ' class="no_sort' : ' class="sort').(substr($arr_sort[$i],-1)=='a' ? '_asc' : (substr($arr_sort[$i],-1)=='d' ? '_desc' : '')).'"></span>'.$arr_header[$i].'</th>';
                else
                    $out.='<th'.(($this->width!='' and $arr_width[$i]>0) ? ' width="'.$arr_width[$i].'"' : '').'><span></span>'.$arr_header[$i].'</th>';

                if($this->multiple_search_init===true or $this->multiple_search_init=='hide' or (strpos($this->multiple_search_init,'hide')!==false and $this->multiple_search_init[$i]=='t') or $this->multiple_search_init[$i]=='t')
                    $out_multiple_search.='<th><input type="text" id="'.$this->id.'_multiple_search'.($i+1).'" name="'.$this->id.'_multiple_search[]'.'" value="'.$this->multiple_search[$i].'" onkeyup="ctMultiSearch(\''.$this->id.'\');" /></a></th>';
                else
                    $out_multiple_search.='<th></th>';
            }

        }


        $out.='</tr>';

        if($this->multiple_search_init===true or strpos($this->multiple_search_init,'hide')!==false or strpos($this->multiple_search_init,'t')!==false)
            $out.='<tr id="'.$this->id.'_multiple_search"'.(($this->multiple_search_init!==true and strpos($this->multiple_search_init,'hide')!==false) ? ' style="display: none;"' : '').'>'.$out_multiple_search.'</tr>';

        return $out;
    }

    // Draw the body of the table
    function draw_body(){
        $out='';

        if($this->total_items>0){
            $arr_width=explode(',',$this->width);
            for($i=0; $i<count($this->data);$i++){
                $out.='<tr'.($this->odd_even ? ($i%2==0 ? ' class="odd"' : ' class="even"') : '').'>';
                $j=0;
                foreach($this->data[$i] as $key => $value){
                    if($this->display_cols[$j]!='f')
                        $out.='<td'.(($i==0 and $this->width!='' and $arr_width[$key]>0) ? ' width="'.$arr_width[$key].'"' : '').'>'.str_replace('#ROW#',$i+1,$this->change_tag_col($this->change_tags($value),$this->data[$i])).'</td>';
                    $j++;
                }
                $out.='</tr>';
            }
        }else{
            $arr_header=explode(',',$this->header);

            if($this->no_results!==false)
                $out.='<tr id="'.$this->id.'_no_results"><td colspan="'.count($arr_header).'">'.$this->no_results.'</td></tr>';
        }

        return $out;
    }

    // Draw the actions component
    function draw_actions(){
        $out='';

        if(count($this->actions)>0){

            $out='<select id="'.$this->id.'_actions" name="'.$this->id.'_actions" onchange="'.$this->change_tags($this->actions_url).'">';

            for($i=0; $i<count($this->actions); $i++)
                $out.='<option value="'.$this->actions[$i][0].'">'.$this->actions[$i][1].'</option>';

            $out.='</select>';

        }

        return $out;
    }

    // Draw the pager component
    function draw_pager(){
        return $this->pager;
    }

    // Draw the necessary javascript block
    function draw_javascript_block(){
        // sort order
        $out_sort_order='var arr_sort_order= new Array();';

        for($i=0; $i<strlen($this->sort_order); $i++){
            if($i==strlen($this->sort_order)-1)
                $out_sort_order.='arr_sort_order["'.$this->sort_order[$i].'"]="'.$this->sort_order[0].'";';
            else
                $out_sort_order.='arr_sort_order["'.$this->sort_order[$i].'"]="'.$this->sort_order[$i+1].'";';
        }

        if(strpos($this->sort_order,'t')===false)
            $out_sort_order.='arr_sort_order["t"]="";';

        $out_sort_order.='arr_sort_order["first"]="'.$this->sort_order[0].'";';

        $out='<script type="text/javascript">'.$out_sort_order.'var extra_cols ='.json_encode($this->extra_cols).';';

        if($this->ajax_url!='')
            $out.='var ajax_url="'.$this->ajax_url.'";';

        if($this->pager_ids!='')
            $out.='var pager_ids=new Array("'.str_replace(',','","',$this->pager_ids).'");';
        else
            $out.="var pager_ids='';";

        if($this->search=='')
            $out.='$(document).ready(function(){ $("#'.$this->id.'_search_value").css("opacity","1"); });';

        $out.='</script>';

        return $out;
    }

    // Displays the output
    function display($op='',$ajax=false){
        $arr_out=array();
        $out='';

        // Builds all the structure of the table
        $this->init_sort();

        if(($op=='' or strpos($op,'form_init')!==false) and $this->form_init)
            $arr_out['form_init']=$this->draw_form();

        $arr_out['total_items']=$this->total_items;

        if($op=='' or strpos($op,'search')!==false){
            if($ajax)
                $arr_out['search']=$this->draw_search();
            else
                $arr_out['search']='<div id="'.$this->id.'_search_container">'.$this->draw_search().'</div>';
        }

        if($op=='' or strpos($op,'items_per_page')!==false){
            if($ajax)
                $arr_out['items_per_page']=$this->draw_items_per_page();
            else
                $arr_out['items_per_page']='<div id="'.$this->id.'_items_per_page_container">'.$this->draw_items_per_page().'</div>';
        }

        if($op=='' or strpos($op,'table')!==false){
            $arr_out['table']='<table id="'.$this->id.'"'.($this->class!='' ? ' class="'.$this->class.'"' : '').'>';
            if($this->header!==false)
                $arr_out['table'].='<thead>'.$this->draw_header().'</thead>';
            $arr_out['table'].='<tbody>'.$this->draw_body().'</tbody>';
            $arr_out['table'].='</table>';
        }

        if(strpos($op,'thead')!==false){
            if($ajax)
                $arr_out['thead']=$this->draw_header();
            else
                $arr_out['thead']='<thead>'.$this->draw_header().'</thead>';
        }

        if(strpos($op,'tbody')!==false){
            if($ajax)
                $arr_out['tbody']=$this->draw_body();
            else
                $arr_out['tbody']='<tbody>'.$this->draw_body().'</tbody>';
        }

        if(($op=='' or strpos($op,'actions')!==false) and count($this->actions)>0){
            if($ajax)
                $arr_out['actions']=$this->draw_actions();
            else
                $arr_out['actions']='<div id="'.$this->id.'_actions_container">'.$this->draw_actions().'</div>';
        }

        if(($op=='' or strpos($op,'pager')!==false) and $this->pager!=''){
            if($ajax)
                $arr_out['pager']=$this->draw_pager();
            else
                $arr_out['pager']='<div id="'.$this->id.'_pager_container">'.$this->draw_pager().'</div>';
        }

        if(($op=='' or strpos($op,'form_final')!==false) and $this->form_init)
            $arr_out['form_final']='</form>';

        if($op=='' or strpos($op,'javascript')!==false)
            $arr_out['javascript']=$this->draw_javascript_block();

        if($ajax){
            foreach($arr_out as $key => $value)
                $arr_out[$key]=utf8_encode($value);
        }

        if($op=='')
            $out=$arr_out['form_init'].$arr_out['search'].$arr_out['items_per_page'].$arr_out['table'].$arr_out['actions'].$arr_out['pager'].$arr_out['form_final'].$arr_out['javascript'];
        else
            $out=$arr_out;

        $this->out=$out;

        return $out;
    }

}

?>