<?php 

class SessionCart 
{
	public static function addItem($item) {
		Session::push($item['_key'], $item);
		return SessionCart::show($item['_key'],$item['_template']);
	}

	public static function delItem($_index, $_key, $_template) {
		$items = Session::get($_key);
		// Change item
		$items[$_index]['_delete'] = 'delete';
		Session::set($_key, $items);
		return SessionCart::show($_key,$_template);
	}

	public static function show($_key, $_template) {
		$list = Session::get($_key);
		return View::make($_template)->with('list', $list)->render();	
	} 
}