<h3>Upload Form</h3>

<?php
echo $_SESSION['isAuth'];
if(!isset($_POST['upbtn'])){ ?>
    <form action="index.php?page=2" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="myfile">Select file for upload: </label>
            <input type="hidden" name="MAX_FILE_SIZE" value="30000">
            <input type="file" class="form-control" name="myfile" accept="images/*">

        </div>
        <button type="submit" class="btn btn-primary" name="upbtn">Send file</button>
    </form>
<?} else {
    if(isset($_POST['upbtn'])){
       //обработка ошибок загрузки файлов
        if ($_FILES['myfile']['error'] !=0) {
            echo "<h3><span style='color: red;'>Upload erroe code: {$_FILES['myfile']['error']} </span></h3>";
            exit();
        }
        if(is_uploaded_file($_FILES['myfile']['tmp_name'])) {
            move_uploaded_file($_FILES['myfile']['tmp_name'], "images/{$_FILES['myfile']['name']}");
        } 
        echo "<h3><span style='color: green;'>File is successfully uploaded!</span></h3>";
            
    }
}
?>