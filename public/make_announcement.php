<?php 

include('../includes/core/initialize.php');


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $announcement =  new Announcement();
    $announcement->set_field("title", $_POST['title']);
    $announcement->set_field("message", $_POST['message']);
    $announcement->set_field("author", $_POST['author']);
    $date = strftime("%Y-%m-%d", time());
    $announcement->set_field("date_published", $date);

    $file_info = pathinfo($_FILES["image"]["name"]);
    $ext=$file_info['extension'];
    $image_name="img_".rand(1000, 9999).".".$ext;
    $announcement->set_field("image", $image_name);

    $uploadpath = "./images/".$image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadpath) && 
        $announcement->create()) {
        header("location:../../final_proj_admin1/public/index.php?page=make_ann&status=success");
    } else {
        header("location:../../final_proj_admin1/public/index.php?page=make_ann&status=fail");
    }
} else {
    header("location:../../final_proj_admin1/public/index.php?page=make_ann&status=fail");
}
?>