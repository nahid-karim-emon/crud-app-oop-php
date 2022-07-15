<?php
class crudApp
{
    private $con;
    public function __construct()
    {
        #database host,database user database,database pass,database name
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = "";
        $dbname = 'crudapp';

        $this->con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        if (!$this->con) {
            die("Database Connection Error!!");
        }
    }

    public function addData($data)
    {
        $name = $data['_name'];
        $roll = $data['_roll'];
        $image = $_FILES['_img']['name'];
        $tmpName = $_FILES['_img']['tmp_name'];

        $query = "INSERT INTO students(name,roll,image) VALUE('$name',$roll,'$image')";
        if (mysqli_query($this->con, $query)) {
            move_uploaded_file($tmpName, 'upload/' . $image);
            return "Information Added Successfully!!";
        }
    }

    public function display()
    {
        $query = "SELECT * FROM students";
        if (mysqli_query($this->con, $query)) {
            $returnData = mysqli_query($this->con, $query);
            return $returnData;
        }
    }

    public function display_by_id($id)
    {
        $query = "SELECT * FROM students WHERE id=$id";
        if (mysqli_query($this->con, $query)) {
            $returnData = mysqli_query($this->con, $query);
            $studentData = mysqli_fetch_assoc($returnData);
            return $studentData;
        }
    }

    public function update_data($data)
    {
        $std_name = $data['u_name'];
        $std_roll = $data['u_roll'];
        $st_id = $data['std_id'];
        $std_img = $_FILES['u_img']['name'];
        $std_tmpName = $_FILES['u_img']['tmp_name'];

        $query = "UPDATE students SET name='$std_name',roll=$std_roll,image='$std_img' WHERE id=$st_id";

        if (mysqli_query($this->con, $query)) {
            move_uploaded_file($std_tmpName, 'upload/' . $std_img);
            return "Information Updated Successfully!!";
        }
    }

    public function delete_data($id)
    {
        $imgloc = "SELECT * FROM students WHERE id=$id";
        $imginfo = mysqli_query($this->con, $imgloc);
        $imgdif = mysqli_fetch_assoc($imginfo);
        $imgaddress = $imgdif['image'];
        $query = "DELETE FROM students WHERE id=$id";
        if (mysqli_query($this->con, $query)) {
            unlink('upload/' . $imgaddress);
            return "Successfully Deleted!!";
        }
    }
}
