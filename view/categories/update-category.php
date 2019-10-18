<?php
include "../layout/header.php";
include "../../database/Database.php";
include "../../model/Category.php";

$db = new Database();
$conn = $db->connect();
$category = new Category($conn);

$to_update_id = "";
$to_update_name = "";

if(isset($_POST['go-update-category'])) {
    $to_update_id = $_POST['update-id'];
    $to_update_category = $category->getOne($to_update_id);
    $to_update_name = $to_update_category['name'];
}

if(isset($_POST['update-category'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category->setName($name);

    $has_updated_successfully = $category->updateOne($id);

    if($has_updated_successfully) {
        header("Location: ./categories.php");
    }
}

?>

<div class="container mt-3 w-75">
    <h2 class="text-muted text-center">Update Category</h2>
    <form method="POST">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $to_update_id?>">
            <label for="name">Name</label>
            <input value="<?php echo $to_update_name?>" name="name" type="name" class="form-control" id="name" aria-describedby="name"
                   placeholder="Enter name">
        </div>
        <button name="update-category" type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>

<?php include "../layout/footer.php"; ?>
