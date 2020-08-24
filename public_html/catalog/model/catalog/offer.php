<?php
// *	@source		See SOURCE.txt for source and other copyright.
// *	@license	GNU General Public License version 3; see LICENSE.txt

class ModelCatalogOffer extends Model {
	public function updateViewed($offer_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "offer SET viewed = (viewed + 1) WHERE offer_id = '" . (int)$offer_id . "'");
	}

	public function getProduct($offer_id) {
		$query = $this->db->query("
		SELECT DISTINCT *, pd.name AS name, p.image, p.noindex AS noindex, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "offer_discount pd2 WHERE pd2.offer_id = p.offer_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "offer_special ps WHERE ps.offer_id = p.offer_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "offer_reward pr WHERE pr.offer_id = p.offer_id AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, 
		p.sort_order FROM " . DB_PREFIX . "offer p 
		LEFT JOIN " . DB_PREFIX . "offer_description pd ON (p.offer_id = pd.offer_id) 
		LEFT JOIN " . DB_PREFIX . "offer_to_store p2s ON (p.offer_id = p2s.offer_id) 
		LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) 
		LEFT JOIN " . DB_PREFIX . "offer_variants pv ON (p.offer_id = pv.offer_id) 
		LEFT JOIN " . DB_PREFIX . "product op ON (op.product_id = pv.product_id) 
		
		WHERE p.offer_id = '" . (int)$offer_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
		AND p.status = '1' AND op.status = '1' 

		AND p.date_available <= NOW() 
		AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
		");




		if ($query->num_rows) {
			return array(
				'offer_id'       => $query->row['offer_id'],
				'name'             => $query->row['name'],
				'description'      => $query->row['description'],
				'meta_title'       => $query->row['meta_title'],
				'noindex'          => $query->row['noindex'],
				'meta_h1'	       => $query->row['meta_h1'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'tag'              => $query->row['tag'],
				'model'            => $query->row['model'],
				'sku'              => $query->row['sku'],
				'upc'              => $query->row['upc'],
				'ean'              => $query->row['ean'],
				'jan'              => $query->row['jan'],
				'isbn'             => $query->row['isbn'],
				'mpn'              => $query->row['mpn'],
				'location'         => $query->row['location'],
				'quantity'         => $query->row['quantity'],
				'stock_status'     => $query->row['stock_status'],
				'image'            => $query->row['image'],
				'manufacturer_id'  => $query->row['manufacturer_id'],
				'manufacturer'     => $query->row['manufacturer'],
				'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
				'special'          => $query->row['special'],
				'reward'           => $query->row['reward'],
				'points'           => $query->row['points'],
				'tax_class_id'     => $query->row['tax_class_id'],
				'date_available'   => $query->row['date_available'],
				'weight'           => $query->row['weight'],
				'weight_class_id'  => $query->row['weight_class_id'],
				'length'           => $query->row['length'],
				'width'            => $query->row['width'],
				'height'           => $query->row['height'],
				'length_class_id'  => $query->row['length_class_id'],
				'subtract'         => $query->row['subtract'],
				'minimum'          => $query->row['minimum'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed'],
				'video_assembly'           => $query->row['video_assembly'],
				'video_instruction'           => $query->row['video_instruction'],				
				'type_id'           => $query->row['type_id'],	
				'abbr'         		=> $query->row['abbr_package'],				
				

			);
		} else {
			return false;
		}
	}
	


	public function getProductVariant($product_id) {

		$query = $this->db->query("
		SELECT DISTINCT *, 
		(SELECT vd.view_id FROM " . DB_PREFIX . "offer_variants ov, " . DB_PREFIX . "view_image vi , " . DB_PREFIX . "view_description vd WHERE product_id ='".$product_id."' AND vi.offer_id = ov.offer_id AND vd.view_id =vi.view_id LIMIT 1) AS  noview_id ,
		pd.name AS name, 
		p.image, 
		p.noindex AS noindex, 
		m.name AS manufacturer, 
		(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, 
		(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, 
		(SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "') AS reward, 
		(SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, 
		(SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, 
		(SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class,
		(SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, 
		(SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, 
		p.sort_order 
		
		FROM " . DB_PREFIX . "product p 
		LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
		LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) 
		LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) 
		LEFT JOIN " . DB_PREFIX . "stock_status ss ON (ss.stock_status_id = p.stock_status_id) 

		WHERE 
		p.product_id = '" . (int)$product_id . "'
		AND p.status ='1' 
		AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
		AND (ss.visible = '1' OR p.quantity>0 )
		AND p.date_available <= NOW() 
		AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
		");





		if ($query->num_rows) {
			return array(
				'product_id'       => $query->row['product_id'],
				'name'             => $query->row['name'],
				'description'      => $query->row['description'],
				'meta_title'       => $query->row['meta_title'],
				'noindex'          => $query->row['noindex'],
				'meta_h1'	       => $query->row['meta_h1'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'tag'              => $query->row['tag'],
				'model'            => $query->row['model'],
				'sku'              => $query->row['sku'],
				'upc'              => $query->row['upc'],
				'ean'              => $query->row['ean'],
				'jan'              => $query->row['jan'],
				'isbn'             => $query->row['isbn'],
				'mpn'              => $query->row['mpn'],
				'location'         => $query->row['location'],
				'quantity'         => $query->row['quantity'],
				'stock_status'     => $query->row['stock_status'],
				'image'            => $query->row['image'],
				'manufacturer_id'  => $query->row['manufacturer_id'],
				'manufacturer'     => $query->row['manufacturer'],
				'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
				'special'          => $query->row['special'],
				'reward'           => $query->row['reward'],
				'points'           => $query->row['points'],
				'tax_class_id'     => $query->row['tax_class_id'],
				'date_available'   => $query->row['date_available'],
				'weight'           => $query->row['weight'],
				'weight_class_id'  => $query->row['weight_class_id'],
				'length'           => $query->row['length'],
				'width'            => $query->row['width'],
				'height'           => $query->row['height'],
				'length_class_id'  => $query->row['length_class_id'],
				'subtract'         => $query->row['subtract'],
				'rating'           => round($query->row['rating']),
				'reviews'          => $query->row['reviews'] ? $query->row['reviews'] : 0,
				'minimum'          => $query->row['minimum'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed'],
				'video_assembly'           => $query->row['video_assembly'],
				'video_instruction'           => $query->row['video_instruction'],				
				'package_product' => $this->getProductPackageProduct($query->row['product_id']),
				'view_id'           => $query->row['view_id'],
				'type_id'           => $query->row['type_id'],
			
			);
		} else {
			return false;
		}

	}

	public function getProducts($data = array()) {

        if (!empty($data['filter_filter'])) {
            $query_filter_group = $this->db->query("
				SELECT GROUP_CONCAT(`filter_id`) AS filter_id , filter_group_id FROM " . DB_PREFIX . "filter WHERE `filter_id` IN (".$data['filter_filter'].") GROUP BY  filter_group_id
			");
		}
		
		$sql = "
		SELECT p.offer_id, 
		(SELECT price FROM " . DB_PREFIX . "offer_discount pd2 WHERE pd2.offer_id = p.offer_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, 
		(SELECT price FROM " . DB_PREFIX . "offer_special ps 
		
		WHERE ps.offer_id = p.offer_id 
		AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' 
		AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW())
		AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) 

		ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special";

		if (!empty($data['filter_offers_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "offer_to_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "offer_to_category p2c";
			}

			if (!empty($data['filter_filter'])) {

				foreach ($query_filter_group->rows as $result) {
					$sql .= " 
					LEFT JOIN " . DB_PREFIX . "offer_filter pf".$result['filter_group_id']." ON (p2c.offer_id = pf".$result['filter_group_id'].".offer_id) 
					";
				}
				$sql .= " 
				LEFT JOIN " . DB_PREFIX . "offer_filter pf ON (p2c.offer_id = pf.offer_id) 
				LEFT JOIN " . DB_PREFIX . "offer p ON (pf.offer_id = p.offer_id)
				";

		//		$sql .= " LEFT JOIN " . DB_PREFIX . "offer_filter pf ON (p2c.offer_id = pf.offer_id) LEFT JOIN " . DB_PREFIX . "offer p ON (pf.offer_id = p.offer_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "offer p ON (p2c.offer_id = p.offer_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "offer p";
		}

		$sql .= " LEFT JOIN " . DB_PREFIX . "offer_description pd ON (p.offer_id = pd.offer_id) 
		
				  LEFT JOIN " . DB_PREFIX . "offer_to_store p2s ON (p.offer_id = p2s.offer_id) 
				  
				  LEFT JOIN " . DB_PREFIX . "offer_variants ov ON (ov.offer_id = p.offer_id) 
				  LEFT JOIN " . DB_PREFIX . "product p2 ON (ov.product_id = p2.product_id) 
				 
				  WHERE 
				  
					  pd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
					  AND p.status = '1' AND p2.status = '1'
					  AND p.date_available <= NOW() 
					  AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_offers_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_offers_id'] . "'";
			} else {
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_offers_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				foreach ($query_filter_group->rows as $result) {

						$sql .= " AND pf".$result['filter_group_id'].".filter_id IN (" . $result['filter_id'] .")";
				}
		//		$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
				
			}
		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "pd.tag LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$sql .= " GROUP BY p.offer_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'p.quantity',
			'p.price',
			'rating',
			'p.sort_order',
			'p.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {

				if (isset($data['order']) && ($data['order'] == 'DESC')) {
					$sql .= " ORDER BY CASE WHEN p.price> 0 THEN 0 ELSE 1 END , p.price DESC, (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END)";
				} else {
					$sql .= " ORDER BY CASE WHEN p.price> 0 THEN 0 ELSE 1 END , p.price ASC, (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END)";
				}

			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$product_data = array();



		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$product_data[$result['offer_id']] = $this->getProduct($result['offer_id']);
		}

		return $product_data;
	}

	public function getProductSpecials($data = array()) {
		$sql = "SELECT DISTINCT ps.offer_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.offer_id = ps.offer_id AND r1.status = '1' GROUP BY r1.offer_id) AS rating FROM " . DB_PREFIX . "offer_special ps LEFT JOIN " . DB_PREFIX . "offer p ON (ps.offer_id = p.offer_id) LEFT JOIN " . DB_PREFIX . "offer_description pd ON (p.offer_id = pd.offer_id) LEFT JOIN " . DB_PREFIX . "offer_to_store p2s ON (p.offer_id = p2s.offer_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.offer_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'ps.price',
			'rating',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$product_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$product_data[$result['offer_id']] = $this->getProduct($result['offer_id']);
		}

		return $product_data;
	}

	public function getProductPrice($offer_id, $type_id = 0) {
		$product_data = array();

if ($type_id > 0 ) { 

	$query = $this->db->query("

	SELECT o.offer_id, od.name , pd.name,p.price, pd.product_id,p.type_id, ptd.name, ptc.ratio
	FROM " . DB_PREFIX . "offer o
	LEFT JOIN 	" . DB_PREFIX . "offer_description od ON (od.offer_id =o.offer_id)
	LEFT JOIN 	" . DB_PREFIX . "offer_variants ov ON (ov.offer_id = o.offer_id)
	LEFT JOIN 	" . DB_PREFIX . "product_description pd ON (ov.product_id = pd.product_id)
	LEFT JOIN 	" . DB_PREFIX . "product p ON  (ov.product_id = p.product_id)

	LEFT JOIN 	" . DB_PREFIX . "package_product pp ON (pp.product_id = p.product_id)	
	LEFT JOIN 	" . DB_PREFIX . "product_types_description ptd ON (ptd.type_id =p.type_id)
	LEFT JOIN 	" . DB_PREFIX . "product_types_combinations ptc ON (ptc.combination  =p.type_id)
	LEFT JOIN 	" . DB_PREFIX . "stock_status ss ON  (ss.stock_status_id = p.stock_status_id)	
	
	WHERE o.offer_id ='".(int)$offer_id."'  AND ptd.type_id >0 AND (p.quantity > 0  OR ss.visible =1 )
	GROUP BY ptd.type_id

	
	");  

	foreach ($query->rows as $result) {
		$summa = $summa + ($result['price']* $result['ratio']);
	
	} 

		$product_data = array(
			'price' => $summa/10,
			'abbr'  => 'м.пог',
		);

} else {
	$query = $this->db->query("

	SELECT od.name, pd.name, p.price, p.base_product,pp.volume, (p.price / pp.volume) AS price , (p.price / pp.volume) AS mainprice , ppd.abbr
	FROM " . DB_PREFIX . "offer o
	LEFT JOIN 	" . DB_PREFIX . "offer_description od ON (od.offer_id =o.offer_id)
	LEFT JOIN 	" . DB_PREFIX . "offer_variants ov ON (ov.offer_id = o.offer_id)
	LEFT JOIN 	" . DB_PREFIX . "product_description pd ON (ov.product_id = pd.product_id)
	LEFT JOIN 	" . DB_PREFIX . "product p ON  (ov.product_id = p.product_id)
	LEFT JOIN 	" . DB_PREFIX . "package_product pp ON (pp.product_id = p.product_id)
	LEFT JOIN 	ckf_package_description ppd ON (pp.package_name_id = ppd.package_id)   
	LEFT JOIN 	" . DB_PREFIX . "product_types_description ptd ON (ptd.type_id =p.type_id)
	LEFT JOIN 	" . DB_PREFIX . "product_types_combinations ptc ON (ptc.combination  =p.type_id)
	LEFT JOIN 	" . DB_PREFIX . "stock_status ss ON  (ss.stock_status_id = p.stock_status_id)

	WHERE o.offer_id = '".(int)$offer_id."' AND (p.quantity > 0  OR ss.visible =1 ) AND p.status='1'

	ORDER BY p.base_product DESC , mainprice ASC
	LIMIT 1

	"); 


	foreach ($query->rows as $result) {
		$product_data = array(
			'price' => $result['price'],
			'abbr'  => $result['abbr'],
		);
	
	} 



}

	$query = $this->db->query(" 

	UPDATE  " . DB_PREFIX . "offer SET  price ='".$product_data['price']."' WHERE offer_id='".(int)$offer_id."' ;

	"); 

		return $product_data;

    }
	
	
	public function getLatestProducts($limit) {
		$product_data = $this->cache->get('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);

		if (!$product_data) {
			$query = $this->db->query("SELECT p.offer_id FROM " . DB_PREFIX . "offer p LEFT JOIN " . DB_PREFIX . "offer_to_store p2s ON (p.offer_id = p2s.offer_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.date_added DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$product_data[$result['offer_id']] = $this->getProduct($result['offer_id']);
			}

			$this->cache->set('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
		}

		return $product_data;
	}

	public function getPopularProducts($limit) {
		$product_data = $this->cache->get('product.popular.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);
	
		if (!$product_data) {
			$query = $this->db->query("SELECT p.offer_id FROM " . DB_PREFIX . "offer p LEFT JOIN " . DB_PREFIX . "offer_to_store p2s ON (p.offer_id = p2s.offer_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.viewed DESC, p.date_added DESC LIMIT " . (int)$limit);
	
			foreach ($query->rows as $result) {
				$product_data[$result['offer_id']] = $this->getProduct($result['offer_id']);
			}
			
			$this->cache->set('product.popular.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
		}
		
		return $product_data;
	}

	public function getBestSellerProducts($limit) {
		$product_data = $this->cache->get('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);

		if (!$product_data) {
			$product_data = array();

			$query = $this->db->query("SELECT op.offer_id, SUM(op.quantity) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "offer` p ON (op.offer_id = p.offer_id) LEFT JOIN " . DB_PREFIX . "offer_to_store p2s ON (p.offer_id = p2s.offer_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.offer_id ORDER BY total DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$product_data[$result['offer_id']] = $this->getProduct($result['offer_id']);
			}

			$this->cache->set('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
		}

		return $product_data;
	}

	public function getProductAttributes($offer_id) {
		$product_attribute_group_data = array();

		$product_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "offer_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.offer_id = '" . (int)$offer_id . "' AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

		foreach ($product_attribute_group_query->rows as $product_attribute_group) {
			$product_attribute_data = array();

			$product_attribute_query = $this->db->query("SELECT a.attribute_id, ad.name, pa.text FROM " . DB_PREFIX . "offer_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.offer_id = '" . (int)$offer_id . "' AND a.attribute_group_id = '" . (int)$product_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");

			foreach ($product_attribute_query->rows as $product_attribute) {
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute['attribute_id'],
					'name'         => $product_attribute['name'],
					'text'         => $product_attribute['text']
				);
			}

			$product_attribute_group_data[] = array(
				'attribute_group_id' => $product_attribute_group['attribute_group_id'],
				'name'               => $product_attribute_group['name'],
				'attribute'          => $product_attribute_data
			);
		}

		return $product_attribute_group_data;
	}

	public function getProductOptions($offer_id) {
		$product_option_data = array();

		$product_option_query = $this->db->query("
		SELECT * FROM " . DB_PREFIX . "offer_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) 
		LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) 
		WHERE po.offer_id = '" . (int)$offer_id . "' 
		AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' 
		ORDER BY o.sort_order
		
		");

		foreach ($product_option_query->rows as $product_option) {
			$product_option_value_data = array();

			$product_option_value_query = $this->db->query("
			SELECT * FROM " . DB_PREFIX . "offer_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) 
			LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) 
			
			WHERE pov.offer_id = '" . (int)$offer_id . "' AND pov.offer_option_id= '" . (int)$product_option['offer_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order
			
			");


			foreach ($product_option_value_query->rows as $product_option_value) {
				$product_option_value_data[] = array(
					'offer_option_value_id' => $product_option_value['offer_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'name'                    => $product_option_value['name'],
					'image'                   => $product_option_value['image'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
					'price_prefix'            => $product_option_value['price_prefix'],
					'weight'                  => $product_option_value['weight'],
					'weight_prefix'           => $product_option_value['weight_prefix']
				);
			}

			$product_option_data[] = array(
				'offer_option_id'    => $product_option['offer_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => $product_option['value'],
				'required'             => $product_option['required']
			);
		}

		return $product_option_data;
	}

	public function getProductDiscounts($offer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_discount WHERE offer_id = '" . (int)$offer_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");

		return $query->rows;
	}

	public function getProductImages($offer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_image WHERE offer_id = '" . (int)$offer_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getProductAditionalImages($offer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_image_aditional WHERE offer_id = '" . (int)$offer_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getProductPackageProduct($product_id) {
		$package_product = array();

		$query = $this->db->query("
		SELECT 
		pd.package_id AS package_id,
		product_id,
		parent_package_id,
		volume,
		quantity,
		pd2.abbr,
		pd.description ,
		pd.name AS name,
		pd2.name AS pack 
		FROM " . DB_PREFIX . "package_product pp 
		LEFT JOIN " . DB_PREFIX . "package_description pd ON (pp.package_id =pd.package_id)
		LEFT JOIN " . DB_PREFIX . "package_description pd2 ON (pp.package_name_id =pd2.package_id)
		WHERE product_id = '" . (int)$product_id . "'
		");

		foreach ($query->rows as $result) {
			$package_product[] = array(
				'product_id' => $result['product_id'],
				'package' => $result['package_id'],
				'parent_package' => $result['parent_package_id'],
				'quantity' => $result['quantity'],
				'volume' => $result['volume'],
				'package_id' => $result['package_id'],
				'abbr' => $result['abbr'],
				'name' => $result['name'],
				'pack' => $result['pack'],	
				'parent_package_id' => $result['parent_package_id'],
						
			);
		}
		return $package_product;
	}
	
	

	public function getProductAditionalProducts($offer_id) {
		$groups_data = array();

		$query = $this->db->query("
		SELECT DISTINCT(rg.group_id), rg.name FROM " . DB_PREFIX . "groups_aditional_products ro

		LEFT JOIN " . DB_PREFIX . "group_aditional_products_description rg ON (ro.group_id = rg.group_id)

		WHERE `offer_id` ='" . (int)$offer_id . "'

		");

		foreach ($query->rows as $result) {
			$products_data = array();

			$query_products = $this->db->query("

			SELECT * 
			
			FROM " . DB_PREFIX . "groups_aditional_products ro

			LEFT JOIN " . DB_PREFIX . "product p ON (ro.product_id = p.product_id)
			LEFT JOIN " . DB_PREFIX . "stock_status ss ON (ss.stock_status_id = p.stock_status_id) 

			WHERE 
			(ss.visible = 1 OR p.quantity >0 )
			AND 			offer_id ='".$offer_id."' AND group_id='".$result['group_id']."'

			");

            foreach ($query_products->rows as $result_products) {

				$products_data[] = $this->getProductVariant($result_products['product_id']);

			}

			$groups_data[] = array(
				'name'    => $result['name'],
				'group_id' => $result['group_id'],
				'products' => $products_data,			
			);

		}

		return $groups_data ;

	}	

	public function getProductVariants($offer_id) {

		$product_data = array();

		$query = $this->db->query("
		SELECT * FROM " . DB_PREFIX . "offer_variants  ov
	
		LEFT JOIN " . DB_PREFIX . "product p ON (p.product_id = ov.product_id)
		LEFT JOIN " . DB_PREFIX . "stock_status ss ON (ss.stock_status_id = p.stock_status_id)


		WHERE offer_id= '" . (int)$offer_id . "'
		AND p.status ='1' 

		AND (ss.visible = '1' OR p.quantity>0 )
		");

		foreach ($query->rows as $result) {

			$product_data[] = $this->getProductVariant($result['product_id']);
		}

		return $product_data;

	}

	
	public function getProductRelated($offer_id) {
		$product_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_related pr LEFT JOIN " . DB_PREFIX . "offer p ON (pr.related_id = p.offer_id) LEFT JOIN " . DB_PREFIX . "offer_to_store p2s ON (p.offer_id = p2s.offer_id) WHERE pr.offer_id = '" . (int)$offer_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		foreach ($query->rows as $result) {
			$product_data[$result['related_id']] = $this->getProduct($result['related_id']);
		}

		return $product_data;
	}

	public function getProductLayoutId($offer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_to_layout WHERE offer_id = '" . (int)$offer_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return (int)$query->row['layout_id'];
		} else {
			return 0;
		}
	}

	public function getCategories($offer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_to_category WHERE offer_id = '" . (int)$offer_id . "'");

		return $query->rows;
	}

	public function getTotalProducts($data = array()) {

		$sql = "SELECT COUNT(DISTINCT p.offer_id) AS total";

        if (!empty($data['filter_filter'])) {
            $query_filter_group = $this->db->query("
				SELECT GROUP_CONCAT(`filter_id`) AS filter_id , filter_group_id FROM " . DB_PREFIX . "filter WHERE `filter_id` IN (".$data['filter_filter'].") GROUP BY  filter_group_id
			");
        } else{ 

		}
		
		if (!empty($data['filter_offers_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "offer_to_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "offer_to_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				foreach ($query_filter_group->rows as $result) {

					$sql .= " 
					LEFT JOIN " . DB_PREFIX . "offer_filter pf".$result['filter_group_id']." ON (p2c.offer_id = pf".$result['filter_group_id'].".offer_id) 
					";
				}
				$sql .= " 
				LEFT JOIN " . DB_PREFIX . "offer_filter pf ON (p2c.offer_id = pf.offer_id) 
				LEFT JOIN " . DB_PREFIX . "offer p ON (pf.offer_id = p.offer_id)



				";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "offer p ON (p2c.offer_id = p.offer_id)";
			}

		} else {
			$sql .= " FROM " . DB_PREFIX . "offer p";
		}

		$sql .= " LEFT JOIN " . DB_PREFIX . "offer_description pd ON (p.offer_id = pd.offer_id) 
		LEFT JOIN " . DB_PREFIX . "offer_to_store p2s ON (p.offer_id = p2s.offer_id) 
		LEFT JOIN " . DB_PREFIX . "offer_variants ov ON (ov.offer_id = p.offer_id) 
		LEFT JOIN " . DB_PREFIX . "product p2 ON (ov.product_id = p2.product_id) 

		WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
		AND p.status = '1' AND p2.status = '1' 
		
		AND p.date_available <= NOW() 
		AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_offers_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_offers_id'] . "'";
			} else {
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_offers_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				foreach ($query_filter_group->rows as $result) {

					$sql .= " AND pf".$result['filter_group_id'].".filter_id IN (" . $result['filter_id'] .")";
				}
		//		$sql .= " AND pf.filter_id IN (" . implode(',', $implode) .")";
			}
		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "pd.tag LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getProfile($offer_id, $recurring_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "recurring r JOIN " . DB_PREFIX . "offer_recurring pr ON (pr.recurring_id = r.recurring_id AND pr.offer_id = '" . (int)$offer_id . "') WHERE pr.recurring_id = '" . (int)$recurring_id . "' AND status = '1' AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'");

		return $query->row;
	}

	public function getProfiles($offer_id) {
		$query = $this->db->query("SELECT rd.* FROM " . DB_PREFIX . "offer_recurring pr JOIN " . DB_PREFIX . "recurring_description rd ON (rd.language_id = " . (int)$this->config->get('config_language_id') . " AND rd.recurring_id = pr.recurring_id) JOIN " . DB_PREFIX . "recurring r ON r.recurring_id = rd.recurring_id WHERE pr.offer_id = " . (int)$offer_id . " AND status = '1' AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getTotalProductSpecials() {
		$query = $this->db->query("SELECT COUNT(DISTINCT ps.offer_id) AS total FROM " . DB_PREFIX . "offer_special ps LEFT JOIN " . DB_PREFIX . "offer p ON (ps.offer_id = p.offer_id) LEFT JOIN " . DB_PREFIX . "offer_to_store p2s ON (p.offer_id = p2s.offer_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))");

		if (isset($query->row['total'])) {
			return $query->row['total'];
		} else {
			return 0;
		}
	}
}
