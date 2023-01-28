<?php
    function pr($arr){
        echo "<pre>";
        print_r($arr);
    }
    
    function prx($arr){
        echo "<pre>";
        print_r($arr);
        die();
    }

    function get_safe_value($conn,$user_data){
        if($user_data != ""){
            $user_data = trim($user_data);
            return mysqli_real_escape_string($conn,$user_data);
        }
    }

    function get_product($conn, $type='', $categories_name=''){
        $sql = "SELECT * FROM PRODUCT WHERE `status`=1";
        if($categories_name!=''){
            $sql .= " AND `categories_name`='$categories_name'";
        }
        if($type == 'latest'){
            $sql .= " ORDER BY `id` DESC";
        }
        $res = mysqli_query($conn, $sql);
        $data = array();
        while($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }
        return $data;
    }
?>