<?php
class SchoolSearchBox
{
    function main()
    {
        $retVal = '';
        $retVal .= '<style>' . file_get_contents(__DIR__ . '/../assets/school_search_box.css') . '</style>';
        $retVal .= '<script>' . file_get_contents(__DIR__ . '/../assets/school_search_box.js') . '</script>';
        $retVal .= '
            <div id="tns_student_ajax_search" class="StudentAjaxSearch">
                <aside class="widget widget_codenegar_ajax_search">
                    <div class="codenegar_ajax_search_wrapper">
                        <div style="" class="ajax_autosuggest_form_wrapper">
                            <input type="text" autocomplete="off" placeholder="" style="" value=""> <img  class="searchIcon" src="/wp-content/uploads/2023/02/search.svg" alt="searchIcon"/>
                        </div>
                    </div>
                </aside>
            </div>
            ';
        return $retVal;
    }
}
?>