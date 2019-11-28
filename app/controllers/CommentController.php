<?php 
namespace App\Controllers;


use App\Models\Comment;

class CommentController
{
	
	// list
	public function listComment(){	
		$comments = Comment::all();
		
		include_once './app/views/backend/comments/list.php';
	}
	// edit
	public function editComment(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$comment = Comment::where(['id','=',$id])->first();
		if(!$comment){
			header('location: ' . ADMIN_URL);
        	die;
		}
		include_once './app/views/backend/comments/edit.php';
	}

	public function editSaveComment()
	{
		$id = isset($_POST['id']) == true ? $_POST['id'] : "";
		dd($id);
		$status = isset($_POST['status']) == true ? $_POST['status'] : "";
		$data = compact('show_menu');
		$model = new Comment();
		$model = Comment::where(['id', '=', $id])->first();
		$model->update($data);
		header("Location: ../commnent/list.php");
	}
	
}

 ?>