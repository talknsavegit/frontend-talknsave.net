<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

if(!class_exists('vxcf_activecamp_api')){
    
class vxcf_activecamp_api extends vxcf_activecamp{
  
    public $info='' ; // info
    public $url='';
    public $api_key='';
    public $error= "";
    public $timeout= "15";

function __construct($info) {
     
    if(isset($info['data'])){ 
       $this->info= $info;
       if(!empty($info['data']['api_key'])){
$this->api_key=$info['data']['api_key'];
$this->url=$info['data']['api_url'];    
       }
    } }
public function get_token(){
  $users=$this->post_crm('account_view','get');

    $info=$this->info;
    $info=isset($info['data']) ? $info['data'] : array();
    if(is_array($users) && !empty($users['email']) ){
    $info['valid_token']='true';    
    }else {
     if(!empty($users)){
         $info['error_msg']=$users;
     }   
      unset($info['valid_token']);  
    }
    return $info;

}

public function get_crm_objects(){

$res=array('contact'=>'Contact');
 return $res;
}

public function get_crm_fields($module,$fields_type=false){

$fields=$this->post_crm('list_field_view','get');

$res=array('first_name'=>array('label'=>'First Name','name'=>'first_name','type'=>'text','req'=>'true'),
'last_name'=>array('label'=>'Last Name','name'=>'last_name','type'=>'text','req'=>'true'),
'email'=>array('label'=>'Email','name'=>'email','type'=>'email','req'=>'true'),
'phone'=>array('label'=>'Phone','name'=>'phone','type'=>'tel'),
'orgname'=>array('label'=>'Organization','name'=>'orgname','type'=>'text'),
'tags'=>array('label'=>'Tags','name'=>'tags','type'=>'text'),
'ip4'=>array('label'=>'Member IP Address','name'=>'ip4','type'=>'text'),
);
if($fields_type){ $res=array(); }
if(!empty($fields['result_code'])){
 foreach($fields as $k=>$v){
     if(empty($v['id'])){ continue; }
     $field=array('label'=>$v['title'],'name'=>$v['id'],'type'=>$v['type'],'is_custom'=>'1');
     if(in_array($v['type'],array('checkbox','radio','listbox','dropdown'))){
     if(!empty($v['options'])){ 
         $op=array();
         foreach($v['options'] as $vv){
         $op[]=$vv['value'];    
         }
         $field['eg']=implode(',',$op);  
         $field['options']=$v['options'];  
     } }else if($fields_type){
         continue;
     }
      if( !empty($v['isrequired']) ){
          $field['req']='true';    
          } 
      if( !empty($v['tag']) ){
          $field['tag']=$v['tag'];    
          } 
  $res[$v['id']]=$field;   
  }  
}else if(!empty($fields['result_message'])){
//$res=$fields['result_message'];  
}

return $res;
}
  /**
  * Get users from activecamp
  * @return array users
  */
public function get_lists($object){ 
$fields=$this->post_crm('list_list','get');


$users=array();   
$msg='No List Found';
if(!empty($fields['result_code'])){
 foreach($fields as $k=>$v){
     if(empty($v['id'])){ continue; }
  $users[$v['id']]=$v['name'];   
 }
}else if(!empty($fields['result_message'])){
 $users=$fields['result_message'];   
}

  return $users;
}


public function push_object($module,$fields,$meta){  
//check primary key
 $extra=$post=array();
  $debug = isset($_GET['vx_debug']) && current_user_can('manage_options');
  $event= isset($meta['event']) ? $meta['event'] : '';
  $id= isset($meta['crm_id']) ? $meta['crm_id'] : '';
  if($debug){ ob_start();}
if(isset($meta['primary_key']) && $meta['primary_key']!="" && isset($fields[$meta['primary_key']]['value']) && $fields[$meta['primary_key']]['value']!=""){    
$search=$fields[$meta['primary_key']]['value'];
$q=array('filters'=>array($meta['primary_key']=>$search));
$search_response=$this->post_crm('contact_view_email','get',array('email'=>$search)); //contact_view_email
//$id='1';
if(!empty($search_response['id']) && !empty($search_response['id']) ){
  $id=$search_response['id']; 
  if(!empty($search_response['lists'])){ 
      foreach($search_response['lists'] as $list){
     $post['p'][$list['listid']]=intval($list['listid']);      
      }
  }
  if(isset($search_response['lists'])){
      unset($search_response['lists']);
  }
  if(isset($search_response['fields'])){
      unset($search_response['fields']);
  }
  if(isset($search_response['automation_history'])){
      unset($search_response['automation_history']);
  }
}

  if($debug){
  ?>
  <h3>Search field</h3>
  <p><?php print_r($field) ?></p>
  <h3>Search term</h3>
  <p><?php print_r($search) ?></p>
    <h3>POST Body</h3>
  <p><?php print_r($body) ?></p>
  <h3>Search response</h3>
  <p><?php print_r($res) ?></p>  
  <?php
  }

      $extra["body"]=$search;
      $extra["response"]=$search_response;
  }


     if(in_array($event,array('delete_note','add_note'))){    
  if(isset($meta['related_object'])){
    $extra['Note Object']= $meta['related_object'];
  }
  if(isset($meta['note_object_link'])){
    $extra['note_object_link']=$meta['note_object_link'];
  }
}

 $status=$action=$method=""; $send_body=true;
 $entry_exists=false;
//var_dump($fields,$meta); die();
$object_url='';
$is_main=false;

if($id == ""){
    //insert new object
$action="Added";  $status="1"; $method='post';
$object_url='contact_add';
$is_main=true;
}else{
 $entry_exists=true;
    if($event == 'add_note'){
        if(!empty($fields['body']['value'])){
         $post['note']=$fields['body']['value']; 
         $post['id']=$id; $post['listid']=0;  
        }

$action="Note Added"; $status="1";
$object_url='contact_note_add';
$method='post';  
}else if(in_array($event,array('delete','delete_note'))){
 $send_body=false;
 $method='get'; 
 $object_url='';
     if($event == 'delete_note'){ $post['noteid']=$id;
  $object_url='contact_note_delete';
  }else{ $object_url='contact_delete'; $post['id']=$id; }
  $action="Deleted";
  $status="5";  
  }else{
$action="Updated"; $status="2";
if(empty($meta['update'])){     
 $is_main=true;
$object_url='contact_edit'; $fields['id']=array('label'=>'Contact Id','value'=>$id);
$post['id']=$id;
 $method='put';
 } }
}

if($is_main){

$crm_fields=array();
if(!empty($meta['fields'])){
  $crm_fields=$meta['fields'];  
}

if(is_array($fields) && count($fields)>0){
    $merge_fields=array();
    foreach($fields as $k=>$v){
        $val=$v['value'];
  if(!empty($crm_fields[$k]['type'])){     
  if(isset($crm_fields[$k]['is_custom'])){
  $merge_fields[$k.',0']=$val;      
  }else{
   $post[$k]=$val;     
  } 
}
}
$post['field']=$merge_fields;
if(!empty($meta['assign_list']) && !empty($meta['lists'])){
    $fields['lists']=array('label'=>'Lists','value'=>$meta['lists']);
foreach($meta['lists'] as $k=>$v){
 $post['p'][$k]=$k;
 if(!empty($meta['status'])){  $post['status'][$k]=$meta['status'] == 'no' ? '0' : $v;  }   
 if(!empty($meta['future'])){  $post['noresponders'][$k]= $meta['future']  == 'no' ? '0' : $v;  }   
 if(!empty($meta['instant'])){  $post['instantresponders'][$k]= $meta['instant']  == 'no' ? '0' : $v;  }   
 if(!empty($meta['last_msg'])){  $post['lastmessage'][$k]= $meta['last_msg'] == 'no' ? '0' : $v;  }   
} }

$fields['lists']=array('label'=> 'Lists','value'=>$post['p']);
} } 
//var_dump($object_url,$post);    die();
$link=""; $error=""; $arr=array();
if( !empty($object_url) ){
$arr= $this->post_crm($object_url, 'post',$post);
//var_dump($object_url,$arr,$post,$object_url);    die();
/*if(empty($arr['result_code']) && !empty($arr[0]['id'])){
$id=$arr[0]['id'];
$object_url='contact_edit'; $fields['id']=array('label'=>'Contact Id','value'=>$id);
$post['id']=$id;
 $method='put';
 $arr= $this->post_crm($object_url, $method,$post);
 var_dump($arr); 
}*/

}


if(empty($id) && !empty($arr[0]['id'])){
$id=$arr[0]['id'];        
}else if(!empty($arr['subscriber_id'])){
$id=$arr['subscriber_id'];
}else if(empty($arr['result_code']) &&  !empty($arr['result_message'])){
$status=''; $error=$arr['result_message']; $id='';
}
if($event == 'add_note' && !empty($arr['id'])){
 $id=$arr['id'];   
}
//var_dump($object_url,$arr,$event,$post); die();
  if($debug){
  ?>
  <h3>Account Information</h3>
  <p><?php //print_r($this->info) ?></p>
  <h3>Data Sent</h3>
  <p><?php print_r($post) ?></p>
  <h3>Fields</h3>
  <p><?php echo json_encode($fields) ?></p>
  <h3>Response</h3>
  <p><?php print_r($response) ?></p>
  <h3>Object</h3>
  <p><?php print_r($module."--------".$action) ?></p>
  <?php
 echo  $contents=trim(ob_get_clean());
  if($contents!=""){
  update_option($this->id."_debug",$contents);   
  }
  }
       //add entry note
 if(!empty($meta['__vx_entry_note']) && !empty($id)){
 $disable_note=$this->post('disable_entry_note',$meta);
   if(!($entry_exists && !empty($disable_note))){
       $entry_note=$meta['__vx_entry_note'];
       if(!empty($entry_note['body'])){
      $note_post=array('note'=>$entry_note['body'],'id'=>$id,'lisid'=>0);
$object_url='contact_note_add';
$note_response= $this->post_crm( $object_url,'post',$note_post);
  $extra['Note Body']=$entry_note['body'];
  $extra['Note Response']=$note_response;
       }
   }  
 }

return array("error"=>$error,"id"=>$id,"link"=>$link,"action"=>$action,"status"=>$status,"data"=>$fields,"response"=>$arr,"extra"=>$extra);
}
public function create_fields_section($fields){ 
$arr=array(); 
if(!isset($fields['object'])){
        $objects=array(''=>'Select Object');
        $objs=$this->get_crm_objects();
        if(is_array($objs) && count($objs)>0){
         $objects=array_merge($objects,$objs);   
        }
 $arr['gen_sel']['object']=array('label'=>'Select Object','options'=>$objects,'is_ajax'=>true,'req'=>true);   
}else if(isset($fields['fields']) && !empty($fields['object'])){
    $crm_fields=$this->get_crm_fields($fields['object']); 
    if(!is_array($crm_fields)){
        $crm_fields=array();
    } 

    $add_fields=array();
    if(is_array($fields['fields']) && count($fields['fields'])>0){
        foreach($fields['fields'] as $k=>$v){
           $found=false; 
                foreach($crm_fields as $crm_key=>$val){
                    if(isset($val['tag'])){ $crm_key=$val['tag']; }
                    if(strpos($crm_key,$k)!== false){
                        $found=true; break;
                }
            }
         //   echo $found.'---------'.$k.'============'.$crm_key.'<hr>';
         if(!$found){
       $add_fields[$k]=$v;      
         }   
        }
    }
 $arr['fields']=$add_fields;   
}

return $arr;  
}  

public function create_field($field){
  //  return 'ok';
 
$name=isset($field['name']) ? $field['name'] : '';
$label=isset($field['label']) ? $field['label'] : '';
$type=isset($field['type']) ? $field['type'] : '';
$object=isset($field['object']) ? $field['object'] : '';

$error='Unknow error';
if(!empty($label) && !empty($type) && !empty($object)){
    $type = $type == 'text' ? '1' : '2';
$body=array('title'=>$label,'type'=>$type,'req'=>0,'perstag'=>'','p[0]'=>'0');    
$url='list_field_add';    
$arr=$this->post_crm($url,'post',$body);

    $error='ok';
if(!empty($arr['error']) ){

 $error=$arr['error'];       
}
}
return $error;    
}

public function post_crm($action,$method,$body=''){
      $q=array('api_output'=>'json','full'=>0); 
    $q['api_action']=$action;
    $q['api_key']=$this->api_key;
      if(is_array($body)&& count($body)>0)
   { 
       if($method == 'get'){
        $q=array_merge($q,$body);   
       }else if($method == 'post'){
       $body=http_build_query($body);
       }
   }else{
       $q['ids']='all';
   }
 $url=trailingslashit($this->url).'admin/api.php?'.http_build_query($q);   
     $head=array(); 
  $head['Content-Type']='application/x-www-form-urlencoded'; 

     $args = array(
  'body' => $body,
  'headers'=> $head,
  'method' => strtoupper($method), // GET, POST, PUT, DELETE, etc.
  'sslverify' => false,
  'timeout' => 30,
  );
  
  $response = wp_remote_request($url, $args);

  if(is_wp_error($response)) { 
  $this->errorMsg = $response->get_error_message();
  return false;
  }
$body=json_decode($response['body'],true);

return $body;
}
public function get_entry($module,$id){


$arr=$this->post_crm('contact_view','get',array('id'=>$id));

if(!empty($arr['fields']) && is_array($arr['fields'])){
    foreach($arr['fields'] as $k=>$v){
     if(!empty($v['val'])){
         $arr[$k]=$v['val'];   
    }
} }
return $arr;     
} }

}
?>