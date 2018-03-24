<?php

class product_cat extends Main
{
    //hàm add
    function index($id = "")
    {
        //tạo đối tượng model Product_cat, liên kết với bảng product_cat
        $this->loadModel('Product_cats');

        //kiểm tra có dữ liệu post để lưu không ?
        if (isset($_POST['data'])) {
            //lấy dữ liệu submit lên vào biến data
            $data = $_POST['data'];

            //dùng hàm save của đối tượng Product_cat để lưu dư liệu vào bảng product_cat
            $this->Product_cats->save($data);

            //dùng hàm redirect của đối tượng $this để chuyển về hàm index
            $this->redirect("/product_cat/index");
        }


        //truy vấn dữ liệu sản phẩm hiện tại theo id để đưa vào form nhập sản phẩm
        $array_edit_product_cat = null;
        if ($id != "") {
            //gọi hàm find của đối tượng Product để truy vấn tất cả dữ liệu từ bảng product, đưa vào mảng $array_edit_product
            $array_edit_product_cat = $this->Product_cats->find("all", array("conditions" => "id='$id'"));
        }

        $tensp = "";
        $masp = "";

        if (isset($_GET['tensp']) && isset($_GET['masp'])) {
            $tensp = $_GET['tensp'];
            $masp = $_GET['masp'];
        }

        //gọi hàm find của đối tượng Product_cat để truy vấn tất cả dữ liệu từ bảng product_cats, đưa vào mảng $array_product_cat
        $array_product_cat = $this->Product_cats->find("all", array("conditions" => "name LIKE '%$tensp%' AND code LIKE '%$masp%'"));


        //dùng hàm render của đối tượng View để truy cập tới file nhập sản phẩm: add_product2.php , trả về kết quả biến html
        $html_result = $this->View->render("line_product_cat.php",
            array("array_edit_product_cat" => $array_edit_product_cat, "array_product_cat" => $array_product_cat, "tensp" => $tensp, "masp" => $masp));
        echo $html_result;
    }

    //hàm del
    function del($id = "")
    {
        if ($id != "") {
            // xóa sản phẩm theo id
            $this->loadModel("Product_cats");
            $this->Product_cats->delete($id);

            // chuyển về trang index

            $this->redirect("/product_cat/index.html");
        }
    }

    function detail($id_product_cat = "", $id_product_cat_detail = "")
    {
        //tạo đối tượng model Product_cat, liên kết với bảng product_cat
        $this->loadModel("Product_cat_detail", "product_cat_details");
        $this->loadModel("Product_cats", "product_cats");
        $this->loadModel("ProductDetail", "product_detail");

        //kiểm tra có dữ liệu post để lưu không ?
        if (isset($_POST['data'])) {
            //lấy dữ liệu submit lên vào biến data
            $data = $_POST['data'];

            $data["id_product_cat"] = $id_product_cat;

            $product_cat_name = $this->Product_cats->get_value(array("fields" => "name", "conditions" => "id = $id_product_cat"));

            $data["product_cat"] = $product_cat_name;
            $code = $data["code"];

            //dùng hàm save của đối tượng Product_cat để lưu dư liệu vào bảng product_cat
            $this->Product_cat_detail->save($data);

            //dùng hàm redirect của đối tượng $this để chuyển về hàm index
            $this->redirect("/product_cat/detail/$id_product_cat");
        }


        //chức năng sửa
        $array_edit_detail_product_cat = null;
        if ($id_product_cat_detail != "") {
            $array_edit_detail_product_cat = $this->Product_cat_detail->find("all", array("conditions" => "id='$id_product_cat_detail'"));
        }

        //truy vấn dữ liệu sản phẩm hiện tại theo id để đưa vào form nhập sản phẩ

        //gọi hàm find của đối tượng Product_cat để truy vấn tất cả dữ liệu từ bảng product_cats, đưa vào mảng $array_product_cat
        $array_product_cat = $this->Product_cat_detail->find("all", array("conditions" => "id_product_cat = $id_product_cat", "order" => "id ASC"));

        $product_cat_name = $this->Product_cats->get_value(array("fields" => "name", "conditions" => "id = $id_product_cat"));

        $array_param = array(
            "array_product_cat" => $array_product_cat,
            "id_product_cat" => $id_product_cat,
            "product_cat_name" => $product_cat_name,
            "array_edit_detail_product_cat" => $array_edit_detail_product_cat,
        );

        //dùng hàm render của đối tượng View để truy cập tới file nhập sản phẩm: add_product2.php , trả về kết quả biến html
        $html_result = $this->View->render("detail_product_cat.php", $array_param);
        echo $html_result;

    }

    function del_detail($id_product_cat = "", $id_product_detail = "")
    {
        if ($id_product_detail != "") {
            // xóa sản phẩm theo id
            $this->loadModel("Product_cat_detail", "product_cat_details");
            $this->Product_cat_detail->delete($id_product_detail);

            // chuyển về trang index

            $this->redirect("/product_cat/detail/$id_product_cat.html");
        }
    }

    function import($id_product_cat = "")
    {
        $this->loadModel("Product", "products");
        $this->loadModel("ProductCat", "product_cats");
        $this->loadModel("ProductMachine", "product_machines");
        $this->loadModel("ProductRate", "product_rates");
        $this->loadModel("ProductUser", "product_users");
        $this->loadModel("Customer", "customers");
        $this->loadModel("Factory", "factorys");
        $this->loadModel("Manufactory", "manufactorys");
        $this->loadModel("Machine", "machines");
        $this->loadModel("Material", "material");
        $this->loadModel("Factory", "factorys");

        if (isset($_GET["file"])) {
            $file = $_GET["file"];

            //đọc file excel và lưu vào CSDL
            $this->loadLib("Excel", "excel");

            //mở file excel
            $excel_file = $this->root_folder . "files/" . $this->Company->upload_folder . "/" . $file;
            $data = $this->Excel->open($excel_file);
            //print_r($data);
            // lay so hang cua sheet
            $rowsnum = $data->rowcount($sheet_index = 0);

            // lay so cot cua sheet
            $colsnum = $data->colcount($sheet_index = 0);

            /*
            for ($i = 2; $i <= $rowsnum; $i++)
            {
                $array_material = null;
                $array_material["code"] = $data->val($i, 2);
                $array_material["name"] = $data->val($i, 3);
                $array_material["quota"] = $data->val($i, 4);

                $name = $array_material["name"];
                $code = $array_material["code"];
                $array_material_check = $this->Material->find("all",array("fields"=>"name, code"));
                $material_name = "";
                $material_code = "";
                $material_name = $this->Material->get_value(array("fields"=>"name","conditions"=>"name='$name'"));
                $material_code = $this->Material->get_value(array("fields"=>"code","conditions"=>"code='$code'"));
                if($material_name != "" && $material_code != "")
                    continue;
                $this->Material->save($array_material);
            }
            */
            $id_factory = "";
            $factory = "";
            if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
                $id_factory = $_GET["id_factory"];
                $factory = $this->Factory->get_value(array("fields" => "name", "conditions" => "id =  '$id_factory'"));
            }
            //Dòng Vacuum
            if ($id_product_cat == 1) {
                for ($i = 4; $i <= $rowsnum; $i++) {
                    //========================================================
                    //BEGIN: Lưu thông tin sản phẩm
                    //

                    $array_product["id_factory"] = $id_factory;
                    $array_product["factory"] = $factory;
                    $array_product["id_cat"] = $id_product_cat;
                    $array_product["cat_name"] = $this->ProductCat->get_value(array("fields" => "name", "conditions" => "`id` = '$id_product_cat'"));

                    $array_product["barcode"] = $data->val($i, 2);
                    $array_product["code"] = $data->val($i, 3);
                    $array_product["name"] = $data->val($i, 4);
                    //lấy thông tin khách hàng
                    $array_product["customer"] = $data->val($i, 5);
                    $customer = $array_product["customer"];
                    $array_product["id_customer"] = $this->Customer->get_value(array("fields" => "id", "conditions" => "`fullname` = '$customer'"));

                    //lấy thông tin xưởng
                    $array_product["manufactory"] = $data->val($i, 7);
                    $manufactory = $array_product["manufactory"];
                    $array_product["id_manufactory"] = $this->Manufactory->get_value(array("fields" => "id", "conditions" => "`name` = '$manufactory'"));

                    $this->Product->save($array_product);
                    //
                    //END: lưu thông tin sản phẩm
                    //=======================================================

                    $id_product_max = $this->Product->get_value(array("fields" => "MAX(id)"));
                    $product_name_max = $this->Product->get_value(array("fields" => "name", "conditions" => "`id` = '$id_product_max'"));
                    $product_code_max = $this->Product->get_value(array("fields" => "code", "conditions" => "`id` = '$id_product_max'"));
                    //=======================================================
                    //BEGIN: lưu thông tin CycleTime

                    $array_cycletime = null;
                    //lấy id mới nhất vừa mới lưu
                    $array_cycletime["id_product"] = $id_product_max;
                    $array_cycletime["product_name"] = $product_name_max;
                    $array_cycletime["product_code"] = $product_code_max;

                    //lấy thông tin máy
                    $array_cycletime["machine_control"] = $data->val($i, 23);
                    $machine = $array_cycletime["machine_control"];
                    $array_cycletime["id_machine"] = $this->Machine->get_value(array("fields" => "id", "conditions" => "`control` lIKE '%$machine%'"));
                    $array_cycletime["cavity"] = $data->val($i, 9);
                    $array_cycletime["cycletime"] = $data->val($i, 10);
                    $this->ProductMachine->save($array_cycletime);

                    //End: lưu thông tin CycleTime ==========================
                    //=======================================================

                    //BEGIN: lưu thông tin ĐỊNH MỨC VẬT TƯ ==================
                    //=======================================================

                    $array_product_rate = null;
                    $array_product_rate["id_product"] = $id_product_max;
                    $array_product_rate["product_name"] = $product_name_max;
                    $array_product_rate["product_code"] = $product_code_max;
                    $array_product_rate["material_code_bar"] = $data->val($i, 11);
                    $array_product_rate["material_code"] = $data->val($i, 12);
                    $array_product_rate["material_name"] = $data->val($i, 13);
                    $array_product_rate["price"] = $data->val($i, 14);
                    $array_product_rate["unit"] = $data->val($i, 15);
                    $array_product_rate["quota"] = $data->val($i, 16);
                    $this->ProductRate->save($array_product_rate);

                    //End: lưu thông tin ĐỊNH MỨC VẬT TƯ ====================
                    //=======================================================

                }//END: for ($i = 3; $i <= $rowsnum; $i++)
            }

            //END: DÒNG VACUUM ***********************************************


            //BEGIN: DÒNG MOLDING
            if ($id_product_cat == 4) {
                for ($i = 4; $i <= $rowsnum; $i++) {
                    //========================================================
                    //BEGIN: Lưu thông tin sản phẩm
                    //
                    $array_product["id_factory"] = $id_factory;
                    $array_product["factory"] = $factory;
                    $array_product["id_cat"] = $id_product_cat;
                    $array_product["cat_name"] = $this->ProductCat->get_value(array("fields" => "name", "conditions" => "`id` = '$id_product_cat'"));

                    $array_product["barcode"] = $data->val($i, 2);
                    $array_product["code"] = $data->val($i, 3);
                    $array_product["name"] = $data->val($i, 4);

                    //lấy thông tin khách hàng
                    $array_product["customer"] = $data->val($i, 5);
                    $customer = $array_product["customer"];
                    $array_product["id_customer"] = $this->Customer->get_value(array("fields" => "id", "conditions" => "`fullname` = '$customer'"));

                    //lấy thông tin xưởng
                    $array_product["manufactory"] = $data->val($i, 7);
                    $manufactory = $array_product["manufactory"];
                    $array_product["id_manufactory"] = $this->Manufactory->get_value(array("fields" => "id", "conditions" => "`name` = '$manufactory'"));

                    $this->Product->save($array_product);
                    //
                    //END: lưu thông tin sản phẩm
                    //=======================================================

                    $id_product_max = $this->Product->get_value(array("fields" => "MAX(id)"));
                    $product_name_max = $this->Product->get_value(array("fields" => "name", "conditions" => "`id` = '$id_product_max'"));
                    $product_code_max = $this->Product->get_value(array("fields" => "code", "conditions" => "`id` = '$id_product_max'"));
                    //=======================================================
                    //BEGIN: lưu thông tin CycleTime

                    $array_cycletime = null;
                    //lấy id mới nhất vừa mới lưu
                    $array_cycletime["id_product"] = $id_product_max;
                    $array_cycletime["product_name"] = $product_name_max;
                    $array_cycletime["product_code"] = $product_code_max;

                    //lấy thông tin máy
                    $array_cycletime["machine_control"] = $data->val($i, 8);
                    $machine = $array_cycletime["machine_control"];
                    $array_cycletime["id_machine"] = $this->Machine->get_value(array("fields" => "id", "conditions" => "`name` = '$machine'"));
                    $array_cycletime["cavity"] = $data->val($i, 9);
                    $array_cycletime["cycletime"] = $data->val($i, 10);
                    $this->ProductMachine->save($array_cycletime);

                    //End: lưu thông tin CycleTime ==========================
                    //=======================================================

                    //BEGIN: lưu thông tin ĐỊNH MỨC VẬT TƯ ==================
                    //=======================================================

                    $array_product_rate = null;
                    $array_product_rate["id_product"] = $id_product_max;
                    $array_product_rate["product_name"] = $product_name_max;
                    $array_product_rate["product_code"] = $product_code_max;
                    $array_product_rate["material_code_bar"] = $data->val($i, 11);
                    $array_product_rate["material_code"] = $data->val($i, 12);
                    $array_product_rate["material_name"] = $data->val($i, 13);
                    $array_product_rate["price"] = $data->val($i, 14);
                    $array_product_rate["unit"] = $data->val($i, 15);
                    $array_product_rate["quota"] = $data->val($i, 16);
                    $this->ProductRate->save($array_product_rate);

                    //End: lưu thông tin ĐỊNH MỨC VẬT TƯ ====================
                    //=======================================================

                }//END: for ($i = 3; $i <= $rowsnum; $i++)
            } //END: DÒNG MOLDING

            else {
                for ($i = 4; $i <= $rowsnum; $i++) {
                    //========================================================
                    //BEGIN: Lưu thông tin sản phẩm
                    //
                    $array_product["id_factory"] = $id_factory;
                    $array_product["factory"] = $factory;
                    $array_product["id_cat"] = $id_product_cat;
                    $array_product["cat_name"] = $this->ProductCat->get_value(array("fields" => "name", "conditions" => "`id` = '$id_product_cat'"));

                    $array_product["barcode"] = $data->val($i, 2);
                    $array_product["code"] = $data->val($i, 3);
                    $array_product["name"] = $data->val($i, 4);

                    //lấy thông tin khách hàng
                    $array_product["customer"] = $data->val($i, 5);
                    $customer = $array_product["customer"];
                    $array_product["id_customer"] = $this->Customer->get_value(array("fields" => "id", "conditions" => "`fullname` = '$customer'"));

                    //lấy thông tin xưởng
                    $array_product["manufactory"] = $data->val($i, 7);
                    $manufactory = $array_product["manufactory"];
                    $array_product["id_manufactory"] = $this->Manufactory->get_value(array("fields" => "id", "conditions" => "`name` = '$manufactory'"));

                    $this->Product->save($array_product);
                    //
                    //END: lưu thông tin sản phẩm
                    //=======================================================

                    $id_product_max = $this->Product->get_value(array("fields" => "MAX(id)"));
                    $product_name_max = $this->Product->get_value(array("fields" => "name", "conditions" => "`id` = '$id_product_max'"));
                    $product_code_max = $this->Product->get_value(array("fields" => "code", "conditions" => "`id` = '$id_product_max'"));
                    //=======================================================
                    //BEGIN: lưu thông tin CycleTime

                    $array_cycletime = null;
                    //lấy id mới nhất vừa mới lưu
                    $array_cycletime["id_product"] = $id_product_max;
                    $array_cycletime["product_name"] = $product_name_max;
                    $array_cycletime["product_code"] = $product_code_max;

                    //lấy thông tin máy
                    $array_cycletime["machine_control"] = $data->val($i, 8);
                    $machine = $array_cycletime["machine_control"];
                    $array_cycletime["id_machine"] = $this->Machine->get_value(array("fields" => "id", "conditions" => "`name` = '$machine'"));
                    $array_cycletime["cavity"] = $data->val($i, 9);
                    $array_cycletime["cycletime"] = $data->val($i, 10);
                    $this->ProductMachine->save($array_cycletime);

                    //End: lưu thông tin CycleTime ==========================
                    //=======================================================

                    //BEGIN: lưu thông tin ĐỊNH MỨC VẬT TƯ ==================
                    //=======================================================

                    $array_product_rate = null;
                    $array_product_rate["id_product"] = $id_product_max;
                    $array_product_rate["product_name"] = $product_name_max;
                    $array_product_rate["product_code"] = $product_code_max;
                    $array_product_rate["material_code_bar"] = $data->val($i, 11);
                    $array_product_rate["material_code"] = $data->val($i, 12);
                    $array_product_rate["material_name"] = $data->val($i, 13);
                    $array_product_rate["price"] = $data->val($i, 14);
                    $array_product_rate["unit"] = $data->val($i, 15);
                    $array_product_rate["quota"] = $data->val($i, 16);
                    $this->ProductRate->save($array_product_rate);

                    //End: lưu thông tin ĐỊNH MỨC VẬT TƯ ====================
                    //=======================================================

                }//END: for ($i = 3; $i <= $rowsnum; $i++)
            }
            //END: DÒNG
        }

        $array_factory = array("" => array("id" => "", "name" => "..."));
        $array_factory += $this->Factory->find("all", array("fields" => "id,name"));

        $html = $this->View->render("import_product.php", array("id_product_cat" => $id_product_cat, "array_factory" => $array_factory));
        echo $html;
    }

}//end_class
?>