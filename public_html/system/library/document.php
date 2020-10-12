<?php
/**
 * @package		OpenCart
 * @author		Daniel Kerr
 * @copyright	Copyright (c) 2005 - 2017, OpenCart, Ltd. (https://www.opencart.com/)
 * @license		https://opensource.org/licenses/GPL-3.0
 * @link		https://www.opencart.com
*/

/**
* Document class
*/
class Document {
	private $title;
	private $robots;
	private $description;
	private $keywords;
	private $links = array();
	private $styles = array();
	private $scripts = array();
	private $og_image;
	private $breadcrumbs;
	private $metastore;
	

	/**
     * 
     *
     * @param	string	$title
     */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
     * 
	 * 
	 * @return	string
     */
	public function getTitle() {
		return $this->title;
	}
	
	public function setRobots($robots) {
		$this->robots = $robots;
	}
	
	public function getRobots() {
		return $this->robots;
	}

	/**
     * 
     *
     * @param	string	$description
     */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
     * 
     *
     * @param	string	$description
	 * 
	 * @return	string
     */
	public function getDescription() {
		return $this->description;
	}

	/**
     * 
     *
     * @param	string	$keywords
     */
	public function setKeywords($keywords) {
		$this->keywords = $keywords;
	}

	/**
     *
	 * 
	 * @return	string
     */
	public function getKeywords() {
		return $this->keywords;
	}
	

	/**
     * 
     *
     * @param	string	$href
	 * @param	string	$rel
     */
	public function addLink($href, $rel) {
		$this->links[$href] = array(
			'href' => $href,
			'rel'  => $rel
		);
	}

	/**
     * 
	 * 
	 * @return	array
     */
	public function getLinks() {
		return $this->links;
	}

	/**
     * 
     *
     * @param	string	$href
	 * @param	string	$rel
	 * @param	string	$media
     */
	public function addStyle($href, $rel = 'stylesheet', $media = 'screen') {
		$this->styles[$href] = array(
			'href'  => $href,
			'rel'   => $rel,
			'media' => $media
		);
	}

	/**
     * 
	 * 
	 * @return	array
     */
	public function getStyles() {
		return $this->styles;
	}

	/**
     * 
     *
     * @param	string	$href
	 * @param	string	$postion
     */
	public function addScript($href, $postion = 'header') {
		$this->scripts[$postion][$href] = $href;
	}

	/**
     * 
     *
     * @param	string	$postion
	 * 
	 * @return	array
     */
	public function getScripts($postion = 'header') {
		if (isset($this->scripts[$postion])) {
			return $this->scripts[$postion];
		} else {
			return array();
		}
	}
	
	public function setOgImage($image) {
		$this->og_image = $image;
	}

	public function getOgImage() {
		return $this->og_image;
	}

	public function setMetastore($data) {
		$this->metastore = $data;
	}

	public function getMetastore() {
		return $this->metastore;
	}

	public function setBreadcrumbs($data) {
		$breadcrumbs = '
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "BreadcrumbList",
			"itemListElement": [';
		$i = 1;
		foreach ($data as $breadcrumb) {
			if (next($data))  {
				$breadcrumbs .= '
				{
				"@type": "ListItem",
				"position": "'.$i.'",
				"name": "'.$breadcrumb['text'].'",
				"item": "'.$breadcrumb['href'].'"
				},';
			} else {
				$breadcrumbs .= '{
				"@type": "ListItem",
				"position": "'.$i.'",
				"name": "'.$breadcrumb['text'].'",
				"item": "'.$breadcrumb['href'].'"
				}';
			}
			$i++;
		}
		$breadcrumbs .= '
			]
		}
		</script>';
		$this->breadcrumbs = $breadcrumbs;
	}
	
	public function getBreadcrumbs() {
		return $this->breadcrumbs;
	}


}