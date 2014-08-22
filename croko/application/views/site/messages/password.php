<?  $this->load->view('template/header-cms'); ?>


<body>

<?			
	$attributes = array('class' => 'contact-form', 'id' => 'myform');
	echo form_open("admin/password/$type/$id",$attributes);
		
?>

	<h2>תוכן זה מוגן סיסמה, יש להזין סיסמת כניסה</h2>

	<input type="hidden" name="id" value="<?=$id;?>">
			
	<input type="password" name="password"> 
	<input type="submit" value="כניסה">


</form>

</body>


</html>