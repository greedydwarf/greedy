<?php
class ModelCatalogInformation extends Model {
	public function getOrderStatus($track_order, $language_id){

		$order_status = $this->db->query("SELECT o.order_status_id,
			(SELECT os.name FROM " . DB_PREFIX . "order_status os WHERE os.order_status_id = o.order_status_id AND os.language_id = '" . $language_id . "') AS status_name FROM " . DB_PREFIX . "order o 
			 WHERE o.payment_address_1 = '" . $track_order . "' OR o.order_id = '" . $track_order . "'");
		return $order_status->row;
	}
	public function getPaidOrder($customer_id) {
		$query = $this->db->query("SELECT order_id, firstname, lastname FROM " . DB_PREFIX . "order WHERE
		 customer_id = '" . $customer_id . "' 
		 AND order_status_id = 2 ");
		$paid_order_data = array();
		foreach ($query->rows as $order_data) {
			$order_product = $this->db->query("SELECT *,
			(SELECT o.firstname FROM " . DB_PREFIX . "order o WHERE o.order_id = '" . $order_data['order_id'] . "') AS nickname,
			(SELECT o.payment_address_1 FROM " . DB_PREFIX . "order o WHERE o.order_id = '" . $order_data['order_id'] . "') AS paymentID,
			(SELECT o.lastname FROM " . DB_PREFIX . "order o WHERE o.order_id = '" . $order_data['order_id'] . "') AS server FROM " . DB_PREFIX . "order_product op 
			
			 WHERE op.order_id = '" . $order_data['order_id'] . "' ");
			$paid_order_data[$order_data['order_id']] = $order_product->row;
		}

		return $paid_order_data;
	}
	public function getTreatedOrder($customer_id) {
		$query = $this->db->query("SELECT order_id FROM " . DB_PREFIX . "order WHERE
		 customer_id = '" . $customer_id . "' 
		 AND order_status_id = 5 ");
		$treated_order_data = array();
		foreach ($query->rows as $order_data) {
			$order_product = $this->db->query("SELECT *,
			(SELECT o.firstname FROM " . DB_PREFIX . "order o WHERE o.order_id = '" . $order_data['order_id'] . "') AS nickname,
			(SELECT o.payment_address_1 FROM " . DB_PREFIX . "order o WHERE o.order_id = '" . $order_data['order_id'] . "') AS paymentID,
			(SELECT o.lastname FROM " . DB_PREFIX . "order o WHERE o.order_id = '" . $order_data['order_id'] . "') AS server FROM " . DB_PREFIX . "order_product op 
			
			 WHERE op.order_id = '" . $order_data['order_id'] . "' ");
			$treated_order_data[$order_data['order_id']] = $order_product->row;
		}

		return $treated_order_data;
	}
	public function getInformation($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE i.information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1'");

		return $query->row;
	}

	public function getInformations() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1' ORDER BY i.sort_order, LCASE(id.title) ASC");

		return $query->rows;
	}

	public function getInformationLayoutId($information_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}
}