<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "opencart_ecom";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `ckf_offer` ";
$results = $conn->query($sql);
print_r ($results);

if ($results->num_rows > 0) {

    foreach ($results as $result) {
        print_r ('<br>'.$result['offer_id'].'-');
        $offer_id =$result['offer_id'];
        if ($result['type_id'] > 0) {
            $query = $conn->query("
    
        SELECT o.offer_id, od.name , pd.name,p.price, pd.product_id,p.type_id, ptd.name, ptc.ratio
        FROM ckf_offer o
        LEFT JOIN 	ckf_offer_description od ON (od.offer_id =o.offer_id)
        LEFT JOIN 	ckf_offer_variants ov ON (ov.offer_id = o.offer_id)
        LEFT JOIN 	ckf_product_description pd ON (ov.product_id = pd.product_id)
        LEFT JOIN 	ckf_product p ON  (ov.product_id = p.product_id)
    
        LEFT JOIN 	ckf_package_product pp ON (pp.product_id = p.product_id)	
        LEFT JOIN 	ckf_product_types_description ptd ON (ptd.type_id =p.type_id)
        LEFT JOIN 	ckf_product_types_combinations ptc ON (ptc.combination  =p.type_id)
        LEFT JOIN 	ckf_stock_status ss ON  (ss.stock_status_id = p.stock_status_id)	
        
        WHERE o.offer_id ='".$result['offer_id']."'  AND ptd.type_id >0 AND (p.quantity > 0  OR ss.visible =1 )
        GROUP BY ptd.type_id
    
        
        ");
        echo"
    
        SELECT o.offer_id, od.name , pd.name,p.price, pd.product_id,p.type_id, ptd.name, ptc.ratio
        FROM ckf_offer o
        LEFT JOIN 	ckf_offer_description od ON (od.offer_id =o.offer_id)
        LEFT JOIN 	ckf_offer_variants ov ON (ov.offer_id = o.offer_id)
        LEFT JOIN 	ckf_product_description pd ON (ov.product_id = pd.product_id)
        LEFT JOIN 	ckf_product p ON  (ov.product_id = p.product_id)
    
        LEFT JOIN 	ckf_package_product pp ON (pp.product_id = p.product_id)	
        LEFT JOIN 	ckf_product_types_description ptd ON (ptd.type_id =p.type_id)
        LEFT JOIN 	ckf_product_types_combinations ptc ON (ptc.combination  =p.type_id)
        LEFT JOIN 	ckf_stock_status ss ON  (ss.stock_status_id = p.stock_status_id)	
        
        WHERE o.offer_id ='".$result['offer_id']."'  AND ptd.type_id >0
        GROUP BY ptd.type_id
    
        
        ";

        foreach ($query as $result) {
            $summa = $summa + ($result['price']* $result['ratio']);
        
        } 
    
            $product_data = array(
                'price' => $summa/10,
                'abbr'  => 'м.пог',
        
        );

        print_r ($product_data );

        $update_price = $conn->query("
		UPDATE ckf_offer  SET  price= '" . $product_data['price'] . "', abbr_package='" . $product_data['abbr'] . "' WHERE offer_id ='" . $offer_id . "';
        ");

        echo"
        UPDATE ckf_offer  SET  price= '" . $product_data['price'] . "', abbr_package='" . $product_data['abbr'] . "' WHERE offer_id ='" . $offer_id . "';
        ";
        } else {
            $query = $conn->query("
    
        SELECT od.name, pd.name, p.price, p.base_product,pp.volume, (p.price / pp.volume) AS price , (p.price / pp.volume) AS mainprice , ppd.abbr
        FROM ckf_offer o
        LEFT JOIN 	ckf_offer_description od ON (od.offer_id =o.offer_id)
        LEFT JOIN 	ckf_offer_variants ov ON (ov.offer_id = o.offer_id)
        LEFT JOIN 	ckf_product_description pd ON (ov.product_id = pd.product_id)
        LEFT JOIN 	ckf_product p ON  (ov.product_id = p.product_id)
        LEFT JOIN 	ckf_package_product pp ON (pp.product_id = p.product_id)
        LEFT JOIN 	ckf_package_description ppd ON (pp.package_name_id = ppd.package_id)   
        LEFT JOIN 	ckf_product_types_description ptd ON (ptd.type_id =p.type_id)
        LEFT JOIN 	ckf_product_types_combinations ptc ON (ptc.combination  =p.type_id)
        LEFT JOIN 	ckf_stock_status ss ON  (ss.stock_status_id = p.stock_status_id)
    
        WHERE o.offer_id = '".(int)$result['offer_id']."'  AND p.status='1'
    
        ORDER BY p.base_product DESC , mainprice ASC
        LIMIT 1
    
        ");
        print_r ($query);
	foreach ($query as $result) {
		$product_data = array(
			'price' => $result['price'],
			'abbr'  => $result['abbr'],
		); 
	
    } 
    

    $update_price = $conn->query("
    UPDATE ckf_offer  SET  price= '" . round($product_data['price'], 2)  . "',abbr_package='" . $product_data['abbr'] . "' WHERE offer_id ='" . $offer_id . "';
    ");

    echo"
    UPDATE ckf_offer  SET  price= '" . round($product_data['price'], 2)  . "',abbr_package='" . $product_data['abbr'] . "' WHERE offer_id ='" . $offer_id . "';
    ";



        }
        
    }
}
$conn->close();
