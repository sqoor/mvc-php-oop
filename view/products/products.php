<?php
include "../layout/header.php";
include "../../database/Database.php";
include "../../model/Product.php";

$db = new Database();
$conn = $db->connect();

$product = new Product($conn);
$products = $product->getAll();

if (isset($_POST['delete-product'])) {
    $category = $_POST['delete-id'];
    $is_deleted = $product->delete($category);

    if ($is_deleted) {
        $products = $product->getAll();
        echo "Deleted Records";
    }
}
?>

<div class="container">
    <h2 class="text-muted text-center">Products</h2>

    <table class="table m-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Created</th>
            <th scope="col">Modified</th>
            <th scope="col">Category</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $number = 0;

        foreach ($products as $row) {
            $number++;
            $id = $row['id'];
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $created = $row['created'];
            $modified = $row['modified'];
            $category = $row['category'];
            $category_id = $row['category_id'];

            echo "
                      <tr>
                        <th scope=\"row\">$number</th>
                        <td>$id</td>
                        <td>$name</td>
                        <td>$description</td>
                        <td>$price</td>
                        <td>$created</td>
                        <td>$modified</td>
                        <td>$category</td>
                        <td>
                            <form action='' method='POST'>
                                <input type='hidden' name='delete-id' value='$id'>
                                <button type='submit' name='delete-product' class='btn btn-outline-danger'>X</button>
                            </form>
                        </td>
                        <td>
                            <form action='./update-product.php' method='POST'>
                                <input type='hidden' name='product-id' value='$id'>
                                <button type='submit' name='go-update-product' class='btn btn-outline-warning'>update</button>
                            </form>
                        </td>
                    </tr>
                    ";
        }
        ?>
        </tbody>
    </table>
</div>

<?php
include "../layout/footer.php";
?>


