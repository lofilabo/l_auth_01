<?php
//require_once app_path().'/includes/class.Diff.php';

class Comment extends _BaseModel {
	
	public function user(){
		return $this->belongsTo("User" , "_id", "user");
	}


	public function GetCommentByID($commentID) {
		//echo("COMMENT ID: " . $commentID .  "\n");
		
		$currentcomments = Comment001::where('_id', $commentID)->get();
		
		$i = 0;
		foreach ($currentcomments as $currentcomment){
			$i++;
		}		
		//var_dump($currentcomments);
		//echo($currentcomments);
		if($i > 0){
		
			
			return Response::json(array(
				'data' =>$currentcomments->toArray(),
				'error' => "0"
			),200);
		}else{
			return Response::json(array(
				'data' =>"",
				'error' => "No Such Comment ON Get One Comments by CommentID. (ID = ". $commentID .")"
			), 200);
		}
	}

	public function GetAllCurrentCommentsByItemID($itemID, $page, $count, &$retval, &$msg, &$status) {
	  //default page number is 1, not 0.  Bad maths, but page counts generally start at 1.
	  //$pagenumber=1;
	  //$itemsperpage = 3;

	  $pagenumber=intval($page);
	  $itemsperpage = $count;
	   //dd($pagenumber);
	   //dd($itemsperpage);
	  //get start item from pagenumber
		$startitem = ((($pagenumber * $itemsperpage) )  );
	  //get end item from pagenumber
		$enditem = (($pagenumber * $itemsperpage) + $itemsperpage );
		
		//correct the bad maths by deducting 1 from the itemcount to get the array start and end point.
		$arrstartpoint = $startitem  ;
		$arrendpoint   = $enditem -1;

	  if(is_null($item = Item::find($itemID))) {
	  	return Response::json(array('message'=>array("No such ItemID " . $itemID)),200);
	  }	

		$i = 0;
		$briefcomments=array();
		
		//we start by assuming that this is the last page and the first page
		$moreItemsYN = 0;
		
		if($pagenumber>0){
			$lessItemsYN = 1;
		}else{
			$lessItemsYN = 0;
		}

		$currentcomments = Comment001::with("user")->where('item', $itemID)->take($itemsperpage)->skip($startitem)->orderBy('created_at', 'desc')->get();
		$datas = array();
		
		$datas['item'] = $item->toArray() ;
		$datas['user'] = Auth::getUser()->toArray() ;

		$datas['pagination'] = array(
				'currentpage'=>$pagenumber,
				'navigation' => array(
						'previous' 	=> URL::current() . "?count=". $itemsperpage ."&page=" . ($pagenumber-1),
						'next'		=> $currentcomments->count() > 0 ? URL::current() . "?count=". $itemsperpage ."&page=" . ($pagenumber+1) : null
				)
		);
		
		
		$datas['comments'] = $currentcomments->toArray();
		
		//$datas['comments']= $briefcomments;
		
//		echo($i);
//		var_dump($currentcomments);
//		var_dump($datas);
		//dd($datas);
		return Response::json($datas);
		if($i > 0){
			$retval = $datas;
			$msg= "0";
			$status = 200;
			return 1;
			
			//return $datas;
		}else{
			$retval = "";
			$msg= "No Comments with ItemID " . $itemID;
			$status = 200;
			return 0;
			
			return Response::json(  array(
				'data' =>"",
				'error' => "No Comments with ItemID " . $itemID
			) , 200);
		}
				
		
	}

	public function PutNewCommentByItemIDandUserID($itemID, $userID, $commentTxt, &$retval, &$msg, &$status){
		/*
		 * This stores a new Comment.
		 * Set the CurrentComment AND the first archived item to $commentTxt.
		 * Archives are set as {KEY=[Text Version of Current Date-Time], VALUE=[$commentTxt]}
		 * */
		$itemcomments = Item::where('_id', $itemID)->get();
		$i = 0;
		foreach ($itemcomments as $itemcomment){
			$i++;
		}		
		//var_dump($itemcomments);
		if($i > 0){
				try{
					$comment = new Comment001;
					$comment->item = $itemID;
					
					$comment->testData = "100003";
					$comment->user = $userID;
			
					$comment->comment = $commentTxt;
					/*WHICH IS BETTER? Store empty string or copy of first comment for first archive?*/
					//$comment->archivedCommentHistory=array(date('Y-m-d H:i:s')=>$commentTxt);
					$comment->archivedCommentHistory=array(date('Y-m-d H:i:s')=>"");
					$comment->archivedCommentDelta=array(date('Y-m-d H:i:s')=>"");
					
					$comment->save();
					//var_dump($comment);
						$retval = "";
						$msg = "0";
						$status = 200;
						return;
						
						return Response::json(array(
							'data' =>"",
							'error' => "0"
						));
					}catch(Exception $e){
						$retval = "";
						$msg = "COMPILER EXCEPTION: " . $e;
						$status = 404;
						return;
												
						return Response::json(array(
							'data' =>"",
							'error' => "COMPILER EXCEPTION: " . $e
						), 404);
				}		
		}else{
			$retval = "";
			$msg = "ERROR: No such ITEM (" . $itemID .")";
			$status = 404;
			return;
			
			return Response::json(array(
				'data' =>"",
				'error' => "ERROR: No such ITEM (" . $itemID .")"
			), 404);
		}
				

	}

	
	public function DeleteCommentsByItemID($itemID){
		
		$itemcomments = Comment001::where('item', $itemID)->get();
		$i = 0;
		
		foreach ($itemcomments as $itemcomment){
			$i++;
		}
		
		//var_dump($itemcomments);
		

		try{
			Comment001::where('item', $itemID)->delete();
		}catch(Exception $e){
			return Response::json(array(
				'data' =>"",
				'error' => "COMPILER EXCEPTION: " . $e
			), 404);
		}	
		
		if($i > 0){
			return Response::json(array(
				'data' =>"",
				'error' => "0"
			));//Success.  Item exists / no exception.
		}else{
			return Response::json(array(
				'data' =>"",
				'error' => "WARNING (On COMMENT DELETE attempt): No Comments for ITEM (" . $itemID .") "
			), 404);
		}
	}
	
	public function DeleteCommentByCommentID($commentID){
			
		try{
			Comment001::where('_id', $commentID)->delete();
		}catch(Exception $e){
			return Response::json(array(
					'data' =>"",
					'error' => "COMPILER EXCEPTION: " . $e
			), 404);
		}		
		
		return Response::json(array(
				'data' =>"",
				'error' => "0"
		));//Success.  Item exists / no exception.		
		
	}
	
	public function UpdateCurrentCommentByID($commentID, $userID, $newCommentTxt) {
		//KEEP FOR NOW. Useful example.
		//$archives = Comment001::find("53a2fd3e20f553dc000041af", ['archivedCommentHistory'])->archivedCommentHistory;
		//$archives = $archives[1];

			$currentcomment = Comment001::find($commentID);
			//$currentcomment = Comment001::where('_id', $commentID)->get();
			
			$i=0;
			foreach ($currentcomment as $thiscomment){
				$i++;
			}			
			
			//echo("COMMENT COUNT: "  . $i .  "");
			//var_dump($currentcomment);
			//die;
			if($i>0){
				//more-than-0 records; fall thorugh and TRY the update
			}else{
				//$i<1, there are no comments by this ID.
				return Response::json(array(
						'data' =>"",
						'error' => "No Comments for this ID: " . $commentID
				), 404);				
			}

			try{
				$oldcomment = $currentcomment->comment;
				//echo("OLD COMMENT:" . $oldcomment . "\n");
				//die;
				$currentcomment->comment = $newCommentTxt;
				$lclarch  = ($currentcomment->archivedCommentHistory ? $currentcomment->archivedCommentHistory : "NO ARCHIVE"  );
				$lcldelta = ($currentcomment->archivedCommentDelta ? $currentcomment->archivedCommentDelta : "NO DELTAS");
				
				//var_dump($lclarch);
				$curtd = date('Y-m-d H:i:s');
				$lclarch[$curtd] = $oldcomment;//add the newly-archived Previous comment to the end of the local Archive Comments array.
				
				//USE OF DELTA:
				//use true to compare by character.  omit to compare by line
				//Diff::toString, Diff::toHTML and Diff::toTable are available.
				$delta = rtrim(Diff::toString(Diff::compare($oldcomment, $newCommentTxt, true) )) ;
				//echo("DELTA:\n" . $delta . "");
				$lcldelta[$curtd] = $delta; //add the diff() of the new comment and the old comment to the local Archive Deltas array.
				
				//array_push($lclarch, array(date('Y-m-d H:i:s')=>$commentTxt));
				
				//$currentcomment->archivedCommentHistory=array(date('Y-m-d H:i:s')=>$oldcomment);
				
				$currentcomment->archivedCommentHistory=$lclarch; //populate the DB with the up-to-date Archive Comments
				$currentcomment->archivedCommentDelta=$lcldelta; //populate the DB with the up-to-date Archive Deltas
				
				//var_dump($currentcomment);
				
				$currentcomment->save();
			}catch(Exception $e){
				return Response::json(array(
						'data' =>"",
						'error' => "EXCEPTION: " . $e
				), 404);
			}	

			return Response::json(array(
				'data' =>"",
				'error' => "0"
			));//Success.  Item exists / no exception.
	}
	
	function ldiff($old, $new){
		
		return "";
	}
	
}