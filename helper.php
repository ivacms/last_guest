<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class ivacms_last_guest {

	private $set;
	
	private $db;
	
	private $lang;

	function __construct(){

		$doc = JFactory::getDocument();
		
		$baseUrl = JUri::base();
		
		$doc->addStyleSheet($baseUrl."/modules/mod_guest/tmpl/css.css");
	
		$this->set=JFactory::getConfig();
		
		$this->lang=JFactory::getLanguage();
		
		$this->db = JFactory::getDBO();
		
	}
	
	/******************************************

	Проверяем установку компонента Phoca guestBook в системе

	*******************************************/	
	
	private function check_component(){

		if(file_exists(JPATH_BASE.'/components/com_phocaguestbook/phocaguestbook.php')){
			return true;
		}else{
			return false;
		}
	}
	
	/******************************************

	Добавляем в массив созданые категории компонента PhocaGuestBook

	*******************************************/	
	
	private function category(){
	
		$q="select * from `".$this->set->get('dbprefix')."categories` where `extension`='com_phocaguestbook' ";
		
		$this->db->setQuery($q);
		
		$this->db->query(); 
		
		$row=$this->db->loadAssocList();
		
		return $row;
	
	}
	
	/******************************************

	Составляем sql запрос из настроек модуля, и подключаем шаблон

	*******************************************/	
	
	public function show($module,$params){
	
		if(!$this->check_component())return;
	
		$q="select * from `".$this->set->get('dbprefix')."phocaguestbook_items` ";
		
		$q.=" where `language`='".$this->set->get('language')."' ";
		
		if( (int)$params['type'] !=0 and empty( $params['spec'] )){
		
			$q.=" and `catid`='".intval($params['type'])."' ";
			
			$q.=" or `language`='*' and `catid`='".intval($params['type'])."' ";
		
		
		}
		
		if( is_array($params['spec']) and !empty( $params['spec'] )){
		
			$params['spec']=array_map('intval',$params['spec']);
		
			$q.=" and `id` in(".implode(',',$params['spec']).")";
			
		}
		

		if( in_array($params['sort'],array('id desc','date ASC','id desc','rand()')) ){
		
			$q.=" order by ".$params['sort'];
			
		}	

		
		if( (int)$params['limit']>0){
		
			$q.=" limit ".intval($params['limit']);
		
		}

		$this->db->setQuery($q);

		$this->db->query(); 

		$row=$this->db->loadAssocList();

		$content=array();
		
			foreach($row as $con){
					
				if(isset($params['img'])){
				
					preg_match('#<img src="(.*)"(.*)>#isU',$con['content'],$img);
		
					$con['img']=$img[1];
					
					$con['content']=preg_replace('#<img(.*)>#isU','',$con['content']);
				
				} else {
				
					$con['img']='';
					
					$con['content']=preg_replace('#<img(.*)>#isU','',$con['content']);
				
				}
			
				if(isset($params['striptag'])){
		
					$con['content']=strip_tags($con['content']);
	
				}			
								
				
				if($params['col'] >0){
		
					$con['content']=mb_substr($con['content'],0,$params['col'],'UTF-8').$params['symb'];
	
				}
			
				$content[]=$con;
		
			}
			
			if($params['button_link'] ==''){
			
				$params['button_link']= JRoute::_('index.php?option=com_phocaguestbook&view=guestbook&cid='.$params['type']);
			
			}

			if($module->showtitle==1){
			
				$params['zag']=$module->title;
				
			}else{
			
				$params['zag']='';
			
			}
			

		
		require(JModuleHelper::getLayoutPath('mod_guest',$params['template']));
	

	}

}