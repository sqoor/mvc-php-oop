<?php


class Product
{
    private $conn;
    private $name;
    private $description;
    private $price;
    private $category_id;
    private $created;
    private $modified;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    private function setCreated()
    {
        $date = new DateTime();
        $created_datetime = $date->format('Y-m-d H:i:s');

        $this->created = $created_datetime;
    }


    private function setModified()
    {
        $date = new DateTime();
        $modified_timestamp = $date->format('Y-m-d H:i:s');

        $this->modified = $modified_timestamp;
    }

    function create()
    {
        $this->setCreated();

        $sql = "INSERT INTO products(name, price, description, created, category_id) 
                    VALUES('$this->name', $this->price, '$this->description', '$this->created', $this->category_id)";

        return $this->conn->exec($sql);
    }

    function getAll()
    {
        $query = $this->conn->prepare("select products.*, categories.name as category from products inner join categories on products.category_id = categories.id");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function delete($id)
    {
        $query = "DELETE FROM products WHERE id = $id";
        $result = $this->conn->exec($query);

        return $result;
    }

    function getOne($id)
    {
        $query = $this->conn->prepare("SELECT * FROM products WHERE id = $id");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result[0];
    }

    function updateOne($id)
    {
        $this->setModified();

        $query = "UPDATE products
                    SET
                        name = '$this->name',
                        description = '$this->description',
                        price = $this->price,
                        category_id = $this->category_id,
                        modified = '$this->modified'
                    WHERE id = $id";

        $result = $this->conn->exec($query);

        return $result;
    }

    // NOTE: create setters and getters shortcut: alt - insert - getters and setters

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }
}