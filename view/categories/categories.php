<?php
include "../layout/header.php";
include "../../database/Database.php";
include "../../model/Category.php";

$db = new Database();
$conn = $db->connect();

$category = new Category($conn);
$categories = $category->getAll();

if (isset($_POST['delete-category'])) {
    $category_id = $_POST['delete-id'];
    $is_deleted = $category->delete($category_id);

    if ($is_deleted) {
        $categories = $category->getAll();
        echo "Deleted Records";
    }
}

?>

    <div class="container">
        <h2 class="text-muted text-center">Categories</h2>

        <table class="table m-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Created</th>
                <th scope="col">Modified</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $number = 0;
            foreach ($categories as $row) {
                $number++;
                $id = $row['id'];
                $name = $row['name'];
                $created = $row['created'];
                $modified = $row['modified'];
                echo "
                    <tr>
                        <th scope=\"row\">$number</th>
                        <td>$id</td>
                        <td>$name</td>
                        <td>$created</td>
                        <td>$modified</td>
                        <td>
                            <form action='' method='POST'>
                                <input type='hidden' name='delete-id' value='$id'>
                                <button type='submit' name='delete-category' class='btn btn-outline-danger'>X</button>
                            </form>
                        </td>
                        <td>
                            <form action='./update-category.php' method='POST'>
                                <input type='hidden' name='update-id' value='$id'>
                                <button type='submit' name='go-update-category' class='btn btn-outline-warning'>Edit</button>
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