<?php
class ModelAccountWishlist extends Model {
	public function addWishlist($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int)$this->customer->getId() . "' AND product_id = '" . (int)$product_id . "'");

		$this->db->query("INSERT INTO " . DB_PREFIX . "customer_wishlist SET customer_id = '" . (int)$this->customer->getId() . "', product_id = '" . (int)$product_id . "', date_added = NOW()");
	}

	public function deleteViewWishlist($view_id) {
		$this->db->query("
		DELETE FROM " . DB_PREFIX . "customer_view_wishlist 
		WHERE 
		customer_id = '" . (int)$this->customer->getId() . "' 
		AND view_id = '" . (int)$view_id . "'");
	}

	public function deleteWishlist($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int)$this->customer->getId() . "' AND product_id = '" . (int)$product_id . "'");
	}

	public function getWishlist() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int)$this->customer->getId() . "'");
		print_r("SELECT * FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int)$this->customer->getId() . "'");
	//	print_r ($query );
		return $query->rows;
	}


	

	public function getTotalWishlist() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		return $query->row['total'];
	}


	public function addViewWishlist($view_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_view_wishlist WHERE customer_id = '" . (int)$this->customer->getId() . "' AND view_id = '" . (int)$view_id . "'");

		$this->db->query("INSERT INTO " . DB_PREFIX . "customer_view_wishlist SET customer_id = '" . (int)$this->customer->getId() . "', view_id = '" . (int)$view_id . "', date_added = NOW()");
	}

	public function getViewWishlist() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_view_wishlist WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		return $query->rows;
	}


}
