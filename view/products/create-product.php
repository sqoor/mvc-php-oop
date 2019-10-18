<?php
include "../../database/Database.php";
include "../layout/header.php";
include "../../model/Product.php";
include "../../model/Category.php";


// connect to database
$db = new Database();
$conn = $db->connect();


$category = new Category($conn);
$categories = $category->getAll();


$is_created_new_products = "";

if (isset($_POST['add-product'])) {

    $product = new Product($conn);
    $product->setName($_POST['name']);
    $product->setPrice($_POST['price']);
    $product->setDescription($_POST['description']);
    $product->setCategoryId($_POST['category-id']);
    $is_created_new_products = $product->create();
}
?>
    <div class="container mt-3 w-75">
        <h2 class="text-muted text-center">Add product</h2>
        <?php
        if ($is_created_new_products != "") {
            if ($is_created_new_products) {
                echo "<div class='alert alert-success'>Product was created.</div>";
            } else {
                echo "<div class='alert alert-warning'>Unable to create a new product.</div>";
            }
        }
        ?>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <fieldset class="form-group">
                <legend class="col-form-label col-sm-2 pt-0 text-muted font-weight-bold text-center mb-3"></legend>
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp"
                           placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input name="description" type="text" class="form-control" id="description"
                           aria-describedby="emailHelp"
                           placeholder="Enter description">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input name="price" type="number" min="1" class="form-control" id="price"
                           aria-describedby="emailHelp"
                           placeholder="Enter price">
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category-id" id="category" class="custom-select mb-3">
                        <option selected>Category</option>
                        <option value="what will be send to database">Name showed to user</option>
                        <?php
                        foreach ($categories as $row) {
                            $id = $row['id'];
                            $name = $row['name'];

                            echo "<option value='$id' class='text-capitalize'>$name</option>";
                        }
                        ?>
                    </select>

                </div>
            </fieldset>

            <button name="add-product" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php include "../layout/footer.php" ?>