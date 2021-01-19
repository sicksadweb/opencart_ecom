<?php
class ModelLocalisationLocation extends Model {
	public function addLocation($data) {
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "location SET name = '" . $this->db->escape($data['name']) . "', address = '" . $this->db->escape($data['address']) . "', geocode = '" . $this->db->escape($data['geocode']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', image = '" . $this->db->escape($data['image']) . "', open = '" . $this->db->escape($data['open']) . "', comment = '" . $this->db->escape($data['comment']) . "', description = '" . $this->db->escape($data['description']) . "', status = '" . $data['status'] . "', sort_order = '" . $data['sort_order'] . "'");
		
		$location_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "location SET image = '" . $this->db->escape($data['image']) . "' WHERE location_id = '" . (int)$location_id . "'");
		}

		if (isset($data['store'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "location SET store = '" . $this->db->escape($data['store']) . "' WHERE location_id = '" . (int)$location_id . "'");
		}

		if (isset($data['storage'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "location SET storage = '" . $this->db->escape($data['storage']) . "' WHERE location_id = '" . (int)$location_id . "'");
		}

		if (isset($data['location_image_additional'])) {
			foreach ($data['location_image_additional'] as $product_aditional_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "location_image_additional SET location_id = '" . (int)$location_id . "',  name = '" . $this->db->escape($product_aditional_image['name']) . "', alt = '" . $this->db->escape($product_aditional_image['alt']) . "', image = '" . $this->db->escape($product_aditional_image['image']) . "', sort_order = '" . (int)$product_aditional_image['sort_order'] . "'");
			}
		}

		return $location_id;		
	}

	public function editLocation($location_id, $data) {
		
		$this->db->query("UPDATE " . DB_PREFIX . "location SET name = '" . $this->db->escape($data['name']) . "', address = '" . $this->db->escape($data['address']) . "', geocode = '" . $this->db->escape($data['geocode']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', image = '" . $this->db->escape($data['image']) . "', open = '" . $this->db->escape($data['open']) . "', comment = '" . $this->db->escape($data['comment']) . "', description = '" . $this->db->escape($data['description']) . "', status = '" . $data['status'] . "', sort_order = '" . $data['sort_order'] . "' WHERE location_id = '" . (int)$location_id . "'");
		
		if (isset($data['store'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "location SET store = '" . $this->db->escape($data['store']) . "' WHERE location_id = '" . (int)$location_id . "'");
		}
		else {
			$this->db->query("UPDATE " . DB_PREFIX . "location SET store = 0 WHERE location_id = '" . (int)$location_id . "'");
		}

		if (isset($data['storage'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "location SET storage = '" . $this->db->escape($data['storage']) . "' WHERE location_id = '" . (int)$location_id . "'");
		}
		else {
			$this->db->query("UPDATE " . DB_PREFIX . "location SET storage = 0 WHERE location_id = '" . (int)$location_id . "'");
		}

		$this->db->query("DELETE FROM ". DB_PREFIX ."location_image_additional WHERE location_id = " . (int)$location_id);
		if (isset($data['location_image_additional'])) {
			foreach ($data['location_image_additional'] as $product_aditional_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "location_image_additional SET location_id = '" . (int)$location_id . "',  name = '" . $this->db->escape($product_aditional_image['name']) . "', alt = '" . $this->db->escape($product_aditional_image['alt']) . "', image = '" . $this->db->escape($product_aditional_image['image']) . "', sort_order = '" . (int)$product_aditional_image['sort_order'] . "'");
			}
		}
	}

	public function deleteLocation($location_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "location WHERE location_id = " . (int)$location_id);
		
		$this->db->query("DELETE FROM ". DB_PREFIX ."location_image_additional WHERE location_id = " . (int)$location_id);
	}

	public function getLocation($location_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "location WHERE location_id = '" . (int)$location_id . "'");

		return $query->row;
	}

	public function getLocations($data = array()) {
		$sql = "SELECT location_id, name, address FROM " . DB_PREFIX . "location";

		$sort_data = array(
			'name',
			'address',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
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

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalLocations() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "location");

		return $query->row['total'];
	}

	public function getLocationImages ($location_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "location_image_additional WHERE location_id = '" . (int)$location_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
}
