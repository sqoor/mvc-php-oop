<?php


class Category
{
    private $conn;
    private $name;
    private $created;
    private $modified;

    /**
     * Category constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    /**
     * @param mixed $created
     */
    private function setCreated()
    {
        $date = new DateTime();
        $created_datetime = $date->format('Y-m-d H:i:s');

        $this->created = $created_datetime;
    }


    function create()
    {
        $this->setCreated();

        $query = "INSERT INTO categories (name, created) VALUES ('$this->name', '$this->created')";
        $result = $this->conn->exec($query);

        return $result;
    }

    function getAll()
    {
        $query = $this->conn->prepare("SELECT id, name, modified, created FROM categories");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function delete($id)
    {
        $query = "DELETE FROM categories WHERE id = $id";
        $result = $this->conn->exec($query);

        return $result;
    }

    function getOne($id)
    {
        $query = $this->conn->prepare("SELECT * FROM categories WHERE id = $id");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result[0];
    }


    function updateOne($id)
    {
        $this->setModified();

        $query = "UPDATE categories
                    SET
                        name = '$this->name',
                        modified = '$this->modified'
                    WHERE id = $id";

        $result = $this->conn->exec($query);

        return $result;
    }


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
    public function getCreated()
    {
        return $this->created;
    }

    private function setModified()
    {
        $date = new DateTime();
        $modified_datetime = $date->format('Y-m-d H:i:s');

        $this->modified = $modified_datetime;
    }
}