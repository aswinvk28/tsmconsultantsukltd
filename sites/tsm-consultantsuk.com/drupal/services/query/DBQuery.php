<?php
/*
 * Created on 15 Aug 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 

define('AS_COMBINATION', 'COMBO');
define('FROM_DESIGN', 'DESIGN');

class DBQuery {
    
    /**
    * Returns the list of all providers
    *
    * @param $providerMachineName
    *   The machine name of the provider.
    */
    public function fetchProviders($machineName) {
        if(empty($machineName)) { $machineName = "exam_layout"; }
        $query = db_query("SELECT ttd.name as exam_certified_by, ttd.description as certifier_details FROM {taxonomy_term_data} ttd
                LEFT JOIN {taxonomy_vocabulary} tv ON ttd.vid = tv.vid
                LEFT JOIN {taxonomy_term_hierarchy} tth ON ttd.tid = tth.tid WHERE tv.machine_name='".$machineName."' AND tth.parent='0' ORDER BY ttd.weight");
        return $query->fetchAll();
    }
    
    /**
    * Returns the list of all courses according to the fetch style / layout of the entries 
    *
    * @param $fetchCourseStyle
    *   The mandatory parameter and determines the style of fetching from taxonomy.
    * @param $aliasArray
    *   The set of values for the JSON output. Its count should be either 5 (Combining exam certification and exam title) or 3 (getting the parent from the design layout)
    */
    public function fetchCourses($fetchCourseStyle, $aliasArray = array()) {
        
        if (isset($fetchCourseStyle)) {
            switch($fetchCourseStyle) {
                
                case constant('AS_COMBINATION'):
                    if (empty($aliasArray) || count($aliasArray) != 6) {
                        $aliasArray = array("exam", "exam_cert", "exam_certified_by", "exam_title", "tab_name", "tab_level");
                    }
                    
                    $columns = 'ttd.name AS '.$aliasArray[0].', ttd_cert.name AS '.$aliasArray[1].', ttd_prov.name AS '.$aliasArray[2].', fecourse.field_exam_course_value AS '.$aliasArray[3].', ttd_fcc.name AS '.$aliasArray[4].', ttd_fcl.name AS '.$aliasArray[5];
                    
                    $query = db_query("SELECT ".$columns." FROM {taxonomy_term_data} ttd
                        INNER JOIN {taxonomy_term_hierarchy} tth ON tth.tid = ttd.tid
                        INNER JOIN {taxonomy_term_data} ttd_cat ON tth.parent = ttd_cat.tid
                        INNER JOIN {taxonomy_term_hierarchy} tth_cert ON tth_cert.tid = ttd_cat.tid
                        INNER JOIN {taxonomy_term_data} ttd_cert ON ttd_cert.tid = tth_cert.parent
                        INNER JOIN {taxonomy_term_hierarchy} tth_prov ON tth_prov.tid = ttd_cert.tid
                        INNER JOIN {taxonomy_term_data} ttd_prov ON ttd_prov.tid = tth_prov.parent
                        INNER JOIN {field_data_field_exam_cert} fec ON ttd.tid = fec.entity_id
                        INNER JOIN {field_data_field_exam_course} fecourse ON ttd.tid = fecourse.entity_id
                        INNER JOIN {field_data_field_course_category} fcc ON ttd.tid = fcc.entity_id
                        INNER JOIN {taxonomy_term_data} ttd_fcc ON fcc.field_course_category_tid = ttd_fcc.tid
                        INNER JOIN {field_data_field_course_level} fcl ON ttd.tid = fcl.entity_id
                        INNER JOIN {taxonomy_term_data} ttd_fcl ON fcl.field_course_level_tid = ttd_fcl.tid ORDER BY ttd_fcl.weight, ttd_cert.weight");
                    break;
                    
                case constant('FROM_DESIGN'):
                    if (empty($aliasArray) || count($aliasArray) != 3) {
                        $aliasArray = array("exam", "course_title", "exam_certified_by");
                    }
                    
                    $columns = 'ttd.name AS '.$aliasArray[0].', from_ecat.name AS '.$aliasArray[1].', from_eprov.name AS '.$aliasArray[2];
                    
                    $query = db_query("SELECT ".$columns." FROM {field_data_field_exam_pre} fep
                        INNER JOIN {taxonomy_term_data} ttd ON fep.entity_id = ttd.tid
                        INNER JOIN {taxonomy_term_hierarchy} tth ON tth.tid = ttd.tid
                        INNER JOIN {taxonomy_term_data} from_ecat ON from_ecat.tid = tth.parent
                        INNER JOIN {taxonomy_term_hierarchy} tth_prov ON tth_prov.tid = from_ecat.tid
                        INNER JOIN {taxonomy_term_data} from_eprov ON from_eprov.tid = tth_prov.parent WHERE fep.field_exam_pre_value='FIN'");
                    break;
                        
                default: break;     
            }
        }
        return $query->fetchAll();
    }
    
    /**
    * Returns the essential content for the Front Page
    *
    * @param $nodeType
    *   The set of node types to be included in the selection.
    */
    public function fetchFrontPageContent($nodeType = array(), $aliasArray = array()) {
        if (empty($nodeType)) {
            $nodeType = array('courses', 'certificates');
        }
        $selectType = "(";
        for($index = 0; $index < count($nodeType); $index++) {
            $selectType .= "n.type='".$nodeType[$index]."'";
            if((count($nodeType) - $index) == 1) break;
            $selectType .= " OR ";
        }
        $selectType .= ")";
        if(empty($aliasArray) || count($aliasArray) != 3) {
            $aliasArray = array("tile_heading", "node_id", "main_content", "short_content", "image_source", "image_caption", "image_title");
        }
        $columns = 'n.title AS '.$aliasArray[0].', n.nid as '.$aliasArray[1].', fdb.body_value AS '.$aliasArray[2].', fdb.body_summary AS '.$aliasArray[3].', fm.uri AS '.$aliasArray[4].', fji.field_jsimage_alt AS '.$aliasArray[5].', fji.field_jsimage_title AS '.$aliasArray[6];
        
        $query = db_query("SELECT ".$columns." FROM {node} n
            LEFT JOIN {field_data_body} fdb ON n.nid = fdb.entity_id
            LEFT JOIN {field_data_field_tile_bool} ftb ON n.nid = ftb.entity_id
            LEFT JOIN {field_data_field_jsimage} fji ON n.nid = fji.entity_id
            LEFT JOIN {file_managed} fm ON fji.field_jsimage_fid = fm.fid
            WHERE n.status='1' AND n.promote='1' AND ".$selectType." AND ftb.field_tile_bool_value = '1' order by n.changed LIMIT 0,36");
            
        return $query->fetchAll();
    }
    
    public function fetchCourseDetails() {
        
    }
    
    public function fetchFAQs($machineName) {
        if(empty($machineName)) { $machineName = "fa_questions"; }
        $vid = db_select("taxonomy_vocabulary", "tv")->fields("tv", array("vid"))->condition("machine_name", $machineName)->execute()->fetch()->vid;
        $query = db_query("SELECT ttd.name AS question, ttd.description AS answer FROM {taxonomy_term_data} ttd WHERE ttd.vid='".$vid."'");
        return $query->fetchAll();
    }
    
    public function fetchCourseCategory($machineName) {
        if(empty($machineName)) { $machineName = "course_kind"; }
        $query = db_query("SELECT ttd.name as tab_name, ttd.description as tab_details FROM {taxonomy_term_data} ttd
                            INNER JOIN {taxonomy_vocabulary} tv ON ttd.vid = tv.vid WHERE tv.machine_name = '".$machineName."'");
        return $query->fetchAll();
    }
    
}

?>
