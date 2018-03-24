<?php

class product2 extends Main
{
    function add2($id = "")
    {
        $this->loadModel('Product');
        $this->loadModel("Customer", "customers");
        $this->loadModel("Product_cat", "product_cats");
        $this->loadModel("Product_fee", "product_fees");
        $this->loadModel("Product_cat_detail", "product_cat_details");
        $this->loadModel("ProductDetail", "product_detail");
        $this->loadModel("Customer", "customers");
        $this->loadModel("Factory");
        $this->loadModel("Manufactory");

        $id_edit_product = $id;

        //kiểm tra có dữ liệu post để lưu không ?
        if (isset($_GET['data'])) {
            //lấy dữ liệu submit lên vào biến data
            $array_data = $_GET['data'];
            $array_data["id_cat"] = $_GET["id_line"];

            $id_factory = $_GET["id_factory"];
            $array_data["id_factory"] = $_GET["id_factory"];
            $array_data["factory"] = $this->Factory->get_value(array("fields" => "name", "conditions" => "id='$id_factory'"));

            $id_manufactory = $_GET["id_manufactory"];
            $array_data["id_manufactory"] = $_GET["id_manufactory"];
            $array_data["manufactory"] = $this->Manufactory->get_value(array("fields" => "name", "conditions" => "id='$id_manufactory'"));

            //lấy giá trị của phần tử id_customer
            $id_customer = $array_data['id_customer'];

            //lấy giá trị của phần tử id_line
            $id_cat = $_GET["id_line"];

            //lấy tên name từ bảng Customer where id = $id_customer
            $array_customer_name = $this->Customer->find("all", array("conditions" => "id = '$id_customer'"));
            $array_data['customer'] = $array_customer_name[0]['fullname'];

            //lấy tên name từ bảng product_cats where id = $id_cats
            $array_line_name = $this->Product_cat->find("all", array("conditions" => "id = '$id_cat'"));
            $array_data['cat_name'] = $array_line_name[0]['name'];


            if ($array_data['status'] == 1) {


                $this->Product->save($array_data);


                //BEGIN: lưu vào bảng product_detail
                //lấy id_product vua moi luu ở bảng product để lưu vào bảng product_detail

                $id_product = $this->Product->get_value(array("fields" => "MAX(id)"));
                if (isset($_GET["data_detail"])) {
                    $data_detail = $_GET["data_detail"];
                    $data_detail["id_product"] = $id_product;

                    // tạo mảng để lưu vào bảng product_detail
                    $array_data = null;
                    $array_data["id_product"] = $id_product;

                    //truy vấn dữ liệu bảng product_cat_detail theo id_product_cat truyền lên(id dong sản phẩm)
                    $array_product_cat_detail = $this->Product_cat_detail->find("all", array("conditions" => "id_product_cat = '$id_cat'"));


                    if ($array_product_cat_detail) {

                        $num = 0;
                        foreach ($array_product_cat_detail as $product_cat_detail) {

                            //BEGIN: Lấy name submit lên
                            $code = $product_cat_detail["code"];
                            $name = $product_cat_detail["name"];
                            //END: lấy name submit lên

                            //
                            $array_data["code"] = $code;
                            $array_data["name"] = $name;

                            $value = $data_detail["$code"];
                            $array_data["value"] = $value;

                            //lấy phần tử id từ mảng submit lên, để lất phần tử id
                            if (isset($data_detail[$num]["id"])) $array_data["id"] = $data_detail[$num]["id"];

                            //print_r($array_data);
                            $this->ProductDetail->save($array_data);
                            $num++;
                        }
                    }
                }

                $this->redirect("/product2/index");
            }
        }

        //dùng hàm find của đối tượng Customer đọc dữ liệu từ bảng customers
        $array_customer = array("" => array("id" => "", "name" => "Chọn khách hàng"));
        $array_customer += $this->Customer->find("all", array("fields" => "id, fullname"));

        //dùng hàm find của đối tượng Produc_cat đọc dữ liệu từ bảng product_cats
        $array_line = array("" => array("id" => "", "name" => "Chọn dòng sản phẩm"));
        $array_line += $this->Product_cat->find("all", array("fields" => "id, name"));

        //BEGIN: CN sửa
        //truy vấn dữ liệu sản phẩm hiện tại theo id để đưa vào form nhập sản phẩm
        $array_edit_product = null;
        if ($id != "") {
            //gọi hàm find của đối tượng Product để truy vấn tất cả dữ liệu từ bảng product, đưa vào mảng $array_edit_product
            $array_edit_product = $this->Product->find("all", array("conditions" => "id='$id'"));
        }

        //END: CN sửa

        $dk = "";
        $id_line = "";
        if (isset($_GET["id_line"]) && $_GET["id_line"] != "") $id_line = $_GET["id_line"];

        //truy vấn lấy thuộc tính sản phẩm
        $array_product_cat_detail = $this->Product_cat_detail->find("all", array("conditions" => "id_product_cat = '$id_line'", "order" => "id ASC"));
        if ($id != "") {
            $array_product_cat_detail = $this->ProductDetail->find("all", array("conditions" => "id_product='$id'"));
        }

        //Truy vấn bảng factỏy để hiển thị lên selecbox nhà máy
        $array_factory = array("" => array("id" => "", "name" => "Chọn nhà máy"));
        $array_factory += $this->Factory->find("all", array("fields" => "id, name"));

        //Truy vấn bảng manufactory để hiển thị lên selecbbox xưởng
        $array_manufactory = array("" => array("id" => "", "name" => "Chọn xưởng"));
        $array_manufactory += $this->Manufactory->find("all", array("fields" => "id, name"));

        $array_param = array("array_edit_product" => $array_edit_product,
            "array_customer" => $array_customer,
            "array_line" => $array_line,
            "array_product_cat_detail" => $array_product_cat_detail,
            "id_line" => $id_line,
            "id_edit_product" => $id_edit_product,
            "array_factory" => $array_factory,
            "array_manufactory" => $array_manufactory,
        );

        $html_result = $this->View->render("add_product2.php", $array_param);
        echo $html_result;


    }

    function index()
    {
        //tạo đối tượng model Product, liên kết với bảng products
        $this->loadModel('Product');
        $this->loadModel("Factory");
        $this->loadModel("Manufactory");
        $this->loadModel("ProductCat", "product_cats");

        $dk = "";
        $id = "";

        $product_name = "";
        if (isset($_GET["product_name"]) && $_GET["product_name"] != "") {
            $product_name = $_GET["product_name"];

            $dk .= "name LIKE '%$product_name%' OR code LIKE '%$product_name%'";
        }

        if (isset($_GET["name"]) && $_GET["name"] != "") {
            $id = $_GET["name"];
            if ($dk != "") $dk .= " AND ";
            $dk .= " id = '$id'";
        }
        $id_factory = "";
        if (isset($_GET["id_factory"]) && $_GET["id_factory"] != "") {
            $id_factory = $_GET["id_factory"];
            if ($dk != "") $dk .= " AND ";
            $dk .= " id_factory = '$id_factory'";
        }

        $id_manufactory = "";
        if (isset($_GET["id_manufactory"]) && $_GET["id_manufactory"] != "") {
            $id_manufactory = $_GET["id_manufactory"];
            if ($dk != "") $dk .= " AND ";
            $dk .= "id_manufactory = '$id_manufactory'";
        }

        $id_product_cat = "";
        if (isset($_GET["id_product_cat"]) && $_GET["id_product_cat"] != "") {
            $id_product_cat = $_GET["id_product_cat"];
            if ($dk != "") $dk .= " AND ";
            $dk .= " id_cat = '$id_product_cat'";
        }

        //Truy vấn bảng factory để hiển thị lên selecbox nhà máy
        $array_factory = array("" => array("id" => "", "name" => "Chọn nhà máy"));
        $array_factory += $this->Factory->find("all", array("fields" => "id, name"));

        //Truy vấn bảng manufactory để hiển thị lên selectbox xưởng
        $array_manufactory = array("" => array("id" => "", "name" => "Chọn xưởng"));
        $array_manufactory += $this->Manufactory->find("all", array("id, name"));

        $array_product_name = null;
        //$array_product_name = array(""=>array("id"=>"", "name"=>"Chọn sản phẩm"));
        $array_product_name = $this->Product->find("all", array("fields" => "id, name"));

        $array_product_cat = array("" => array("id" => "", "name" => "Chọn dòng sản phẩm"));
        $array_product_cat += $this->ProductCat->find("all", array("fields" => "id, name"));

        //$array_product_code = $this->Product->find("all", array("fields"=>"id, code"));
        //$array_product_code = array(""=>array("id"=>"", "name"=>"...")) + $array_product_code;

        //gọi hàm find của đối tượng Product để truy vấn tất cả dữ liệu từ bảng products, đưa vào mảng $array_product
        $array_product = $this->Product->find("all", array("conditions" => $dk));

        $array_param = array("array_product_name" => $array_product_name,
            "array_product" => $array_product,
            "array_factory" => $array_factory,
            "array_manufactory" => $array_manufactory,
            "array_product_cat" => $array_product_cat,
            "id" => $id,
            "id_factory" => $id_factory,
            "id_manufactory" => $id_manufactory,
            "id_product_cat" => $id_product_cat,
            "product_name" => $product_name,
        );

        //dùng hàm render của đối tượng View để truy cập tới file danh sách sản phẩm: index_product2.php, trả về biến $html_result
        $html_result = $this->View->render("index_product2.php", $array_param);
        echo $html_result;


    }

    function del($id = "")
    {
        if ($id != "") {
            // xóa sản phẩm theo id
            $this->loadModel("Product");
            $this->Product->delete($id);

            // chuyển về trang index

            $this->redirect("/product2.html");
        }
    }

    //begin:định mức sản phẩm
    function list_rate($id_product = "", $id_rate = "")
    {
        //tạo đối tượng model Product_rate, liên kết với bảng product_rates
        $this->loadModel('Product');
        $this->loadModel("Material", "material");
        $this->loadModel('Product_rate', 'product_rates');


        //kiểm tra có dữ liệu post để lưu không ?
        if (isset($_GET['data'])) {
            //lấy dữ liệu submit lên vào mảng $array_data
            $array_data = $_GET['data'];

            //lấy giá trị của phần tử id_product
            $id_product = $array_data['id_product'];

            //lấy giá trị của phần tử id_material
            $id_material = $array_data['id_material'];

            //lấy tên product_name từ bảng Product where id=$id_product
            $array_product_name = $this->Product->find("all", array("conditions" => "id = '$id_product'"));

            //lấy tên material_name từ bảng Material where id=$id_material
            $array_material_name = $this->Material->find("all", array("conditions" => "id = '$id_material'"));

            //tạo phần tử product_name trong mảng array_data để lưu giá trị cho cột product_name vào bảng product_rates
            $array_data['product_name'] = $array_product_name[0]['name'];

            //tạo phần tử material_name trong mảng array_data để lưu giá trị cho cột material_name vào bảng product_rates
            $array_data['material_name'] = $array_material_name[0]['name'];


            //dùng hàm save của đối tượng Product để lưu dư liệu vào bảng products
            $this->Product_rate->save($array_data);

            //gán giá trị rỗng vào viến $array_data_product lúc này $array_data_product có giá trị là rỗng
            $array_data_product = "";

            //kiểm tra id_product truyền lên khác rỗng thì gán $array_data_product["id"] = $id_product;
            if ($id_product != "") {
                //
                $array_data_product["id"] = $id_product;

                //tạo mảng $array_data_product phần tử str_rate_detail bằng rỗng
                $array_data_product["str_rate_detail"] = "";


                //truy vấn bảng product_rate theo id_product submit lên vào mảng $array_fee
                $array_rate = $this->Product_rate->find("all", array("conditions" => "id_product = '$id_product'"));

                //dùng vòng lặp foreach để cộng chuỗi vào mảng $array_data_prodcut phần tử str_rate_detail bằng giá trị $f phần tử material_name, num, unit
                foreach ($array_rate as $rate) {
                    $array_data_product["str_rate_detail"] .= $rate["material_name"] . ": " . $rate['num'] . $rate['unit'] . ", ";
                }


                $this->Product->save($array_data_product);
            }


            //dùng hàm redirect của đối tượng $this để chuyển về hàm index
            $this->redirect("/product2/list_rate/$id_product.html");
        }

        //truy vấn dữ liệu sản phẩm hiện tại theo id để đưa vào form nhập sản phẩm
        $array_edit_product = null;

        if ($id_rate != "") {
            //gọi hàm find của đối tượng Product để truy vấn tất cả dữ liệu từ bảng product, đưa vào mảng $array_edit_product
            $array_edit_product = $this->Product_rate->find("all", array("conditions" => "id = '$id_rate'"));
        }

        //tạo đối tượng model Product, liên kết với bảng products
        $this->loadModel('Product');

        //dùng hàm find của đối tượng Product đọc dữ liệu từ bảng products
        $str_product_name = "";

        //lấy tên product_name từ bảng Product where id=$id_product
        $array_product = $this->Product->find("all", array("conditions" => "id = '$id_product'"));


        if ($array_product != NULL) {
            $str_product_name = $array_product[0]['name'];
        }

        //tạo đối tượng model material, liên kết với bảng material
        $this->loadModel("Material", "material");

        //dùng hàm find của đối tượng Material đọc dữ liệu từ bảng material
        $array_material = $this->Material->find("all", array("fields" => "id, name"));

        //truy vấn tất cả định mức của sản phẩm

        //gọi hàm find của đối tượng Product để truy vấn tất cả dữ liệu từ bảng products, đưa vào mảng $array_product_rate
        $array_product_rate = $this->Product_rate->find("all", array("conditions" => "id_product = '$id_product'"));

        $array_param = array("array_edit_product" => $array_edit_product,
            "str_product_name" => $str_product_name,
            "array_material" => $array_material,
            "array_product_rate" => $array_product_rate,
            "id_product" => $id_product);

        //dùng hàm render của đối tượng View để truy cập tới file nhập sản phẩm: add_product2.php , trả về kết quả biến htmt
        $html_result = $this->View->render("list_product2_rate.php", $array_param);
        echo $html_result;
    }

    function del_rate($id_product = "", $id = "")
    {
        if ($id != "") {
            // xóa sản phẩm theo id
            $this->loadModel("Product_rate", "product_rates");
            $this->loadModel("Product");
            $this->Product_rate->delete($id);

            //gán giá trị rỗng vào viến $array_data_product lúc này $array_data_product có giá trị là rỗng
            $array_data_product = "";

            //kiểm tra id_product truyền lên khác rỗng thì gán $array_data_product["id"] = $id_product;
            if ($id_product != "") {
                //
                $array_data_product["id"] = $id_product;

                //tạo mảng $array_data_product phần tử str_rate_detail bằng rỗng
                $array_data_product["str_rate_detail"] = "";


                //truy vấn bảng product_rate theo id_product submit lên vào mảng $array_fee
                $array_rate = $this->Product_rate->find("all", array("conditions" => "id_product = '$id_product'"));

                //dùng vòng lặp foreach để cộng chuỗi vào mảng $array_data_prodcut phần tử str_rate_detail bằng giá trị $f phần tử material_name, num, unit
                foreach ($array_rate as $rate) {
                    $array_data_product["str_rate_detail"] .= $rate["material_name"] . ": " . $rate['num'] . $rate['unit'] . ", ";
                }


                $this->Product->save($array_data_product);
            }

            // chuyển về trang index

            $this->redirect("/product2/list_rate/$id_product.html");
            return;
        }
    }

    //end: định mức sản phẩm


    //begin:chi phí sản phẩm
    function list_fee($id_product = "", $id_fee = "")
    {
        $this->loadModel("Product_fee", "product_fees");
        $this->loadModel("Product");

        if (isset($_POST['data'])) {
            $array_data = $_POST['data'];

            //lấy giá trị của phần tử id_product
            $id_product = $array_data['id_product'];

            //lấy tên product_name từ bảng Product where id=$id_product
            $array_product_name = $this->Product->find("all", array("conditions" => "id = '$id_product'"));

            $product_name = "";

            if ($array_product_name != NULL) {
                //tạo phần tử product_name trong mảng array_data để lưu giá trị cho cột product_name vào bảng product_fee
                $array_data['product_name'] = $array_product_name[0]['name'];

            }

            //
            $this->Product_fee->save($array_data);

            //gán giá trị rỗng vào biến$array_data_product lúc này biến $array_data_product có giá trị rỗng
            $array_data_product = "";

            //kiểm tra $id_product có khác rỗng hay không nếu khác rỗng thì đi vào trong dấu ngoặc và thực hiện câu lệnh
            if ($id_product != "") {
                //gán biến $id_product vào mảng $array_data_product có phần tử là id lúc này $array_data_product['id'] có giá trị là biến $id_product
                $array_data_product['id'] = $id_product;

                //tạo mảng $array_data_product phần tử str_fee_detail bằng rỗng
                $array_data_product["str_fee_detail"] = "";

                //truy vấn bảng product_rate theo id_product submit lên vào mảng $array_fee
                $array_fee = $this->Product_fee->find("all", array("conditions" => "id_product = '$id_product'"));

                //dùng hàm find để lọc hàm sun tính tổng tiền theo id_product
                $array_fee_sum = $this->Product_fee->find("all", array("fields" => "SUM(money) AS tong", "conditions" => "id_product='$id_product'"));

                //tạo mảng chứa phần tử sum_fee bằng với giá trị có phần tử thứ 0 và giá trị tong
                $array_data_product["sum_fee"] = $array_fee_sum[0]['tong'];

                //dùng vòng lặp foreach để cộng chuỗi vào mảng $array_data_prodcut phần tử str_fee_detail bằng giá trị $fê phần tử  name, num  , uint
                foreach ($array_fee as $fee) {
                    $array_data_product["str_fee_detail"] .= $fee["name"] . ": " . $fee["money"] . $fee["unit"] . ", ";
                }

            }


            $this->Product->save($array_data_product);
            $this->redirect("product2/list_fee/" . $array_data["id_product"]);
        }

        //lấy tên product_name từ bảng Product where id=$id_product
        $array_product_name = $this->Product->find("all", array("conditions" => "id = '$id_product'"));

        //lấy phần tử title của mảng array_module
        $title_fee = $array_product_name[0]['name'];
        //echo $title;

        //truy vấn từ bảng product_fees để lấy danh sách chi phí của product_fee bằng $id_product
        $array_data = $this->Product_fee->find("all", array("conditions" => "id_product='$id_product'"));

        //lấy module hiện tại để sửa
        $array_edit_fee = NULL;
        if ($id_fee != "") {
            $array_edit_fee = $this->Product_fee->find("all", array("conditions" => "id='$id_fee'"));
        }

        $html = $this->View->render('list_product2_fee.php', array("id_product" => $id_product, "array_product_name" => $array_product_name, "array_data" => $array_data, "title_fee" => $title_fee, "array_edit_fee" => $array_edit_fee));
        echo $html;
    }


    function del_fee($id_product = "", $id_fee = "")
    {
        if ($id_fee != "") {
            // xóa sản phẩm theo id
            $this->loadModel("Product_fee", "product_fees");
            $this->loadModel("Product");
            $this->Product_fee->delete($id_fee);
            $array_data_product = "";

            //kiểm tra $id_product có khác rỗng hay không nếu khác rỗng thì đi vào trong dấu ngoặc và thực hiện câu lệnh
            if ($id_product != "") {
                //gán biến $id_product vào mảng $array_data_product có phần tử là id lúc này $array_data_product['id'] có giá trị là biến $id_product
                $array_data_product['id'] = $id_product;

                //tạo mảng $array_data_product phần tử str_fee_detail bằng rỗng
                $array_data_product["str_fee_detail"] = "";

                //truy vấn bảng product_rate theo id_product submit lên vào mảng $array_fee
                $array_fee = $this->Product_fee->find("all", array("conditions" => "id_product = '$id_product'"));

                //truy vấn bảng product_fee theo id_product và dùng hàm SUM(money) để cộng cột money trong bảng product_fees
                $array_fee_sum = $this->Product_fee->find("all", array("fields" => "SUM(money) AS tong", "conditions" => "id_product='$id_product'"));

                //tạo mảng $array_data_product phần tử sum_fee bằng giá trị cột tong vừa tạo từ bảng product_fees
                $array_data_product["sum_fee"] = $array_fee_sum[0]['tong'];

                //dùng vòng lặp foreach để cộng chuỗi vào mảng $array_data_prodcut phần tử str_fee_detail bằng giá trị $fê phần tử  name, num  , uint
                foreach ($array_fee as $fee) {
                    $array_data_product["str_fee_detail"] .= $fee["name"] . ": " . $fee["money"] . $fee["unit"] . ", ";
                }

            }

            //dùng hàm save để lưu mảng $array_data_product có phần tử vào bảng product
            $this->Product->save($array_data_product);

            $this->redirect("/product2/list_fee/" . $id_product);
            return;
        }
    }
    //end:chi phí sản phẩm


    //Begin: Tạo hàm assign
    function assign($id = "")
    {
        //Tạo đối tượng model Users để liên kết với bảng users
        $this->loadModel("Users", "users");

        //Tạo đối tượng model Product để liên kết với bảng products
        $this->loadModel("Product");

        //Tạo đối tượng model Assign để liên kết với bảng product_assign
        $this->loadModel("Assign", "product_assign");

        //kiểm tra có dữ liệu submit lên không nếu có thì đi vào dấu ngoặc và thực hiện việc tiếp theo
        if (isset($_POST["data"])) {
            //Lấy dữ liệu submit lên vào mảng $array_data
            $array_data = $_POST["data"];

            //Lấy giá trị của phần tử id_user
            $id_user = $array_data["id_user"];

            //Lấy giá trị của phần tử id_product
            $id_product = $array_data["id_product"];

            //Dùng hàm find để truy vấn từ bảng users để lấy cột fullname theo id = $id_user
            $array_user_name = $this->Users->find("all", array("conditions" => "id = '$id_user'"));

            //Dùng hàm find để truy vấn từ bảng products để lấy cột name theo id = $id_product
            $array_product_name = $this->Product->find("all", array("conditions" => "id = '$id_product'"));

            //Tạo mảng $array_user_name có phần tử 0 và giá trị fullname để lưu giá trị vào bảng assign theo cột user_fullname
            $array_data["user_fullname"] = $array_user_name[0]["fullname"];

            //Tạo mảng $array_product_name có phần tử 0 và giá trị name để lưu giá trị vào bảng assign theo cột product_name
            $array_data["product_name"] = $array_product_name[0]["name"];

            //chuyển chuỗi ngày định dạng d-m-y thành Y-m-d
            $array_data["day"] = date("Y-m-d", strtotime($array_data["day"]));

            //Dùng hàm save của đối tượng Assign để lưu mảng $array_data
            $this->Assign->save($array_data);

            //Dùng hàm redirect để chuyển về hàm assign
            $this->redirect("/product2/assign.html?id_user=$id_user");

        }

        //Dùng hàm find của đối tượng Users để lọc dữ liệu theo id và fullname từ bảng users
        $array_user = $this->Users->find("all", array("fields" => "id, fullname"));

        //Thêm phần tử của mảng đầu tiên array_user
        $array_user = array("" => array("id" => "", "fullname" => "...")) + $array_user;


        //Dùng hàm find của đối tượng Product để lọc dữ liệu theo id và name từ bảng product
        $array_product = $this->Product->find("all", array("fields" => "id, name"));


        $id_user = "";

        if (isset($_GET["id_user"])) {
            $id_user = $_GET["id_user"];
        }

        //Dùng hàm find của đối tượng Assign để truy vấn tất cả dữ liệu trong bảng assign theo cột day giảm dần
        $array_assign = $this->Assign->find("all", array("conditions" => "id_user = '$id_user'", "order" => "day DESC"));

        //Tạo mảng $array_edit_assign bằng rỗng
        $array_edit_assign = "";

        //kiểm tra xem id có khác rỗng hay không nếu khác rỗng thì đi vào câu lệnh if và thực hiện tiếp theo
        if ($id != "") {
            //Dùng hàm find của đối tượng Assign để lấy id sửa đưa vào mảng $array_edit_assign
            $array_edit_assign = $this->Assign->find("all", array("conditions" => "id = '$id'"));
        }

        //Tạo mảng nhóm các phần tử render qua View
        $array_param = array("array_user" => $array_user,
            "array_product" => $array_product,
            "array_assign" => $array_assign,
            "array_edit_assign" => $array_edit_assign,
            "id_user" => $id_user
        );

        $html = $this->View->render("assign_product2.php", $array_param);
        echo $html;
    }//End: Tạo hàm assign


    //Tạo hàm del_assign
    function del_assign($id = "")
    {
        if ($id != "") {
            //Tạo đối tượng model Assign để liên kết với bảng product_assign
            $this->loadModel("Assign", "product_assign");

            //Dùng hàm delete để xóa theo id
            $this->Assign->delete($id);
        }

        $id_user = "";
        if (isset($_GET["id_user"])) {
            $id_user = $_GET["id_user"];
        }

        //Dùng hàm redirect để chuyền về hàm assign
        $this->redirect("/product2/assign.html?id_user=$id_user");
    }

    function product_machine($id_product = "", $id_product_machine = "")
    {
        $this->loadModel("Machine", "machines");
        $this->loadModel("ProductMachine", "product_machines");
        $this->loadModel("Product", "products");

        $act = "";
        $array_edit = null;
        if (isset($_GET["act"]) && $_GET["act"] != "") {
            $act = $_GET["act"];
            if ($act == "del") {
                $this->ProductMachine->delete($id_product_machine);
                $this->redirect("/product2/product_machine/$id_product.html");
            }
            if ($act == "edit") {
                //truy vẫn dữ liệu bảng product_machine theo id để hiển thị lên form sửa
                if ($id_product_machine != "") {
                    $array_edit = $this->ProductMachine->find("all", array("conditions" => "id='$id_product_machine'"));
                }
            }
        }

        $array_machine = array("" => array("id" => "", "name" => "Chọn máy sản xuất"));
        $array_machine += $this->Machine->find("all", array("fields" => "id, name"));

        //lấy tên sản phẩm
        $product_name = $this->Product->get_value(array("fields" => "name", "conditions" => "id='$id_product'"));

        //truy van dữ liệu từ bảng product_machines để hiển thị table
        $array_product_machine = $this->ProductMachine->find("all", array("conditions" => "id_product='$id_product'"));

        if (isset($_POST["data"])) {
            $array_data = $_POST["data"];

            $array_data["id_product"] = $id_product;

            //Lấy tên sản phẩm từ bảng product theo id
            $array_data["product_name"] = $this->Product->get_value(array("fields" => "name", "conditions" => "id = '$id_product'"));
            $array_data["product_code"] = $this->Product->get_value(array("fields" => "code", "conditions" => "id = '$id_product'"));

            $id_machine = $array_data["id_machine"];
            $array_data["machine_name"] = $this->Machine->get_value(array("fields" => "name", "conditions" => "id = '$id_machine'"));


            $this->ProductMachine->save($array_data);

            $this->redirect("/product2/product_machine/$id_product.html");
        }

        $array_param = array(
            "id_product" => $id_product,
            "array_machine" => $array_machine,
            "array_product_machine" => $array_product_machine,
            "array_edit" => $array_edit,
            "product_name" => $product_name
        );
        $html = $this->View->render("product_machine.php", $array_param);
        echo $html;
    }

    function product_detail($id_product = "")
    {
        $this->loadModel("Product", "products");
        $this->loadModel("ProductDetail", "product_detail");
        $this->loadModel("ProductRate", "product_rates");
        $this->loadModel("ProductUser", "product_users");
        $this->loadModel("ProductMachine", "product_machines");


        //truy vấn lấy tên sản phẩm theo id_product
        $product_name = $this->Product->get_value(array("fields" => "name", "conditions" => "id=$id_product"));

        $array_product_detail = $this->ProductDetail->find("all", array("conditions" => "id_product = $id_product"));

        //truy van du lieu tu bang product
        $array_product = $this->Product->find("all", array("fields" => "name, code, barcode", "conditions" => "id = $id_product"));

        //truy vấn đổ ra chi tiết định mức nguyên liêu từ bảng product_rate
        $array_product_rate = $this->ProductRate->find("all", array("conditions" => "id_product = '$id_product'"));

        //truy vấn đổ chi tiết nhân công sản xuất từ bảng product_users
        $array_product_user = $this->ProductUser->find("all", array("conditions" => "id_product = '$id_product'"));

        //truy vấn đổ chi tiết nhân công sản xuất từ bảng product_users
        $array_product_machine = $this->ProductMachine->find("all", array("conditions" => "id_product = '$id_product'"));

        $array_param = array(
            "product_name" => $product_name,
            "array_product_detail" => $array_product_detail,
            "array_product" => $array_product,
            "array_product_rate" => $array_product_rate,
            "array_product_user" => $array_product_user,
            "array_product_machine" => $array_product_machine,
        );

        $html = $this->View->render("product_detail.php", $array_param);
        echo $html;
    }

    function product_user($id_product = "", $id_product_user = "")
    {
        $this->loadModel("User2", "users");
        $this->loadModel("ProductUser", "product_users");
        $this->loadModel("Job", "jobs");
        $this->loadModel("Product", "products");

        $act = "";
        if (isset($_GET["act"]) && $_GET["act"] != "") $act = $_GET["act"];

        if ($act == "del") {
            if ($id_product_user != "") {
                $this->ProductUser->delete($id_product_user);
                $this->redirect("/product2/product_user/$id_product.html");
            }
        }

        $array_edit = null;
        if ($act == "edit") {
            if ($id_product_user != "") {
                $array_edit = $this->ProductUser->find("all", array("conditions" => "id=$id_product_user"));
            }
        }

        if (isset($_POST["data"])) {
            $array_data = $_POST["data"];

            $array_data["id_product"] = $id_product;

            //lấy user_fullname
            $id_user = $array_data["id_user"];
            $array_data["user_fullname"] = $this->User2->get_value(array("fields" => "fullname", "conditions" => "id=$id_user"));
            $array_data["user_code"] = $this->User2->get_value(array("fields" => "user_code", "conditions" => "id=$id_user"));
            //lấy tên công việc
            $id_job = $array_data["id_work"];
            $array_data["work_name"] = $this->Job->get_value(array("fields" => "name", "conditions" => "id=$id_job"));

            //print_r($array_data);
            $this->ProductUser->save($array_data);

            //lấy dữ liệu bảng product_user
            $array_user_work = $this->ProductUser->find("all", array("conditions" => "id_product='$id_product'"));
            //print_r($array_user_work);
            //Lưu tên công nhân và công việc vào cột str_user_work trong bảng scm_products
            $array_data_product = null;
            $str_user_work = "";
            if ($array_user_work) {
                foreach ($array_user_work as $user_work) {
                    //lấy ra cột user_fullname của bảng product_user có id_product = $id_product
                    $str_user_work .= $user_work["user_fullname"] . "-" . $user_work["work_name"] . "<br>";

                }
            }

            $array_data_product["id"] = $id_product;
            $array_data_product["str_user_work"] = $str_user_work;
            $this->Product->save($array_data_product);


            $this->redirect("/product2/product_user/$id_product");
        }

        //truy vấn lấy tên sản phẩm theo id_product
        $product_name = $this->Product->get_value(array("fields" => "name", "conditions" => "id=$id_product"));
        $array_user = $this->User2->find("all", array("fields" => "id,concat(fullname,' - ',user_code) as fullname"));
        $array_job = $this->Job->find("all", array("fields" => "id,name"));
        $array_product_user = $this->ProductUser->find("all", array("conditions" => "id_product = '$id_product'"));


        $array_param = array(
            "array_edit" => $array_edit,
            "product_name" => $product_name,
            "array_user" => $array_user,
            "array_job" => $array_job,
            "array_product_user" => $array_product_user,
            "id_product" => $id_product
        );
        $html = $this->View->render("product_user.php", $array_param);
        echo $html;
    }

    function add($id = "", $id_edit = "")
    {
        $this->loadModel('Product');
        $this->loadModel("Customer", "customers");
        $this->loadModel("Product_cat", "product_cats");
        $this->loadModel("Product_fee", "product_fees");
        $this->loadModel("Product_cat_detail", "product_cat_details");
        $this->loadModel("ProductDetail", "product_detail");
        $this->loadModel("Customer", "customers");
        $this->loadModel("Factory");
        $this->loadModel("Manufactory");
        $this->loadModel("ProductMachine", "product_machines");
        $this->loadModel("Machine", "machines");
        $this->loadModel("Material", "material");
        $this->loadModel("ProductRate", "product_rates");
        $this->loadModel("ProductUser", "product_users");
        $this->loadModel("Shift", "shift");
        $this->loadModel("User2", "users");
        $this->loadModel("Job", "jobs");
        $this->loadModel("Group", "groups");
        $id_edit_product = $id;


        //BEGIN: Lưu tab cycle ===========================

        if (isset($_POST['data2'])) {
            $array_product_machine = $_POST['data2'];

            $id_product = $id;
            $array_product_machine["id_product"] = $id_product;
            $array_product_machine["product_name"] = $this->Product->get_value(array("fields" => "name", "conditions" => "id='$id_product'"));
            $array_product_machine["product_code"] = $this->Product->get_value(array("fields" => "code", "conditions" => "id='$id_product'"));
            $id_machine = $array_product_machine["id_machine"];

            $array_product_machine["machine_control"] = $this->Machine->get_value(array("fields" => "control", "conditions" => "id='$id_machine'"));
            $array_product_machine["machine_name"] = $this->Machine->get_value(array("fields" => "name", "conditions" => "id='$id_machine'"));

            $this->ProductMachine->save($array_product_machine);
            $this->redirect("/product2/add/$id_product#tabs-2");
        }
        //END: Lưu tab cycle ===========================

        //BEGIN: LƯU TAB ĐỊNH MỨC VẬT TƯ
        if (isset($_POST['data_rate'])) {
            $array_product_rate = $_POST['data_rate'];
            $id_product = $id;
            $array_product_rate["id_product"] = $id_product;
            $id_material = $array_product_rate["id_material"];


            //begin:lấy thông tin vật tư
            $array_product_rate["product_name"] = $this->Product->get_value(array("fields" => "name", "conditions" => "id='$id_product'"));
            $array_product_rate["material_code_bar"] = $this->Material->get_value(array("fields" => "bar_code", "conditions" => "id='$id_material'"));
            $array_product_rate["material_code"] = $this->Material->get_value(array("fields" => "code", "conditions" => "id='$id_material'"));
            $array_product_rate["material_name"] = $this->Material->get_value(array("fields" => "name", "conditions" => "id='$id_material'"));
            $array_product_rate["unit"] = $this->Material->get_value(array("fields" => "unit", "conditions" => "id='$id_material'"));
            $array_product_rate["quota"] = $this->Material->get_value(array("fields" => "quota", "conditions" => "id='$id_material'"));
            //end: lấy thông tin vật tư

            $this->ProductRate->save($array_product_rate);

            //BEGIN: lấy dữ liệu vật tư
            $array_product_rate_tmp = $this->ProductRate->find("all", array("conditions" => "id_product='$id_product'"));

            //Lưu tên và mã vật tư vào cột str_product_rate trong bảng scm_products
            $array_data_product_rate = null;
            $str_product_rate = "";
            if ($array_product_rate_tmp) {
                foreach ($array_product_rate_tmp as $rate) {
                    //Begin:lấy thông tin nguyên vật liệu từ bảng material theo id_material trong bảng product_rate
                    $id_material_tmp = $rate["id_material"];
                    $material_name = $this->Material->get_value(array("fields" => "name", "conditions" => "id = '$id_material_tmp'"));
                    $material_code = $this->Material->get_value(array("fields" => "code", "conditions" => "id = '$id_material_tmp'"));
                    //End: lấy thông tin nguyên vật liệu từ bảng material theo id_material trong bảng product_rate

                    //lấy ra cột user_fullname của bảng product_user có id_product = $id_product
                    $str_product_rate .= "$material_name($material_code)<br>";
                }
            }

            $array_data_product_rate["id"] = $id_product;
            $array_data_product_rate["str_product_rate"] = $str_product_rate;
            //END: lấy dữ liệu vật tư
            //print_r($array_data_product_rate);
            $this->Product->save($array_data_product_rate);


            $this->redirect("/product2/add/$id_product#tabs-3");
        }
        //END: LƯU TAB ĐỊNH MỨC VẬT TƯ

        $id_group = "";
        if (isset($_GET["id_group"])) $id_group = $_GET["id_group"];

        //BEGIN: LƯU TAB CÔNG NHÂN SẢN XUẤT
        if (isset($_GET['data_user'])) {
            $array_product_user = $_GET['data_user'];
            $id_group = "";
            $status_user = "";
            if (isset($_GET["id_group"]) && $_GET["id_group"] != "") $id_group = $_GET["id_group"];
            if (isset($_GET["status_user"]) && $_GET["status_user"] != "") $status_user = $_GET["status_user"];
            if ($status_user == "1") {
                $id_product = $id;
                $array_product_user["id_product"] = $id_product;
                $array_product_user["product_name"] = $this->Product->get_value(array("fields" => "name", "conditions" => "id='$id_product'"));
                $array_product_user["id_group"] = $id_group;
                $id_user = $array_product_user["id_user"];
                $id_job = $array_product_user["id_work"];
                $id_shift = $array_product_user["id_shift"];


                //begin:lấy thông tin user
                $array_product_user["user_fullname"] = $this->User2->get_value(array("fields" => "fullname", "conditions" => "id='$id_user'"));
                $array_product_user["user_code"] = $this->User2->get_value(array("fields" => "user_code", "conditions" => "id='$id_user'"));
                $array_product_user["work_name"] = $this->Job->get_value(array("fields" => "name", "conditions" => "id='$id_job'"));
                $array_product_user["shift"] = $this->Shift->get_value(array("fields" => "name", "conditions" => "id='$id_shift'"));
                $array_product_user["group_name"] = $this->Group->get_value(array("fields" => "name", "conditions" => "id='$id_group'"));
                //end: lấy thông tin user
                $this->ProductUser->save($array_product_user);

                //BEGIN: lấy dữ liệu bảng product_user
                $array_user_work = $this->ProductUser->find("all", array("conditions" => "id_product='$id_product'"));
                //print_r($array_user_work);
                //Lưu tên công nhân và công việc vào cột str_user_work trong bảng scm_products
                $array_data_product = null;
                $str_user_work = "";
                if ($array_user_work) {
                    foreach ($array_user_work as $user_work) {
                        //Begin: cắt lấy 2 từ sau cùng của tên
                        $user_fullname = $user_work["user_fullname"];
                        $array_item = explode(" ", $user_fullname);
                        $dem = count($array_item);
                        $str_fullname = $array_item[$dem - 2] . " " . $array_item[$dem - 1];
                        //End: cắt lấy 2 từ sau cùng của tên

                        //lấy ra cột user_fullname của bảng product_user có id_product = $id_product
                        $str_user_work .= $str_fullname . "(" . $user_work["user_code"] . ")" . " - " . $user_work["work_name"] . "<br>";

                    }
                }

                $array_data_product["id"] = $id_product;
                $array_data_product["str_user_work"] = $str_user_work;
                $this->Product->save($array_data_product);
                //END: lấy dữ liệu bảng product_user

                $this->redirect("/product2/add/$id#tabs-4");
            }
            //$this->redirect("/product2/add/$id/$id_edit?id_group=$id_group#tabs-4");

        }
        //END: LƯU TAB CÔNG NHÂN SẢN XUẤT

        //kiểm tra có dữ liệu post để lưu không ?
        if (isset($_GET['data'])) {
            //lấy dữ liệu submit lên vào biến data
            $array_data = $_GET['data'];
            $array_data["id_cat"] = $_GET["id_line"];

            $id_factory = $_GET["id_factory"];
            $array_data["id_factory"] = $_GET["id_factory"];
            $array_data["factory"] = $this->Factory->get_value(array("fields" => "name", "conditions" => "id='$id_factory'"));

            $id_manufactory = $_GET["id_manufactory"];
            $array_data["id_manufactory"] = $_GET["id_manufactory"];
            $array_data["manufactory"] = $this->Manufactory->get_value(array("fields" => "name", "conditions" => "id='$id_manufactory'"));

            //lấy giá trị của phần tử id_customer
            $id_customer = $array_data['id_customer'];

            //lấy giá trị của phần tử id_line
            $id_cat = $_GET["id_line"];

            //lấy tên name từ bảng Customer where id = $id_customer
            $array_customer_name = $this->Customer->find("all", array("conditions" => "id = '$id_customer'"));
            $array_data['customer'] = $array_customer_name[0]['fullname'];

            //lấy tên name từ bảng product_cats where id = $id_cats
            $array_line_name = $this->Product_cat->find("all", array("conditions" => "id = '$id_cat'"));
            $array_data['cat_name'] = $array_line_name[0]['name'];

            if ($array_data['status'] == 1) {


                $this->Product->save($array_data);


                //BEGIN: lưu vào bảng product_detail
                //lấy id_product vua moi luu ở bảng product để lưu vào bảng product_detail
                if ($id == "") $id_product = $this->Product->get_value(array("fields" => "MAX(id)"));
                else $id_product = $id;
                if (isset($_GET["data_detail"])) {
                    $data_detail = $_GET["data_detail"];
                    $data_detail["id_product"] = $id_product;

                    // tạo mảng để lưu vào bảng product_detail
                    $array_data = null;
                    $array_data["id_product"] = $id_product;

                    //truy vấn dữ liệu bảng product_cat_detail theo id_product_cat truyền lên(id dong sản phẩm)
                    $array_product_cat_detail = $this->Product_cat_detail->find("all", array("conditions" => "id_product_cat = '$id_cat'"));


                    if ($array_product_cat_detail) {

                        $num = 0;
                        foreach ($array_product_cat_detail as $product_cat_detail) {

                            //BEGIN: Lấy name submit lên
                            $code = $product_cat_detail["code"];
                            $name = $product_cat_detail["name"];
                            //END: lấy name submit lên

                            //
                            $array_data["code"] = $code;
                            $array_data["name"] = $name;

                            $value = $data_detail["$code"];
                            $array_data["value"] = $value;

                            //lấy phần tử id từ mảng submit lên, để lất phần tử id
                            if (isset($data_detail[$num]["id"])) $array_data["id"] = $data_detail[$num]["id"];

                            //print_r($array_data);
                            $this->ProductDetail->save($array_data);
                            $num++;
                        }
                    }
                }

                $this->redirect("/product2/add/$id_product");
            }
        }

        //dùng hàm find của đối tượng Customer đọc dữ liệu từ bảng customers
        $array_customer = array("" => array("id" => "", "name" => "Chọn khách hàng"));
        $array_customer += $this->Customer->find("all", array("fields" => "id, fullname"));

        //dùng hàm find của đối tượng Produc_cat đọc dữ liệu từ bảng product_cats
        $array_line = array("" => array("id" => "", "name" => "Chọn dòng sản phẩm"));
        $array_line += $this->Product_cat->find("all", array("fields" => "id, name"));

        //BEGIN: CN sửa
        //truy vấn dữ liệu sản phẩm hiện tại theo id để đưa vào form nhập sản phẩm
        $array_edit_product = null;
        if ($id != "") {
            //gọi hàm find của đối tượng Product để truy vấn tất cả dữ liệu từ bảng product, đưa vào mảng $array_edit_product
            $array_edit_product = $this->Product->find("all", array("conditions" => "id='$id'"));
        }

        //END: CN sửa

        $dk = "";
        $id_line = "";
        if (isset($_GET["id_line"]) && $_GET["id_line"] != "") $id_line = $_GET["id_line"];

        //truy vấn lấy thuộc tính sản phẩm
        $array_product_cat_detail = $this->Product_cat_detail->find("all", array("conditions" => "id_product_cat = '$id_line'", "order" => "id ASC"));
        if ($id != "") {
            $array_product_cat_detail = $this->ProductDetail->find("all", array("conditions" => "id_product='$id'"));
        }

        //Truy vấn bảng factỏy để hiển thị lên selecbox nhà máy
        $array_factory = array("" => array("id" => "", "name" => "Chọn nhà máy"));
        $array_factory += $this->Factory->find("all", array("fields" => "id, name"));

        //Truy vấn bảng manufactory để hiển thị lên selecbbox xưởng
        $array_manufactory = array("" => array("id" => "", "name" => "Chọn xưởng"));
        $array_manufactory += $this->Manufactory->find("all", array("fields" => "id, name"));

        //BEGIN: TAB ĐỊNH MỨC
        //================================================================================
        //Truy vấn bảng product_machine để hiển thị lên selecbbox máy
        $dk_machine = "";
        if ($id != "") $dk_machine = "id_product = '$id'";
        $array_machine = array("" => array("id" => "", "name" => "Chọn máy"));
        $array_machine = $this->Machine->find("all", array("fields" => "id,control"));

        //================================================================================
        //END: TAB ĐỊNH MỨC

        //BEGIN: TAB NHÂN SỰ
        //================================================================================

        $dk_user = "";
        $array_product_user = null;
        if ($id != "") {
            $dk_user = "id_product = '$id'";
            $array_product_user = $this->ProductUser->find("all", array("conditions" => $dk_user));
        }
        //Truy vấn bảng user để hiển thị lên selectbox công việc bên tab định mức nhân sự

        $array_job = array("" => array("id" => "", "name" => "Chọn công việc"));
        $array_job += $this->Job->find("all", array("fields" => "id, name"));

        //Truy vấn bảng user để hiển thị lên selectbox công nhân bên tab định mức nhân sự
        $array_user2 = array("" => array("id" => "", "name" => "..."));

        $dk_product_user = "";
        if ($id_group != "") $dk_product_user = "id_group = '$id_group'";
        $array_user2 += $this->User2->find("all", array("fields" => "id, fullname", "conditions" => $dk_product_user));

        $array_shift = array("" => array("id" => "", "name" => "Chọn ca"));
        $array_shift += $this->Shift->find("all", array("fields" => "id, name"));

        $array_group = array("" => array("id" => "", "name" => "Chọn tổ"));
        $array_group += $this->Group->find("all", array("fields" => "id, name"));
        //================================================================================
        //END: TAB NHÂN SỰ
        $array_product_rate = null;
        $array_product_machine = null;
        $dk_product = "";
        if ($id != "") {
            $dk_product = "id_product='$id'";
            $array_product_rate = $this->ProductRate->find("all", array("conditions" => $dk_product));
            $array_product_machine = $this->ProductMachine->find("all", array("conditions" => $dk_product));
        }

        //BEGIN: TAB định mức vật tư
        $array_material = array("" => array("id" => "", "name" => "Chọn vật tư"));
        $array_material = $this->Material->find("all", array("fields" => "id, name"));


        //END: Tab định mức vật tư
        $act = "";
        if (isset($_GET["act"])) $act = $_GET["act"];

        //BEGIN: Chức năng sửa/xóa tab  CycleTime ===================================================================
        //cn sửa tab cycletime
        $array_edit_product_machine = null;
        if ($act == "edit_cycle") {
            if ($id_edit != "") {
                $array_edit_product_machine = $this->ProductMachine->find("all", array("conditions" => "id = '$id_edit'"));
            }
        }

        //cn xóa tab cycletime
        if ($act == "del_cycle") {
            if ($id_edit != "") {
                $this->ProductMachine->delete($id_edit);
                $this->redirect("/product2/add/$id#tabs-2");
            }
        }
        //END: Chức năng sửa/xoa tab CycleTime ======================================================================

        //BEGIN: CHỨC NĂNG SỬA/XÓA ĐỊNH MỨC VẬT TƯ ==============================================================

        //chức năng sửa tab định mức vật tư
        $array_edit_product_rate = null;
        if ($act == "edit_rate") {
            if ($id_edit != "") {
                $array_edit_product_rate = $this->ProductRate->find("all", array("conditions" => "id = '$id_edit'"));
            }
        }

        //cn xóa tab định mức vật tư
        if ($act == "del_rate") {
            if ($id_edit != "") {
                $this->ProductRate->delete($id_edit);

                //BEGIN: lấy dữ liệu vật tư
                $array_product_rate_tmp = $this->ProductRate->find("all", array("conditions" => "id_product='$id'"));

                //Lưu tên và mã vật tư vào cột str_product_rate trong bảng scm_products
                $array_data_product_rate = null;
                $str_product_rate = "";
                if ($array_product_rate_tmp) {
                    foreach ($array_product_rate_tmp as $rate) {
                        //Begin:lấy thông tin nguyên vật liệu từ bảng material theo id_material trong bảng product_rate
                        $id_material_tmp = $rate["id_material"];
                        $material_name = $this->Material->get_value(array("fields" => "name", "conditions" => "id = '$id_material_tmp'"));
                        $material_code = $this->Material->get_value(array("fields" => "code", "conditions" => "id = '$id_material_tmp'"));
                        //End: lấy thông tin nguyên vật liệu từ bảng material theo id_material trong bảng product_rate

                        //lấy ra cột user_fullname của bảng product_user có id_product = $id_product
                        $str_product_rate .= "$material_name($material_code)<br>";
                    }
                }

                $array_data_product_rate["id"] = $id;
                $array_data_product_rate["str_product_rate"] = $str_product_rate;
                //END: lấy dữ liệu vật tư
                //print_r($array_data_product_rate);
                $this->Product->save($array_data_product_rate);


                $this->redirect("/product2/add/$id#tabs-3");
            }
        }
        //END: CHỨC NĂNG SỬA/XÓA ĐỊNH MỨC VẬT TƯ =================================================================

        //BEGIN: CHỨC NĂNG SỬA/XÓA ĐỊNH MỨC CÔNG NHÂN ==============================================================
        //chức năng sửa tab định mức công nhân
        $array_edit_product_user = null;
        if ($act == "edit_user") {
            if ($id_edit != "") {
                $array_edit_product_user = $this->ProductUser->find("all", array("conditions" => "id = '$id_edit'"));
            }
        }

        //cn xóa tab định mức công nhân
        if ($act == "del_user") {
            if ($id_edit != "") {
                $this->ProductUser->delete($id_edit);
                //Lưu tên công nhân và công việc vào cột str_user_work trong bảng scm_products
                $array_data_product = null;
                $array_product_user_tmp = $this->ProductUser->find("all", array("conditions" => "id_product='$id'"));
                $str_user_work = "";
                if ($array_product_user_tmp) {
                    foreach ($array_product_user_tmp as $user_work) {
                        //Begin: cắt lấy 2 từ sau cùng của tên
                        $user_fullname = $user_work["user_fullname"];
                        $array_item = explode(" ", $user_fullname);
                        $dem = count($array_item);
                        $str_fullname = $array_item[$dem - 2] . " " . $array_item[$dem - 1];
                        //End: cắt lấy 2 từ sau cùng của tên

                        //lấy ra cột user_fullname của bảng product_user có id_product = $id_product
                        $str_user_work .= $str_fullname . "(" . $user_work["user_code"] . ")" . " - " . $user_work["work_name"] . "<br>";

                    }
                }

                $array_data_product["id"] = $id;
                $array_data_product["str_user_work"] = $str_user_work;
                $this->Product->save($array_data_product);
                //END: lấy dữ liệu bảng product_user
                $this->redirect("/product2/add/$id#tabs-4");
            }
            //$this->redirect("/product2/add/$id/$id_edit?id_group=$id_group#tabs-4");
        }
        //END: CHỨC NĂNG SỬA/XÓA ĐỊNH MỨC CÔNG NHÂN =================================================================

        $array_param = array("array_edit_product" => $array_edit_product,
            "array_customer" => $array_customer,
            "array_line" => $array_line,
            "array_product_cat_detail" => $array_product_cat_detail,
            "id_line" => $id_line,
            "id_edit_product" => $id_edit_product,
            "array_factory" => $array_factory,
            "array_manufactory" => $array_manufactory,
            "array_machine" => $array_machine,
            "array_user2" => $array_user2,
            "array_job" => $array_job,
            "array_product_user" => $array_product_user,
            "array_product_machine" => $array_product_machine,
            "array_material" => $array_material,
            "array_product_rate" => $array_product_rate,
            "array_shift" => $array_shift,
            "array_group" => $array_group,
            "array_edit_product_machine" => $array_edit_product_machine,
            "array_edit_product_rate" => $array_edit_product_rate,
            "array_edit_product_user" => $array_edit_product_user,
            "id" => $id
        );

        $html_result = $this->View->render("add2_product2.php", $array_param);
        echo $html_result;

    }

}//end_class


?>